<?php
namespace AlexKunin\StructureParser\Nodes;

use AlexKunin\StructureParser\ParserNodeUtils;
use AlexKunin\StructureParser\StructureParserNodeInterface;

class RawParserNode implements StructureParserNodeInterface
{
    use ParserNodeUtils;

    /**
     * @inheritdoc
     */
    public function parse($input)
    {
        return $input;
    }

    /**
     * @inheritdoc
     */
    public function getReadableDescription()
    {
        return '<RAW>';
    }
}