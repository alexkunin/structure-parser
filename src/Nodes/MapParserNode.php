<?php
namespace AlexKunin\StructureParser\Nodes;

use Exception;
use AlexKunin\StructureParser\StructureParserNodeInterface;

class MapParserNode implements StructureParserNodeInterface
{
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
     * @param mixed $input
     *
     * @return mixed
     * @throws Exception
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
}