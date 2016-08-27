<?php
namespace Tsukudol;

use Tsukudol\Nizicon;

/**
 * Niji No Conquistador
 *
 * @author  tadsan@zonu.me
 * @license MIT
 */
final class Nizicon implements \Countable, \IteratorAggregate
{
    /** @var Nizicon */
    private static $instance;

    private function __constructor(){}

    /**
     * @param  $name
     * @return Nizicon\Member
     */
    public static function member($name)
    {
        return Nizicon\Member::find($name);
    }

    /**
     * @return Nizicon\Member[]
     */
    public static function members()
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator(Nizicon\Member::getList());
    }

    /**
     * @return int
     */
    public function count()
    {
        return count(Nizicon\Member::getList());
    }
}
