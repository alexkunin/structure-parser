<?php
namespace AlexKunin\StructureParser\Nodes;

use Exception;
use AlexKunin\StructureParser\StructureParserNodeInterface;

class FloatParserNode implements StructureParserNodeInterface
{
    /**
     * @param mixed $input
     *
     * @return mixed
     * @throws Exception
     */
    public function parse($input)
    {
        if (!is_float($input)) {
            throw new Exception('Float expected');
        }

        return $input;
    }
}