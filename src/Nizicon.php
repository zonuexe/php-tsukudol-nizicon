<?php
namespace Tsukudol;

/**
 * Niji No Conquistador
 *
 * @package Tsukudol
 * @author  tadsan@zonu.me
 * @license MIT
 */
final class Nizicon
{
    private function __constructor(){}

    /**
     * @param  $name
     * @return Nizicon\Member
     */
    public static function member($name)
    {
        return \Tsukudol\Nizicon\Member::find($name);
    }

    /**
     * @return Nizicon\Member[]
     */
    public static function members()
    {
        return \Tsukudol\Nizicon\Member::getList();
    }
}
