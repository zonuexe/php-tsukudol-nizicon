<?php
namespace Tsukudol;

final class LocaleTestKlass extends LocaleValue
{
    protected $foo = [];
    protected $bar = [];
}

final class LocaleValueTest extends \Tsukudol\Nizicon\TestCase
{
    public function test()
    {
        $src = [
            ['ja-Jpan', ["foo" => "ふー1", "bar" => "ばー1"]],
            ['ja-Jpan', ["foo" => "ふー2", "bar" => "ばー2"]],
            ['ja-Hira', ["foo" => "ふー3", "bar" => "ばー3"]],
            ['en',      ["foo" => "fooo!", "bar" => "baar!"]],
        ];
        $actual = new LocaleTestKlass($src);

        $expected_foo = [
            ['ja-Jpan', 'ふー1'],
            ['ja-Jpan', 'ふー2'],
            ['ja-Hira', 'ふー3'],
            ['en',      'fooo!'],
        ];
        $this->assertEquals($expected_foo, $actual->foo);
        $this->assertEquals("ばー1", $actual->searchValue('bar', ['language' => 'ja']));
        $this->assertEquals("ばー1", $actual->searchValue('bar', ['language' => 'ja', 'script' => 'Jpan']));
        $this->assertEquals("ばー3", $actual->searchValue('bar', ['language' => 'ja', 'script' => 'Hira']));
        $this->assertEquals("baar!", $actual->searchValue('bar', ['language' => 'en']));
    }
}
