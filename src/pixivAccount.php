<?php
namespace Tsukudol;

/**
 * pixiv Account
 *
 * @package Tsukudol
 * @author  tadsan@zonu.me
 * @license MIT
 */
class pixivAccount
{
    /** @var int */
    private $id;

    /** @var string */
    private $account;

    /**
     * @param array $values
     */
    public function __construct($id, $account)
    {
        if (!is_int($id))         { throw new \LogicException; }
        if (!is_string($account)) { throw new \LogicException; }

        $this->id = $id;
        $this->account = $account;
    }

    /**
     * @param  string $lang
     * @return string
     * @throws \OutOfRangeException
     */
    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * @param  $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->$name);
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return 'http://www.pixiv.net/member.php?id=' . $this->id;
    }

    /**
     * @return string
     */
    public function getUrlAsShort()
    {
        return 'http://pixiv.me/' . $this->account;
    }
}
