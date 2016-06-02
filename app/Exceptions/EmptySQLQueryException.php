<?php namespace Egroup\Exceptions;


class EmptySQLQueryException extends \Exception
{

    /**
     * EmptySQLQueryException constructor.
     * @param string $string
     */
    public function __construct($string)
    {
    }
}