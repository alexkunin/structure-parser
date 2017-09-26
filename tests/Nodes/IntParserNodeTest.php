<?php
namespace Nodes;

use AlexKunin\StructureParser\Nodes\IntParserNode;
use Exception;
use PHPUnit\Framework\TestCase;

class IntParserNodeTest extends TestCase
{
    /**
     * @var IntParserNode
     */
    private $uut;

    public function setUp()
    {
        $this->uut = new IntParserNode();
    }

    public function testValidInput()
    {
        $this->assertEquals(1, $this->uut->parse(1));
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
            [1.1, Exception::class],
            ['1', Exception::class],
        ];
    }
}
