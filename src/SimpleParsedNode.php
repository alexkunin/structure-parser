<?php namespace AlexKunin\StructureParser;

use Exception;

trait SimpleParsedNode
{
    /**
     * @var StructureParserNodeInterface[]
     */
    private $properties;

    /**
     * @var array
     */
    private $cache = [];

    /**
     * @var array
     */
    private $input;

    /**
     * @param StructureParserNodeInterface[] $properties
     * @param array                          $input
     */
    public function __construct(array $properties, array $input)
    {
        $this->properties = $properties;
        $this->input = $input;
    }

    /**
     * @return array
     */
    function __debugInfo()
    {
        return array_reduce(
            array_keys($this->properties),
            function (array $result, $property) {
                $result[$property] = $this->__get($property);
                return $result;
            },
            []
        );
    }

    /**
     * @param string $property
     *
     * @return mixed
     * @throws Exception
     */
    public function __get($property)
    {
        if (!array_key_exists($property, $this->properties)) {
            throw new Exception('Unknown property: ' . var_export($property, true));
        }

        if (!array_key_exists($property, $this->input)) {
            throw new Exception('Input missing property: ' . var_export($property, true));
        }

        if (!array_key_exists($property, $this->cache)) {
            $this->cache[$property] = $this->properties[$property]->parse($this->input[$property]);
        }

        return $this->cache[$property];
    }
}