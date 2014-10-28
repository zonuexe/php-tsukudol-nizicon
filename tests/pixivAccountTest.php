<?php
namespace Tsukudol;

class pixivAccountTest extends \Tsukudol\Nizicon\TestCase
{
    public function test()
    {
        $actual = new pixivAccount(11, 'pixiv');

        $this->assertEquals('http://pixiv.me/pixiv', $actual->getUrlAsShort());
        $this->assertEquals('http://www.pixiv.net/member.php?id=11', $actual->getUrl());
    }
}
