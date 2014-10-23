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
final class LocaleName extends LocaleValue
{
    protected $family = [];
    protected $given  = [];

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

        $family = $this->searchValue('family', $tag);
        $given  = $this->searchValue('given',  $tag);

        if (isset($options['format'])   ) {
            $params = [
                'family' => $family,
                'given'  => $given,
            ];

            return self::renderFormat($options['format'], $params);
        }

        if ($tag['language'] === 'ja') {
            $separator = isset($options['separator']) ? $options['separator'] : '';

            return $family . $separator . $given;
        }

        $separator = isset($options['separator']) ? $options['separator'] : ' ';

        return $given . $separator . $family;
    }

    /**
     * @return array[]
     */
    public function dumpNames()
    {
        $retval = [];

        for ($n = 0; $n < count($this->family); $n++) {
            $retval[] = [$this->family[$n][0], ['family' => $this->family[$n][1], 'given' => $this->given[$n][1]]];
        }

        return $retval;
    }
}
