<?php declare(strict_types=1);

use Nabeghe\Arrayer\Arr;

class ArrTest extends \PHPUnit\Framework\TestCase
{
    public function testAccessible()
    {
        $this->assertTrue(Arr::accessible([]));
        $this->assertTrue(Arr::accessible([null]));
        $this->assertTrue(Arr::accessible(['nabeghe/arrayer']));
        $this->assertNotTrue(Arr::accessible(null));
        $this->assertNotTrue(Arr::accessible(0));
        $this->assertNotTrue(Arr::accessible(''));
        $this->assertNotTrue(Arr::accessible('nabeghe/arrayer'));
    }

    public function testAssign()
    {
        $data = ['key_1' => 'value_1', 'key_2' => null];
        Arr::assign($data, 'key_1', 'new_value_1', false);
        Arr::assign($data, 'key_2', 'new_value_2', false);
        Arr::assign($data, 'key_3', 'new_value_3', false);
        $this->assertSame(['key_1' => 'value_1', 'key_2' => null, 'key_3' => 'new_value_3'], $data);
    }

    public function testAdd()
    {
        $this->assertSame(['name' => 'nabeghe/arrayer'], Arr::add([], 'name', 'nabeghe/arrayer'));
    }

    public function testCast()
    {
        $this->assertSame([], Arr::cast(null));
        $this->assertSame([true], Arr::cast(true));
        $this->assertSame([false], Arr::cast(false));
        $this->assertSame([0], Arr::cast(0));
        $this->assertSame([], Arr::cast(''));
        $this->assertSame([], Arr::cast('nabeghe/arrayer'));
        $this->assertSame([], Arr::cast([]));
        $this->assertSame(['name' => 'nabeghe/arrayer'], Arr::cast(['name' => 'nabeghe/arrayer']));
        $this->assertSame(['name' => 'nabeghe/arrayer'], Arr::cast('a:1:{s:4:"name";s:15:"nabeghe/arrayer";}'));
    }

    public function testCollapse()
    {
        $data = [[1, 2, 3], [4, 5, 6], [7, 8, 9]];
        $this->assertSame([1, 2, 3, 4, 5, 6, 7, 8, 9], Arr::collapse($data));
    }

    public function testImplode()
    {
        $this->assertSame('0123456789', Arr::implode([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]));

        $this->assertSame("['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']",
            Arr::implode([0, 1, 2, 3, 4, 5, 6, 7, 8, 9], [
                'seperator' => ', ',
                'prefix' => '[',
                'suffix' => ']',
                'item_prefix' => '\'',
                'item_suffix' => '\'',
            ]));

        $this->assertSame("nabeghe/arrayer", Arr::implode([], [
            'default' => 'nabeghe/arrayer',
        ]));
    }

    public function testIncludes()
    {
        $this->assertTrue(Arr::includes([0, 1, 2, 3, 4, 5, 6, 7, 8, 9], [0, 1]));
        $this->assertFalse(Arr::includes([0, 1, 2, 3, 4, 5, 6, 7, 8, 9], -1));
    }

    public function testIncludesAny()
    {
        $this->assertTrue(Arr::includesAny([0, 1, 2, 3, 4, 5, 6, 7, 8, 9], [0, 13]));
    }

    public function testIsZeroBasedIndex()
    {
        $this->assertTrue(Arr::isZeroBasedIndex([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]));
        $this->assertTrue(Arr::isZeroBasedIndex(['nabeghe/arrayer']));
        $this->assertFalse(Arr::isZeroBasedIndex(['name' => 'nabeghe/arrayer']));
    }

    public function testMerge()
    {
        $data1 = ['key_1' => 'value_1', 'key_3' => ['key_3_1' => 'value_3_1']];

        $data2 = ['key_2' => 'value_2'];

        $data3 = ['key_3' => ['key_3_2' => 'value_3_2']];

        $expected = [
            'key_1' => 'value_1',
            'key_2' => 'value_2',
            'key_3' => ['key_3_1' => 'value_3_1', 'key_3_2' => 'value_3_2'],
        ];

        $this->assertEquals($expected, Arr::merge($data1, $data2, $data3));
    }

    public function testRemove()
    {
        $data = ['value_1', 'value_2'];

        Arr::remove($data, 'value_2');

        $this->assertEquals(['value_1'], $data);
    }

    public function testWrapEasy()
    {
        $this->assertSame([], Arr::wrapEasy([]));
        $this->assertSame([0], Arr::wrapEasy(0));
        $this->assertSame([null], Arr::wrapEasy(null));
        $this->assertSame(['nabeghe/arrayer'], Arr::wrapEasy('nabeghe/arrayer'));
        $this->assertSame(['nabeghe/arrayer'], Arr::wrapEasy(['nabeghe/arrayer']));
    }

    public function testWrapForce()
    {
        $this->assertSame([[]], Arr::wrapForce([]));
        $this->assertSame([0], Arr::wrapForce(0));
        $this->assertSame([null], Arr::wrapForce(null));
        $this->assertSame(['nabeghe/arrayer'], Arr::wrapForce('nabeghe/arrayer'));
        $this->assertSame([['nabeghe/arrayer']], Arr::wrapForce(['nabeghe/arrayer']));
    }
}