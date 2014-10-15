<?php
namespace Tsukudol;

use Teto\HTTP\AcceptLanguage;

/**
 * Abstract class of translated content
 *
 * @package Tsukudol
 * @author  tadsan@zonu.me
 * @license MIT
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
}
