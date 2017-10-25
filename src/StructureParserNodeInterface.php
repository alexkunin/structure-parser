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

    /**
     * @param string $value
     *
     * @return StructureParserNodeInterface
     */
    public function setComment($value);

    /**
     * @return string
     */
    public function formatComment();

    /**
     * @return string
     */
    public function getReadableDescription();
}