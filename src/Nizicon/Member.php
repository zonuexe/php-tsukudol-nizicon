<?php
namespace Tsukudol\Nizicon;
use \Tsukudol\LocaleName;

/**
 * Member of Niji No Conquistador
 *
 * @package Tsukudol
 * @author  tadsan@zonu.me
 * @license MIT
 */
final class Member
{
    /**
     * @var  Member[]
     * @link http://pixiv-pro.com/2zicon/profile
     */
    private static $members = null;

    /** @var LocaleName */
    private $names;

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
     * @param string      $names
     * @param string[]    $nick_names
     * @param string      $birth_day
     * @param int         $twitter
     * @param string[]    $calls
     * @param string|null $pixiv
     */
    private function __construct(array $names, array $nick_names, $birth_day, array $calls, $twitter, $pixiv)
    {
        $this->names      = new LocaleName($names);
        $this->nick_names = $nick_names;
        $this->birth_day  = \DateTimeImmutable::createFromFormat('Y-m-d', $birth_day);
        $this->calls      = $calls;
        $this->twitter    = $twitter;
        $this->pixiv      = $pixiv;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * @param  $search_name
     * @return bool
     */
    public function isMyName($search_name)
    {
        foreach ($this->names->dumpNames() as $lang_name) {
            list($lang, $name) = $lang_name;

            if (false
              || $search_name === $name['given']
              || $search_name === $name['family']
              || $search_name === $name['family'].$name['given']
              || $search_name === $name['given'].$name['family']
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * @link http://pixiv-pro.com/2zicon/profile
     */
    private static function init()
    {
        if (self::$members === null) {
            self::$members = [
                new Member(
                    [
                        ['ja-Jpan', ['family' => '長田',   'given' => '美成']],
                        ['ja-Hira', ['family' => 'ながた', 'given' => 'みなり']],
                        ['en-Latn', ['family' => 'Nagata', 'given' => 'Minari']],
                    ],
                    [
                        ['ja-Jpan', ['nickname' => 'みなりん']],
                    ],
                    '1997-12-17',
                    [
                        ['lang' => 'ja-Jpan', ]
                    ],
                    2653040568,
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '重松',     'given' => '佑佳']],
                        ['ja-Hira', ['family' => 'しげまつ', 'given' => 'ゆか']],
                        ['en-Latn', ['family' => 'Nagata',  'given' => 'Minari']],
                    ],
                    [
                        ['ja-Jpan', ['nickname' => 'しげちー']],
                    ],
                    '1996-05-20',
                    [],
                    2653112936,
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '奥村',     'given' => '野乃花']],
                        ['ja-Hira', ['family' => 'おくむら', 'given' => 'ののか']],
                        ['en-Latn', ['family' => 'Okumura',  'given' => 'Nonoka']],
                    ],
                    [
                        ['ja-Jpan', ['nickname' => 'ののた']]
                    ],
                    '2001-01-04',
                    [],
                    2653101776,
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '木下',      'given' => 'ひより']],
                        ['ja-Hira', ['family' => 'きのした',  'given' => 'ひより']],
                        ['en-Latn', ['family' => 'Kinoshita', 'given' => 'Hiyori']],
                    ],
                    [
                        ['ja-Jpan', ['nickname' => 'ひよりん']]
                    ],
                    '1997-12-09',
                    [],
                    2653072658,
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '陶山',   'given' => '恵実里']],
                        ['ja-Hira', ['family' => 'すやま', 'given' => 'えみり']],
                        ['en-Latn', ['family' => 'Suyama', 'given' => 'Emiri']],
                    ],
                    [
                        ['ja-Jpan', ['nickname' => 'えみりぃ']],
                    ],
                    '1999-05-26',
                    [],
                    2653083494,
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '中村',     'given' => '朱里']],
                        ['ja-Hira', ['family' => 'なかやま', 'given' => 'あかり']],
                        ['en-Latn', ['family' => 'Nakayama', 'given' => 'Akari']],
                    ],
                    [
                        ['ja-Jpan', ['nickname' => 'あかりん']],
                    ],
                    '1998-01-30',
                    [],
                    2653083494,
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '西',    'given' => '七海']],
                        ['ja-Hira', ['family' => 'にし',  'given' => 'ななみ']],
                        ['en-Latn', ['family' => 'Nishi', 'given' => 'Nanami']],
                    ],
                    [
                        ['ja-Jpan', ['nickname' => 'ななぴ']]
                    ],
                    '1996-10-09',
                    [],
                    2653106774,
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '根本',    'given' => '凪']],
                        ['ja-Hira', ['family' => 'ねもと',  'given' => 'なぎ']],
                        ['en-Latn', ['family' => 'Nemoto', 'given' => 'Nagi']],
                    ],
                    [
                        ['ja-Jpan', ['nickname' => 'ねも']],
                    ],
                    '1999-03-15',
                    [],
                    2653091701,
                    11797412
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '的場',   'given' => '華鈴']],
                        ['ja-Hira', ['family' => 'まとば', 'given' => 'かりん']],
                        ['en-Latn', ['family' => 'Matoba', 'given' => 'Karin']],
                    ],
                    [
                        ['ja-Jpan', ['nickname' => 'かりんさま']],
                        ['ja-Jpan', ['nickname' => 'かりん']],
                    ],
                    '2000-12-30',
                    [],
                    2653077656,
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '吉村',      'given' => '菜々']],
                        ['ja-Hira', ['family' => 'よしむら',  'given' => 'なな']],
                        ['en-Latn', ['family' => 'Yoshimura', 'given' => 'Nana']],
                    ],
                    [
                        ['ja-Jpan', ['nickname' => 'なぁな']],
                    ],
                    '1999-08-02',
                    [],
                    2653087986,
                    null
                ),
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

        $normalized = str_replace(['', ' ', "\n", "\r", "\t"], '', $name);

        foreach (self::$members as $member) {
            if ($member->isMyName($normalized)) {
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
