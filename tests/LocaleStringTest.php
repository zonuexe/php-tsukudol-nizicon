<?php
namespace Tsukudol;

final class LocaleStringTest extends \Tsukudol\Nizicon\TestCase
{
    public function test()
    {
        $src = [
            'ja' => "にほんご",
            'en' => "English",
        ];
        $actual = new LocaleString($src);

        $this->assertEquals("にほんご", $actual->ja);
        $this->assertEquals("English", $actual->en);
    }

    public function test_only_not_default_English_raise_LogicException()
    {
        $this->setExpectedException('\LogicException');

        new LocaleString(['en' => "raise Error"]);
    }

    public function test_default_and_only_English()
    {
        $actual = new LocaleString(['en' => "Don't raise Error"], 'en');

        $this->assertEquals("Don't raise Error", $actual->en);

        $this->setExpectedException('\OutOfRangeException');
        $actual->ja;
    }
}
