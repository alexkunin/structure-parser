<?php
namespace AlexKunin\StructureParser\Nodes;

use Exception;
use AlexKunin\StructureParser\StructureParserNodeInterface;

class IntParserNode implements StructureParserNodeInterface
{
    /**
     * @param mixed $input
     *
     * @return mixed
     * @throws Exception
     */
    public function parse($input)
    {
        if (!is_int($input)) {
            throw new Exception('Int expected');
        }

        return $input;
    }
}