<?php
/**
 * Created by PhpStorm.
 * User: jullrich
 * Date: 11/19/13
 * Time: 1:38 PM
 */

class Userdata
{
    protected $aUserData = array();
    protected $sMethod;

    public function __construct($sMethod='')
    {
        if ( $sMethod=='' ) {
            $this->sMethod = $_SERVER['REQUEST_METHOD'];
        } else {
            $this->sMethod=$sMethod;
        }
        $this->load($this->sMethod);
    }

    public function load($sMethod)
    {
        global ${$sMethod};
        $this->aUserData = ${$sMethod};
    }

    protected function _retrieve($sName)
    {
        if (array_key_exists($this->aUserData, $sName)) {
            return $this->aUserData[$sName];
        }
        return false;
    }

    public function get_int($sName, $nMin = 0, $nMax = PHP_INT_MAX)
    {
        $sValue = $this->_retrieve($sName);
        if ( $sValue && is_int($sValue) && $sValue>=$nMin && $sValue<=$nMax ) {
            return $sValue;
        }
        return false;
    }

    public function get_alphanum($sName, $nMaxLen=1000 ) {
        $sValue=$this->_retrieve($sName);
        if ( $sValue && strlen($sValue<$nMaxLen) ) {
            return $sValue;
        }
        return false;
    }
    public function get_regextext($sName, $sRegex) {
        $sValue=$this->_retrieve($sName);
        if ( preg_match($sRegex,$sValue)) {
            return $sValue;
        }
        return false;
    }

} 