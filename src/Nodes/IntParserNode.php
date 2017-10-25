<?php
namespace AlexKunin\StructureParser\Nodes;

use AlexKunin\StructureParser\ParserNodeUtils;
use AlexKunin\StructureParser\StructureParserNodeInterface;
use Exception;

class IntParserNode implements StructureParserNodeInterface
{
    use ParserNodeUtils;

    /**
     * @inheritdoc
     */
    public function parse($input)
    {
        if (!is_int($input)) {
            throw new Exception('Int expected');
        }

        return $input;
    }

    /**
     * @inheritdoc
     */
    public function getReadableDescription()
    {
        return '<INT>';
    }
}