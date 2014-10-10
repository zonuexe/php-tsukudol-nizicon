<?php
namespace Tsukudol\Nizicon;

/**
 * Member of Niji No Conquistador
 *
 * @package Tsukudol
 * @author  tadsan@zonu.me
 * @license MIT
 */
final class Member
{
    /** @var Member[] */
    private static $members = null;

    /** @var string */
    private $name;

    /** @var string[] */
    private $nick_names;

    /** @var \DateTimeImmutable */
    private $birth_day;

    /** @var string[] */
    private $calls;

    /** @var string */
    private $twitter;

    /** @var string */
    private $pixiv;

    /**
     * @param string      $name
     * @param string[]    $nick_names
     * @param string      $birth_day
     * @param string      $twitter
     * @param string[]    $calls
     * @param string|null $pixiv
     */
    private function __construct($name, array $nick_names, $birth_day, array $calls, $twitter, $pixiv)
    {
        $this->name       = $name;
        $this->nick_names = $nick_names;
        $this->birth_day  = \DateTimeImmutable::createFromFormat("Y-m-d", $birth_day);
        $this->calls      = $calls;
        $this->twitter    = $twitter;
        $this->pixiv      = $pixiv;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    private static function init()
    {
        if (self::$members === null) {
            self::$members = [
                new Member("長田 美成", ["みなりん"], "1997-12-17", [], "nagata_minari",   null),
                new Member("重松 佑佳", ["しげちー"], "1996-05-20", [], "shigematsu_yuka", null),
            ];
        }
    }

    /**
     * @param  $name
     * @return Member
     * @throws \OutOfBoundsException
     */
    public static function find($name)
    {
        self::init();

        foreach (self::$members as $member) {
            if ($member->name === $name) {
                return $member;
            }
        }

        throw new \OutOfBoundsException;
    }

    /**
     * @return Member[]
     */
    public static function getList()
    {
        self::init();

        return self::$members;
    }
}
