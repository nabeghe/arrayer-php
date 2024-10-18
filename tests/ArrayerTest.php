<?php declare(strict_types=1);

use Nabeghe\Arrayer\Arrayer;

class ArrayerTest extends \PHPUnit\Framework\TestCase
{
    public const DATA = [
        'key_1' => 'value_1',
        'key_2' => 'value_2',
        'key_3' => 'value_3',
    ];

    public function testOffsetGet()
    {
        $data = new Arrayer(self::DATA);
        $this->assertSame('value_1', $data['key_1']);
    }

    public function testOffsetSet()
    {
        $data = new Arrayer(json_encode(self::DATA));
        $data['key_1'] = 'new_value_1';
        $this->assertSame('new_value_1', $data['key_1']);
    }

    public function testOffsetUnnset()
    {
        $data = new Arrayer(json_encode(self::DATA));
        $this->assertTrue(isset($data['key_1']));
        unset($data['key_1']);
        $this->assertFalse(isset($data['key_1']));
    }

    public function testJsonSerialize()
    {
        $data = new Arrayer(json_encode(self::DATA));
        $this->assertSame(json_encode(self::DATA), json_encode($data));
    }

    public function testMerge()
    {
        $data = new Arrayer(json_encode(self::DATA));

        $expected = self::DATA;
        unset($expected['key_3']);

        $this->assertSame($expected, $data->except(['key_3'])->data);
    }
}