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
abstract class LocaleValue
{
    /** @var Twig_Environment */
    private static $twig;

    /**
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->setValues($values);
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
     * @param  string $key
     * @param  array  $query
     * @return mixed
     * @throws \OutOfRangeException
     */
    public function searchValue($key, array $query)
    {
        if (!isset($this->$key)) {
            throw new \OutOfRangeException;
        }

        foreach ($this->$key as $lang_val) {
            list($lang, $val) = $lang_val;
            $tag = self::parseLang($lang);
            foreach ($query as $elm_name => $elm_val) {
                if (empty($elm_val)) { continue; }
                if (!isset($tag[$elm_name]) || $tag[$elm_name] !== $elm_val) {
                    continue 2;
                }
            }

            return $val;
        }
    }

    /**
     * @param  array $lang_with_values
     * @throws \LogicException
     * @example $values = [
     *     ['ja-Jpan', [
     *         "foo" => "ふー！",
     *         "bar" => "ばー！",
     *     ],
     *     ['en-Latn', [
     *         "foo" => "Foooo!",
     *         "bar" => "Baaar!",
     *     ],
     * ];
     */
    protected function setValues(array $lang_with_values)
    {
        foreach ($lang_with_values as $lang_val) {
            list($lang, $values) = $lang_val;
            foreach($values as $tag => $word) {
                if (!isset($this->$tag) || !is_array($this->$tag)) {
                    throw new \LogicException("Illigal property: $tag");
                }
                $tmp = $this->$tag;
                $tmp[] = [$lang, $word];
                $this->$tag = $tmp;
            }
        }
    }

    /**
     * @param  string $lang
     * @return array
     * @see    \Teto\HTTP\AcceptLanguage::parse()
     */
    public static function parseLang($lang)
    {
        return AcceptLanguage::parse($lang)[1];
    }

    /**
     * @param  string $format
     * @param  array  $params
     * @return string
     */
    protected static function renderFormat($format, array $params)
    {
        if (empty(self::$twig)) {
            self::$twig = new \Twig_Environment(new \Twig_Loader_String);
        }

        return self::$twig->render($format, $params);
    }
}
