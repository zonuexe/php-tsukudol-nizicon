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

        $this->assertInstanceOf('\Tsukudol\LocaleName', $member->names);
        $this->assertInstanceOf('\DateTimeImmutable', $member->birth_day);
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

        $this->assertContainsOnlyInstancesOf('\Tsukudol\Nizicon\Member', $actual);
        $this->assertCount(10, $actual);
    }
}
