<?php
namespace Tsukudol\Nizicon;

class MemberTest extends \Tsukudol\Nizicon\TestCase
{
    public function test_find()
    {
        $minarin = Member::find("長田 美成");

        $this->assertEquals("長田 美成", $minarin->name);
        $this->assertEquals(\DateTimeImmutable::createFromFormat("Y-m-d", "1997-12-17"), $minarin->birth_day);
        $this->assertEquals("nagata_minari", $minarin->twitter);
        $this->assertNull($minarin->pixiv);
    }

    public function test_list()
    {
        $this->assertContainsOnlyInstancesOf('\Tsukudol\Nizicon\Member', Member::getList());
    }
}
