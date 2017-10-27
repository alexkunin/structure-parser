<?php
namespace AlexKunin\StructureParser\Nodes;

use AlexKunin\StructureParser\StructureParserNodeInterface;

interface SimpleParsedNodeInterface
{
    /**
     * @param StructureParserNodeInterface[] $properties
     * @param array                          $input
     */
    public function __construct(array $properties, array $input);
}