<?php
namespace AlexKunin\StructureParser\Nodes;

use AlexKunin\StructureParser\ParserNodeUtils;
use AlexKunin\StructureParser\StructureParserNodeInterface;
use Exception;

class ObjectParserNode implements StructureParserNodeInterface
{
    use ParserNodeUtils;

    /**
     * @var string|callable
     */
    private $class;

    /**
     * @var array
     */
    private $properties = [];

    /**
     * @param string $class
     * @param array  $properties
     */
    public function __construct($class, array $properties)
    {
        $this->class = $class;
        foreach ($properties as $property => $node) {
            $this->addProperty($property, $property, $node);
        }
    }

    public function addProperty($inputName, $outputName, StructureParserNodeInterface $parserNode)
    {
        $this->properties[$inputName] = [
            'name' => $outputName,
            'node' => $parserNode,
        ];
    }

    /**
     * @param string $filename
     *
     * @return mixed
     */
    public function parseJsonFile($filename)
    {
        return $this->parse(json_decode(
            file_get_contents($filename),
            true
        ));
    }

    /**
     * @inheritdoc
     */
    public function parse($input)
    {
        $properties = array_combine(
            array_map(function (array $desc) {
                return $desc['name'];
            }, $this->properties),
            array_map(function (array $desc) {
                return $desc['node'];
            }, $this->properties)
        );

        $input = array_reduce(
            array_keys($this->properties),
            function (array $result, string $inputProperty) use ($input) {
                $result[$this->properties[$inputProperty]['name']] = $input[$inputProperty];
                return $result;
            },
            []
        );

        if (is_string($this->class)) {
            return new $this->class($properties, $input);
        } elseif (is_callable($this->class)) {
            return call_user_func($this->class, $properties, $input);
        } else {
            throw new Exception('Invalid class/factory');
        }
    }

    /**
     * @inheritdoc
     */
    public function getReadableDescription()
    {
        $result = '{';

        if ($this->properties) {
            $result .= PHP_EOL;

            $maxPropertyLength = max(array_merge([0], array_map('strlen', array_keys($this->properties))));

            foreach (array_keys($this->properties) as $index => $property) {
                $line = $this->indent(
                    str_pad('"' . $property . '":', $maxPropertyLength + 4)
                    . $this->properties[$property]['node']->getReadableDescription()
                    . ($index === count($this->properties) - 1 ? ' ' : ',')
                );

                $comment = $this->properties[$property]['node']->formatComment();

                if ($comment) {
                    $line .= preg_replace('/\n/', "\n" . str_repeat(' ', strlen($line)), $comment);
                }

                $result .= $line . PHP_EOL;
            }
        }

        $result .= '}';

        return $result;
    }
}