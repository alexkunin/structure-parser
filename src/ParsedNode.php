<?php namespace AlexKunin\StructureParser;

trait ParsedNode
{
    use SimpleParsedNode;

    /**
     * @param StructureParser $cp
     *
     * @return StructureParserNodeInterface
     */
    abstract public static function getDefinition(StructureParser $cp);
}