<?php
namespace Nodes;

use AlexKunin\StructureParser\Nodes\IntParserNode;
use AlexKunin\StructureParser\Nodes\ObjectParserNode;
use AlexKunin\StructureParser\Nodes\StringParserNode;
use AlexKunin\StructureParser\SimpleParsedNodeHost;
use Exception;
use PHPUnit\Framework\TestCase;

class ObjectParserNodeTest extends TestCase
{
    /**
     * @var ObjectParserNode
     */
    private $uut;

    public function setUp()
    {
        $this->uut = new ObjectParserNode(
            SimpleParsedNodeHost::class,
            [
                'a' => new IntParserNode(),
                'b' => new StringParserNode(),
            ]
        );
    }

    public function testValidInput()
    {
        $r = $this->uut->parse([
            'a' => 1,
            'b' => 'a',
        ]);

        $this->assertEquals(1, $r->a);
        $this->assertEquals('a', $r->b);
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
            [[], Exception::class],
            [['a' => 'a', 'b' => 1], Exception::class],
            [['a' => '1'], Exception::class],
        ];
    }
}
