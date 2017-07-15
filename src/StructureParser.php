<?php
namespace AlexKunin\StructureParser;

use AlexKunin\StructureParser\Nodes\FloatParserNode;
use AlexKunin\StructureParser\Nodes\MapParserNode;
use AlexKunin\StructureParser\Nodes\ObjectParserNode;
use AlexKunin\StructureParser\Nodes\StringParserNode;
use AlexKunin\StructureParser\Nodes\VectorParserNode;

class StructureParser
{
    public function object($class, array $properties)
    {
        return new ObjectParserNode($class, $properties);
    }

    public function map(StructureParserNodeInterface $key, StructureParserNodeInterface $value)
    {
        return new MapParserNode($key, $value);
    }

    public function vector(StructureParserNodeInterface $value)
    {
        return new VectorParserNode($value);
    }

    public function string()
    {
        return new StringParserNode();
    }

    public function float()
    {
        return new FloatParserNode();
    }
}