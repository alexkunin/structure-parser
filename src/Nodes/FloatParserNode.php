<?php
namespace AlexKunin\StructureParser\Nodes;

use AlexKunin\StructureParser\ParserNodeUtils;
use AlexKunin\StructureParser\StructureParserNodeInterface;
use Exception;

class FloatParserNode implements StructureParserNodeInterface
{
    use ParserNodeUtils;

    /**
     * @inheritdoc
     */
    public function parse($input)
    {
        if (!is_float($input)) {
            throw new Exception('Float expected');
        }

        return $input;
    }

    /**
     * @inheritdoc
     */
    public function getReadableDescription()
    {
        return '<FLOAT>';
    }
}