<?php namespace AlexKunin\StructureParser;

use Exception;

trait SimpleParsedNode
{
    /**
     * @var array
     */
    private $cache = [];

    /**
     * @param StructureParserNodeInterface[] $properties
     * @param array                          $input
     *
     * @throws Exception
     */
    public function __construct(array $properties, array $input)
    {
        foreach ($properties as $property => $parser) {
            if (!array_key_exists($property, $input)) {
                throw new Exception('Input missing property: ' . var_export($property, true));
            }

            $this->cache[$property] = $properties[$property]->parse($input[$property]);
        }
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
        if (!array_key_exists($property, $this->cache)) {
            throw new Exception('Unknown property: ' . var_export($property, true));
        }

        return $this->cache[$property];
    }
}