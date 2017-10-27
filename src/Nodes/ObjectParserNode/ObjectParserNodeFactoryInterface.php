<?php
namespace AlexKunin\StructureParser\Nodes\ObjectParserNode;

use AlexKunin\StructureParser\StructureParserNodeInterface;

interface ObjectParserNodeFactoryInterface
{
    /**
     * @param StructureParserNodeInterface[] $properties
     * @param array                          $input
     *
     * @return object
     */
    public function makeNewInstance(array $properties, array $input);
}