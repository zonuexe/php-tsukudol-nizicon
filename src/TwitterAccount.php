<?php
namespace Tsukudol;

/**
 * Twitter Account
 *
 * @package Tsukudol
 * @author  tadsan@zonu.me
 * @license MIT
 *
 * @property-read string $user_id
 * @property-read string $screen_name
 */
class TwitterAccount
{
    /** @var string */
    private $user_id;

    /** @var string */
    private $screen_name;

    /**
     * @param array $values
     */
    public function __construct($user_id, $screen_name)
    {
        if (!is_numeric($user_id))    { throw new \LogicException; }
        if (!is_string($screen_name)) { throw new \LogicException; }

        $this->user_id = $user_id;
        $this->screen_name = $screen_name;
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
        return 'https://twitter.com/account/redirect_by_id/' . $this->user_id;
    }

    /**
     * @return string
     */
    public function getUrlAsShort()
    {
        return 'https://twitter.com/' . $this->screen_name;
    }
}
