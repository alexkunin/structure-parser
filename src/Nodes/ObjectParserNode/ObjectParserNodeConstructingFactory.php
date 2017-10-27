<?php
namespace AlexKunin\StructureParser\Nodes\ObjectParserNode;

use AlexKunin\StructureParser\Nodes\SimpleParsedNodeInterface;

class ObjectParserNodeConstructingFactory implements ObjectParserNodeFactoryInterface
{
    /**
     * @var string
     */
    private $className;

    /**
     * @param string $className
     */
    public function __construct($className)
    {
        assert(in_array(SimpleParsedNodeInterface::class, class_implements($className), true));
        $this->className = $className;
    }

    /**
     * @inheritdoc
     */
    public function makeNewInstance(array $properties, array $input)
    {
        return new $this->className($properties, $input);
    }
}