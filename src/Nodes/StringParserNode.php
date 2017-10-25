<?php
namespace AlexKunin\StructureParser\Nodes;

use AlexKunin\StructureParser\ParserNodeUtils;
use AlexKunin\StructureParser\StructureParserNodeInterface;
use Exception;

class StringParserNode implements StructureParserNodeInterface
{
    use ParserNodeUtils;

    /**
     * @inheritdoc
     */
    public function parse($input)
    {
        if (!is_string($input)) {
            throw new Exception('String expected');
        }

        return $input;
    }

    /**
     * @inheritdoc
     */
    public function getReadableDescription()
    {
        return '<STRING>';
    }
}