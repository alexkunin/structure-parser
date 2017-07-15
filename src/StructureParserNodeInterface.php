<?php
namespace AlexKunin\StructureParser;

interface StructureParserNodeInterface
{
    /**
     * @param mixed $input
     *
     * @return mixed
     */
    public function parse($input);
}