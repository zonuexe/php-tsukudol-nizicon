<?php

namespace Tsukudol;

/**
 * TranslatedString
 *
 * @author  tadsan@zonu.me
 * @license MIT
 */
final class LocaleString
{
    /** @var string */
    private static $DEFAULT_LANG = 'ja';

    /** @var array */
    private $strings = [];

    /** @var string */
    private $default_lang;

    /**
     * @param array       $strings
     * @param string|null $default
     */
    public function __construct(array $strings, $default_lang = null)
    {
        $this->default_lang = $default_lang ?: self::getDefaultLang();

        $this->setStrings($strings);
    }

    /**
     * @param  array $strings
     * @throws \LogicException
     */
    private function setStrings(array $strings)
    {
        foreach ($strings as $lang => $val) {
            if ($lang !== 'en' && $lang !== 'ja') {
                throw new \LogicException;
            }
            if (!is_string($val)) {
                throw new \UnexpectedValueException;
            }

            $this->strings[$lang] = $val;
        }

        if (!isset($this->strings[$this->default_lang])) {
            throw new \LogicException;
        }

        $this->strings = $strings;
    }

    /**
     * @param  string $lang
     * @return string
     */
    public function __get($lang)
    {
        if (isset($this->strings[$lang])) {
            return $this->strings[$lang];
        }

        throw new \OutOfRangeException;
    }

    /**
     * @return string
     */
    private static function getDefaultLang()
    {
        return self::$DEFAULT_LANG;
    }
}
