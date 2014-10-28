<?php
namespace Tsukudol;

class TwitterAccountTest extends \Tsukudol\Nizicon\TestCase
{
    public function test()
    {
        $actual = new TwitterAccount(12985912, 'pixiv');

        $this->assertEquals('https://twitter.com/pixiv', $actual->getUrlAsShort());
        $this->assertEquals('https://twitter.com/account/redirect_by_id/12985912', $actual->getUrl());
    }
}
