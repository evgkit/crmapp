<?php
/**
 * @Author: e 09.02.2016
 */

namespace app\models\customer;


/**
 * Class Phone
 * @package app\models\customer
 */
class Phone
{
    /**
     * @var string
     */
    public $number;

    /**
     * Phone constructor.
     * @param string $number
     */
    public function __construct($number)
    {
        $this->number = $number;
    }
}