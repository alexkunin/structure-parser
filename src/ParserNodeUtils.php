<?php
namespace AlexKunin\StructureParser;

trait ParserNodeUtils
{
    /**
     * @var string|null
     */
    protected $comment = null;

    /**
     * @param string $value
     *
     * @return StructureParserNodeInterface
     */
    public function setComment($value)
    {
        $this->comment = $value;
        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this;
    }

    /**
     * @return string
     */
    public function formatComment()
    {
        if ($this->comment === null) {
            return '';
        }

        return preg_replace('/^/m',' // ', $this->comment);
    }

    /**
     * @param string $text
     * @param int    $shift
     *
     * @return string
     */
    protected function indent($text, $shift = 4)
    {
        return preg_replace('/^/m', '\1' . str_repeat(' ', $shift), $text);
    }
}