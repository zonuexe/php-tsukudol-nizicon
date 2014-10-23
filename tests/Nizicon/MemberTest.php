<?php
namespace Tsukudol\Nizicon;

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

        $this->assertEquals($expected_minarin_name, $minarin->names->dumpNames());
        $this->assertEquals(\DateTimeImmutable::createFromFormat("Y-m-d", "1997-12-17"), $minarin->birth_day);
        $this->assertEquals(2653040568, $minarin->twitter);
        $this->assertNull($minarin->pixiv);
    }

    public function test_list()
    {
        $this->assertContainsOnlyInstancesOf('\Tsukudol\Nizicon\Member', Member::getList());
    }
}
