<?php
namespace Nodes;

use AlexKunin\StructureParser\Nodes\FloatParserNode;
use Exception;
use PHPUnit\Framework\TestCase;

class FloatParserNodeTest extends TestCase
{
    /**
     * @var FloatParserNode
     */
    private $uut;

    public function setUp()
    {
        $this->uut = new FloatParserNode();
    }

    public function testValidInput()
    {
        $this->assertEquals(1.1, $this->uut->parse(1.1));
        $this->assertEquals(1e1, $this->uut->parse(1e1));
    }

    /**
     * @dataProvider provideDataForWrongInput
     */
    public function testWrongTypeInput($input, $exception)
    {
        $this->expectException($exception);
        $this->uut->parse($input);
    }

    public function provideDataForWrongInput()
    {
        return [
            [null, Exception::class],
            [true, Exception::class],
            [1, Exception::class],
            ['1.1', Exception::class],
        ];
    }
}
