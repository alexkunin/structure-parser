<?php
namespace AlexKunin\StructureParser\Nodes;

use Exception;
use AlexKunin\StructureParser\StructureParserNodeInterface;

class StringParserNode implements StructureParserNodeInterface
{
    /**
     * @param mixed $input
     *
     * @return mixed
     * @throws Exception
     */
    public function parse($input)
    {
        if (!is_string($input)) {
            throw new Exception('String expected');
        }

        return $input;
    }
}