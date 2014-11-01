<?php
namespace Tsukudol;

use Teto\HTTP\AcceptLanguage;

/**
 * Abstract class of translated content
 *
 * @package Tsukudol
 * @author  tadsan@zonu.me
 * @license MIT
 *
 * @property-read array $nick_name
 */
final class LocaleNickname extends LocaleValue
{
    protected $nick_name = [];

    public function __construct(array $names)
    {
        $this->setValues($names);
    }

    /**
     * @param  string $lang_str
     * @param  array  $options
     * @return array
     */
    public function getNameIn($lang_str, array $options = [])
    {
        $tag = self::parseLang($lang_str);

        return $this->searchValue('nick_name', $tag);
    }

    /**
     * @return array[]
     */
    public function dumpNames()
    {
        $retval = [];

        foreach ($this->nick_name as $nick_name) {
            $retval[] = [$nick_name[0], ['nick_name' => $nick_name[1]]];
        }

        return $retval;
    }
}
