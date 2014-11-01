<?php
namespace Tsukudol\Nizicon;

use Tsukudol\TwitterAccount;

class MemberTest extends \Tsukudol\Nizicon\TestCase
{
    public function test_find()
    {
        $minarin = Member::find("長田 美成");

        $expected_minarin_name = [
            ['ja-Jpan', ['family' => "長田", "given" => "美成"]],
            ['ja-Hira', ['family' => "ながた", "given" => "みなり"]],
            ['en-Latn', ['family' => "Nagata", "given" => "Minari"]],
        ];
        $expected_birthday = \DateTimeImmutable::createFromFormat(\DateTime::W3C, "1997-12-17T00:00:00+09:00");

        $this->assertEquals($expected_minarin_name, $minarin->names->dumpNames());
        $this->assertEquals($expected_birthday, $minarin->birth_day);
        $this->assertEquals(new TwitterAccount('2653040568', 'nagata_minari'), $minarin->twitter);
        $this->assertNull($minarin->pixiv);

        $this->assertTrue($minarin->isMyName('みなり'));
        $this->assertTrue($minarin->isMyName('みなりん'));
        $this->assertTrue($minarin->isMyName('nagata_minari'));
        $this->assertFalse($minarin->isMyName('なぎ'));
    }

    public function test_list()
    {
        $this->assertContainsOnlyInstancesOf('\Tsukudol\Nizicon\Member', Member::getList());
    }
}
