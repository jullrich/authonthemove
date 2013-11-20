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

    /**
     * Constructor. Calls 'load' method to retrieve data.
     *
     * @param string $sMethod
     */
    public function __construct($sMethod='')
    {
        if ( $sMethod=='' ) {
            $this->sMethod = $_SERVER['REQUEST_METHOD'];
        } else {
            $this->sMethod=$sMethod;
        }
        $this->load($this->sMethod);
    }

    /**
     * Load data from super global
     *
     * @param $sMethod
     */

    public function load($sMethod)
    {
        global ${"_".$sMethod};
        $this->aUserData = ${"_".$sMethod};
    }

    /**
     * private function to retrieve data
     *
     * @param $sName
     * @return bool
     */

    protected function _retrieve($sName)
    {
        if (array_key_exists($sName,$this->aUserData)) {
            return $this->aUserData[$sName];
        }
        return false;
    }

    /**
     * retrieving passwords. This function doesn't do any validation. Everything goes in passwords.
     *
     * @param $sName
     * @return bool
     */

    public function get_password($sName) {
        return $this->_retrieve($sName);
    }

    /**
     * Retrieve an integer within a given range.
     *
     * @param $sName
     * @param int $nMin
     * @param int $nMax
     * @return bool
     */
    public function get_int($sName, $nMin = 0, $nMax = PHP_INT_MAX)
    {
        $sValue = $this->_retrieve($sName);

        if ( is_numeric($sValue) && $sValue==intval($sValue) && $sValue>=$nMin && $sValue<=$nMax ) {
            return $sValue;
        }
        return false;
    }

    /**
     * Retrieve an alphanumeric string
     *
     * @param $sName
     * @param int $nMaxLen
     * @return bool
     */
    public function get_alphanum($sName, $nMaxLen=1000 ) {
        $sValue=$this->_retrieve($sName);
        if ( $sValue && strlen($sValue<$nMaxLen) ) {
            return $sValue;
        }
        return false;
    }

    /**
     * retrieve a string from user data and validate it using a regular expression.
     *
     * @param $sName
     * @param $sRegex
     * @return bool
     */
    public function get_regextext($sName, $sRegex) {
        $sValue=$this->_retrieve($sName);
        if ( preg_match($sRegex,$sValue)) {
            return $sValue;
        }
        return false;
    }

}

/**
 * helper function to output a string safely for a specific context.
 *
 * @param $Data
 * @param string $sTemplate
 * @param string $sContext
 */

function safe_out($Data,$sTemplate='',$sContext='HTML') {
    $aValues=array();
    $aClean=array();
    if ( ! is_array($Data) ) {
        $aValues['data']=$Data;
    } else {
        $aValues=$Data;
    }
    foreach ( $aValues as $sKey=>$sValue ) {
        /** @var $aClean array */
        /** @var $sValue string */
        $aClean[$sKey]=safe_encode($sValue,$sContext);
    }
    if ( $sTemplate=='' ) {

        print join('',array_values($aClean));
    }
    foreach ( $aClean as $sKey=>$sValue ) {
        preg_replace("/%%$sKey%%/",$sValue,$sTemplate);
    }
    $sTemplate=preg_replace('/%%[^%]+%%/','',$sTemplate);
    print $sTemplate;
}

/**
 *
 *   This function is used to encode strings appropriately for a particular output context.
 * TODO: add additional contexts.
 *
 * @param $sString
 * @param $sContext
 * @return bool|string
 *
 */

function safe_encode($sString,$sContext) {
    switch ($sContext) {
        case "HTML":
            return htmlentities($sString,ENT_QUOTES,"UTF-8");
        case "JS":
            return "";
        case "CSS":
            return "";
        case "ATTRIBUTE":
            return "";
    }
    return false;
}

