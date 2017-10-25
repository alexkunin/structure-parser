<?php
namespace AlexKunin\StructureParser\Nodes;

use AlexKunin\StructureParser\ParserNodeUtils;
use AlexKunin\StructureParser\StructureParserNodeInterface;
use Exception;

class VectorParserNode implements StructureParserNodeInterface
{
    use ParserNodeUtils;

    /**
     * @var StructureParserNodeInterface
     */
    private $value;

    /**
     * @param StructureParserNodeInterface $value
     */
    public function __construct(StructureParserNodeInterface $value)
    {
        $this->value = $value;
    }

    /**
     * @inheritdoc
     */
    public function parse($input)
    {
        if (!is_array($input)) {
            throw new Exception('Array expected');
        }

        $result = [];

        foreach ($input as $key => $value) {
            $result[] = $this->value->parse($value);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function getReadableDescription()
    {
        $result = '[' . PHP_EOL;

        $result .= $this->indent($this->value->getReadableDescription()) . ',' . PHP_EOL;
        $result .= $this->indent('...') . PHP_EOL;

        $result .= ']';

        return $result;
    }
}