<?php
namespace AlexKunin\StructureParser\Nodes;

use AlexKunin\StructureParser\ParserNodeUtils;
use AlexKunin\StructureParser\StructureParserNodeInterface;

class ObjectParserNode implements StructureParserNodeInterface
{
    use ParserNodeUtils;

    /**
     * @var string
     */
    private $class;

    /**
     * @var StructureParserNodeInterface[]
     */
    private $properties;

    /**
     * @param string $class
     * @param array  $properties
     */
    public function __construct($class, array $properties)
    {
        $this->class = $class;
        $this->properties = $properties;
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
        return new $this->class($this->properties, $input);
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
                    . $this->properties[$property]->getReadableDescription()
                    . ($index === count($this->properties) - 1 ? ' ' : ',')
                );

                $comment = $this->properties[$property]->formatComment();

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