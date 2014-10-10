<?php
namespace Tsukudol;

class NiziconTest extends \Tsukudol\Nizicon\TestCase
{
    public function test_find()
    {
        $minarin = Nizicon::member("長田 美成");

        $this->assertInternalType("string", $minarin->name);
        $this->assertInstanceOf('\DateTimeImmutable', $minarin->birth_day);
    }

    public function test_list()
    {
        $this->assertContainsOnlyInstancesOf('\Tsukudol\Nizicon\Member', Nizicon::members());
    }
}
