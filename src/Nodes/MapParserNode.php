<?php
namespace AlexKunin\StructureParser\Nodes;

use AlexKunin\StructureParser\ParserNodeUtils;
use AlexKunin\StructureParser\StructureParserNodeInterface;
use Exception;

class MapParserNode implements StructureParserNodeInterface
{
    use ParserNodeUtils;

    /**
     * @var StructureParserNodeInterface
     */
    private $key;

    /**
     * @var StructureParserNodeInterface
     */
    private $value;

    /**
     * @param StructureParserNodeInterface $key
     * @param StructureParserNodeInterface $value
     */
    public function __construct(StructureParserNodeInterface $key, StructureParserNodeInterface $value)
    {
        $this->key = $key;
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
            $result[$this->key->parse($key)] = $this->value->parse($value);
        }

        return $result;
    }

    /**
     * @inheritdoc
     */
    public function getReadableDescription()
    {
        $result = '{' . PHP_EOL;

        $result .= $this->indent($this->key->getReadableDescription() . ': ' . $this->value->getReadableDescription()) . ',' . PHP_EOL;
        $result .= $this->indent('...') . PHP_EOL;

        $result .= '}';

        return $result;
    }
}