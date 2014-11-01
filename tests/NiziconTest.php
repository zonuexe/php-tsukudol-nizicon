<?php
namespace Tsukudol;

class NiziconTest extends \Tsukudol\Nizicon\TestCase
{
    /**
     * @dataProvider memberNameProvider
     */
    public function test_member($name)
    {
        $member = Nizicon::member($name);

        $this->assertInstanceOf('\Tsukudol\LocaleName',     $member->names);
        $this->assertInstanceOf('\Tsukudol\LocaleNickName', $member->nick_names);
        $this->assertInstanceOf('\DateTimeImmutable',       $member->birth_day);
        $this->assertInternalType('array',                  $member->calls);
        $this->assertInstanceOf('\Tsukudol\TwitterAccount', $member->twitter);

        if ($member->pixiv) {
            $this->assertInstanceOf('\Tsukudol\pixivAccount', $member->pixiv);
        } else {
            $this->assertNull($member->pixiv);
        }
    }

    public function memberNameProvider()
    {
        return [
            ['長田'],
            ['凪'],
        ];
    }

    public function test_members()
    {
        $actual = Nizicon::members();

        $this->assertInstanceOf('\Tsukudol\Nizicon', $actual);
        $this->assertContainsOnlyInstancesOf('\Tsukudol\Nizicon\Member', $actual->getIterator());

        foreach ($actual as $member) {
            $this->assertInstanceOf('\Tsukudol\Nizicon\Member', $member);
        }

        $this->assertCount(11, $actual);
    }
}
