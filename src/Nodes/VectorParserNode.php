<?php
namespace AlexKunin\StructureParser\Nodes;

use Exception;
use AlexKunin\StructureParser\StructureParserNodeInterface;

class VectorParserNode implements StructureParserNodeInterface
{
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
            $result[] = $this->value->parse($value);
        }

        return $result;
    }
}