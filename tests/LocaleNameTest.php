<?php
namespace Tsukudol;

final class LocaleNameTest extends \Tsukudol\Nizicon\TestCase
{
    public function test()
    {
        $src = [
            ['ja-Jpan', ["family" => "重音",   "given" => "テト"]],
            ['ja-Hira', ["family" => "かさね", "given" => "てと"]],
            ['en',      ["family" => "Kasane", "given" => "Teto"]],
        ];
        $actual = new LocaleName($src);

        $expected_family = [
            ['ja-Jpan', '重音'],
            ['ja-Hira', 'かさね'],
            ['en',      'Kasane'],
        ];
        $this->assertEquals($expected_family, $actual->family);
        $this->assertEquals("重音",   $actual->searchValue('family', ['language' => 'ja']));
        $this->assertEquals("重音",   $actual->searchValue('family', ['language' => 'ja', 'script' => 'Jpan']));
        $this->assertEquals("Kasane", $actual->searchValue('family', ['language' => 'en']));

        $this->assertEquals("重音テト",   $actual->getNameIn('ja-Jpan'));
        $this->assertEquals("重音・テト", $actual->getNameIn('ja-Jpan', ['separator' => '・']));
        $this->assertEquals("Teto Kasane", $actual->getNameIn('en'));
    }
}
