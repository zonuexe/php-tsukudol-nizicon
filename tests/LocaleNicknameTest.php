<?php
namespace Tsukudol;

final class LocaleNicknameTest extends \Tsukudol\Nizicon\TestCase
{
    public function test()
    {
        $src = [
            ['ja-Jpan', ["nick_name" => "てと"]],
            ['ja-Hira', ["nick_name" => "てと"]],
            ['en',      ["nick_name" => "teto"]],
        ];
        $actual = new LocaleNickname($src);

        $expected_nick_name = [
            ['ja-Jpan', 'てと'],
            ['ja-Hira', 'てと'],
            ['en',      'teto'],
        ];
        $this->assertEquals($expected_nick_name, $actual->nick_name);
        $this->assertEquals("てと", $actual->searchValue('nick_name', ['language' => 'ja']));
        $this->assertEquals("てと", $actual->searchValue('nick_name', ['language' => 'ja', 'script' => 'Jpan']));
        $this->assertEquals("teto", $actual->searchValue('nick_name', ['language' => 'en']));

        $this->assertEquals("てと", $actual->getNameIn('ja-Jpan'));
        $this->assertEquals("てと", $actual->getNameIn('ja-Jpan', ['separator' => '・']));
        $this->assertEquals("teto", $actual->getNameIn('en'));
    }
}
