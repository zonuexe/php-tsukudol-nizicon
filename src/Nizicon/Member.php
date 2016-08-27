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
     * @param LocaleName[]      $names
     * @param LocaleNickname[]  $nick_names
     * @param string            $birth_day
     * @param TwitterAccount    $twitter
     * @param string[]          $calls
     * @param string            $blog_url
     * @param string[]          $head_shot_urls
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
        if ($this->twitter && strcasecmp($search_name, $this->twitter->screen_name) === 0 ) {
            return true;
        }

        if ($this->pixiv && strcasecmp($search_name, $this->pixiv->account) === 0) {
            return true;
        }

        foreach ($this->names->dumpNames() as $lang_name) {
            list($_lang, $name) = $lang_name;

            if (strcasecmp($search_name, $name['given']) === 0 ||
                strcasecmp($search_name, $name['family']) === 0 ||
                strcasecmp($search_name, $name['family'].$name['given']) === 0 ||
                strcasecmp($search_name, $name['given'].$name['family']) === 0
            ) {
                return true;
            }
        }

        foreach ($this->nick_names->dumpNames() as $lang_name) {
            list($_lang, $name) = $lang_name;

            if (strcasecmp($search_name, $name['nick_name']) === 0) {
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
                        ['ja-Jpan', ['family' => '重松',     'given' => '佑佳']],
                        ['ja-Hira', ['family' => 'しげまつ', 'given' => 'ゆか']],
                        ['en-Latn', ['family' => 'Shigematsu',   'given' => 'Yuka']],
                    ],
                    [
                        ['ja-Jpan', ['nick_name' => 'しげちー']],
                        ['en-Latn', ['nick_name' => 'Shigechi']],
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
                        ['ja-Jpan', ['nick_name' => 'ののた']],
                        ['en-Latn', ['nick_name' => 'Nonota']],
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
                        ['ja-Jpan', ['family' => '陶山',   'given' => '恵実里']],
                        ['ja-Hira', ['family' => 'すやま', 'given' => 'えみり']],
                        ['en-Latn', ['family' => 'Suyama', 'given' => 'Emiri']],
                    ],
                    [
                        ['ja-Jpan', ['nick_name' => 'えみりぃ']],
                        ['en-Latn', ['nick_name' => 'Emirii']],
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
                        ['en-Latn', ['nick_name' => 'Akarin']],
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
                        ['ja-Jpan', ['family' => '根本',    'given' => '凪']],
                        ['ja-Hira', ['family' => 'ねもと',  'given' => 'なぎ']],
                        ['en-Latn', ['family' => 'Nemoto',  'given' => 'Nagi']],
                    ],
                    [
                        ['ja-Jpan', ['nick_name' => 'ねも']],
                        ['en-Latn', ['nick_name' => 'Nemo']],
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
                        ['en-Latn', ['nick_name' => 'Karinsama']],
                        ['en-Latn', ['nick_name' => 'Karin']],
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
                        ['ja-Jpan', ['family' => '鶴見',     'given' => '萌']],
                        ['ja-Hira', ['family' => 'つるみ',   'given' => 'もえ']],
                        ['en-Latn', ['family' => 'Tsurumi',  'given' => 'Moe']],
                    ],
                    [
                        ['ja-Jpan', ['nick_name' => 'もえ']],
                        ['en-Latn', ['nick_name' => 'Moe']],
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
