<?php
namespace Tsukudol\Nizicon;
use Tsukudol\LocaleName;
use Tsukudol\LocaleNickname;
use Tsukudol\TwitterAccount;
use Tsukudol\pixivAccount;

/**
 * Member of Niji No Conquistador
 *
 * @package Tsukudol
 * @author  tadsan@zonu.me
 * @license MIT
 *
 * @property-read LocaleName         $names
 * @property-read LocaleNickname     $nick_names
 * @property-read \DateTimeImmutable $birth_day
 * @property-read string[]           $calls
 * @property-read string             $blog_url
 * @property-read string[]           $head_shot_url
 * @property-read TwitterAccount     $twitter
 * @property-read pixivAccount       $pixiv
 */
class Member
{
    /**
     * @var  Member[]
     * @link http://pixiv-pro.com/2zicon/profile
     */
    private static $members = null;

    /** @var LocaleName */
    private $names;

    /** @var LocaleNickname */
    private $nick_names;

    /** @var \DateTimeImmutable */
    private $birth_day;

    /** @var string[] */
    private $calls;

    /** @var string */
    private $blog_url;

    /** @var string[] */
    private $head_shot_urls;

    /** @var \Tsukudol\TwitterAccount */
    private $twitter;

    /** @var \Tsukudol\pixivAccount */
    private $pixiv;

    /**
     * @param LocaleName        $names
     * @param LocaleNickname    $nick_names
     * @param string            $birth_day
     * @param TwitterAccount    $twitter
     * @param string[]          $calls
     * @param pixivAccount|null $pixiv
     */
    private function __construct(
        array $names,
        array $nick_names,
        $birth_day,
        array $calls,
        $blog_url,
        array $head_shot_urls,
        $twitter,
        $pixiv
    ) {
        $this->names      = new LocaleName($names);
        $this->nick_names = new LocaleNickname($nick_names);
        $this->birth_day  = \DateTimeImmutable::createFromFormat(\DateTime::W3C, $birth_day.'T00:00:00+09:00');
        $this->calls      = $calls;
        $this->blog_url   = $blog_url;
        $this->head_shot_urls = $head_shot_urls;
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
        if ($this->twitter && $search_name === $this->twitter->screen_name) {
            return true;
        }

        if ($this->pixiv && $search_name === $this->pixiv->account) {
            return true;
        }

        foreach ($this->names->dumpNames() as $lang_name) {
            list($_lang, $name) = $lang_name;

            if (false
              || $search_name === $name['given']
              || $search_name === $name['family']
              || $search_name === $name['family'].$name['given']
              || $search_name === $name['given'].$name['family']
            ) {
                return true;
            }
        }

        foreach ($this->nick_names->dumpNames() as $lang_name) {
            list($_lang, $name) = $lang_name;

            if ($search_name === $name['nick_name']) {
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
                        ['ja-Jpan', ['nick_name' => 'みなりん']],
                    ],
                    '1997-12-17',
                    [
                        ['lang' => 'ja-Jpan', ]
                    ],
                    'http://ameblo.jp/2zicon/theme-10083290600.html',
                    ['http://pixiv-pro.com/2zicon/wp-content/uploads/2014/07/nagata-600x620.jpg'],
                    new TwitterAccount('2653040568', 'nagata_minari'),
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '重松',     'given' => '佑佳']],
                        ['ja-Hira', ['family' => 'しげまつ', 'given' => 'ゆか']],
                        ['en-Latn', ['family' => 'Nagata',   'given' => 'Minari']],
                    ],
                    [
                        ['ja-Jpan', ['nick_name' => 'しげちー']],
                    ],
                    '1996-05-20',
                    [],
                    'http://ameblo.jp/2zicon/theme-10083290705.html',
                    ['http://pixiv-pro.com/2zicon/wp-content/uploads/2014/07/shigematsu-600x620.jpg'],
                    new TwitterAccount('2653112936', 'shigematsu_yuka'),
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '奥村',     'given' => '野乃花']],
                        ['ja-Hira', ['family' => 'おくむら', 'given' => 'ののか']],
                        ['en-Latn', ['family' => 'Okumura',  'given' => 'Nonoka']],
                    ],
                    [
                        ['ja-Jpan', ['nick_name' => 'ののた']]
                    ],
                    '2001-01-04',
                    [],
                    'http://ameblo.jp/2zicon/theme-10083290716.html',
                    ['http://pixiv-pro.com/2zicon/wp-content/uploads/2014/07/okumura-600x620.jpg'],
                    new TwitterAccount('2653101776', 'okumura_nonoka'),
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '木下',      'given' => 'ひより']],
                        ['ja-Hira', ['family' => 'きのした',  'given' => 'ひより']],
                        ['en-Latn', ['family' => 'Kinoshita', 'given' => 'Hiyori']],
                    ],
                    [
                        ['ja-Jpan', ['nick_name' => 'ひよりん']]
                    ],
                    '1997-12-09',
                    [],
                    'http://ameblo.jp/2zicon/theme-10083290721.html',
                    ['http://pixiv-pro.com/2zicon/wp-content/uploads/2014/07/kinoshita-600x620.jpg'],
                    new TwitterAccount('2653072658', 'kinosita_hiyori'),
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '陶山',   'given' => '恵実里']],
                        ['ja-Hira', ['family' => 'すやま', 'given' => 'えみり']],
                        ['en-Latn', ['family' => 'Suyama', 'given' => 'Emiri']],
                    ],
                    [
                        ['ja-Jpan', ['nick_name' => 'えみりぃ']],
                    ],
                    '1999-05-26',
                    [],
                    'http://ameblo.jp/2zicon/theme-10083290724.html',
                    ['http://pixiv-pro.com/2zicon/wp-content/uploads/2014/07/suyama-600x620.jpg'],
                    new TwitterAccount('2653083494', 'suyama_emiri'),
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '中村',     'given' => '朱里']],
                        ['ja-Hira', ['family' => 'なかむら', 'given' => 'あかり']],
                        ['en-Latn', ['family' => 'Nakamura', 'given' => 'Akari']],
                    ],
                    [
                        ['ja-Jpan', ['nick_name' => 'あかりん']],
                    ],
                    '1998-01-30',
                    [],
                    'http://ameblo.jp/2zicon/theme-10083290728.html',
                    ['http://pixiv-pro.com/2zicon/wp-content/uploads/2014/07/nakamura-600x620.jpg'],
                    new TwitterAccount('2653083494', 'nakamura_akari'),
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '西',    'given' => '七海']],
                        ['ja-Hira', ['family' => 'にし',  'given' => 'ななみ']],
                        ['en-Latn', ['family' => 'Nishi', 'given' => 'Nanami']],
                    ],
                    [
                        ['ja-Jpan', ['nick_name' => 'ななぴ']]
                    ],
                    '1996-10-09',
                    [],
                    'http://ameblo.jp/2zicon/theme-10083290730.html',
                    ['http://pixiv-pro.com/2zicon/wp-content/uploads/2014/07/nishi-600x620.jpg'],
                    new TwitterAccount('2653106774', 'nishi_nanami'),
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '根本',    'given' => '凪']],
                        ['ja-Hira', ['family' => 'ねもと',  'given' => 'なぎ']],
                        ['en-Latn', ['family' => 'Nemoto',  'given' => 'Nagi']],
                    ],
                    [
                        ['ja-Jpan', ['nick_name' => 'ねも']],
                    ],
                    '1999-03-15',
                    [],
                    'http://ameblo.jp/2zicon/theme-10083290733.html',
                    ['http://pixiv-pro.com/2zicon/wp-content/uploads/2014/07/nemoto-600x620.jpg'],
                    new TwitterAccount('2653091701', 'nemoto_nagi'),
                    new pixivAccount(11797412, 'nemoto_nagi')
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '的場',   'given' => '華鈴']],
                        ['ja-Hira', ['family' => 'まとば', 'given' => 'かりん']],
                        ['en-Latn', ['family' => 'Matoba', 'given' => 'Karin']],
                    ],
                    [
                        ['ja-Jpan', ['nick_name' => 'かりんさま']],
                        ['ja-Jpan', ['nick_name' => 'かりん']],
                    ],
                    '2000-12-30',
                    [],
                    'http://ameblo.jp/2zicon/theme-10083290734.html',
                    ['http://pixiv-pro.com/2zicon/wp-content/uploads/2014/07/matoba-600x620.jpg'],
                    new TwitterAccount('2653077656', 'matoba_karin'),
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '吉村',      'given' => '菜々']],
                        ['ja-Hira', ['family' => 'よしむら',  'given' => 'なな']],
                        ['en-Latn', ['family' => 'Yoshimura', 'given' => 'Nana']],
                    ],
                    [
                        ['ja-Jpan', ['nick_name' => 'なぁな']],
                    ],
                    '1999-08-02',
                    [],
                    'http://ameblo.jp/2zicon/theme-10083290737.html',
                    ['http://pixiv-pro.com/2zicon/wp-content/uploads/2014/07/yoshimura-600x620.jpg'],
                    new TwitterAccount('2653087986', 'yoshimura_nana'),
                    null
                ),
                new Member(
                    [
                        ['ja-Jpan', ['family' => '鶴見',     'given' => '萌']],
                        ['ja-Hira', ['family' => 'つるみ',   'given' => 'もえ']],
                        ['en-Latn', ['family' => 'Tsurumi',  'given' => 'Moe']],
                    ],
                    [
                        ['ja-Jpan', ['nick_name' => 'もえ']]
                    ],
                    '1996-12-05',
                    [],
                    'http://ameblo.jp/2zicon/theme-10085711755.html',
                    ['http://pixiv-pro.com/2zicon/wp-content/uploads/2014/09/tsurumi-600x620.jpg'],
                    new TwitterAccount('2795582286', 'tsurumi_moe'),
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

        $normalized = str_replace(['', ' ', "\n", "\r", "\t", '@'], '', $name);

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
