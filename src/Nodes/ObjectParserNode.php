<?php
namespace AlexKunin\StructureParser\Nodes;

use AlexKunin\StructureParser\StructureParserNodeInterface;

class ObjectParserNode implements StructureParserNodeInterface
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var array
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
     * @param mixed $input
     *
     * @return mixed
     */
    public function parse($input)
    {
        return new $this->class($this->properties, $input);
    }
}