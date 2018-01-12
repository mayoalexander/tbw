<?php

Namespace Model\Baewatch;

class Pricing extends \Model\Model_Abstract
{
    // Required static keys for database columns
    static protected $_keys;
    // Required table name
    CONST TABLE     = 'thebaewatch_thebaewatch_pricing';
    // Required AUTOINC flag
    CONST AUTOINC   = true;
    // Required PRIKEY that is AUTOINC
    CONST PRIKEY    = 'id';
    /*
     * Initialize models table
     */
    public function __construct()
    {
        $this->init();
    }
}
