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
        global ${"_".$sMethod};
        $this->aUserData = ${"_".$sMethod};
    }

    protected function _retrieve($sName)
    {
        if (array_key_exists($sName,$this->aUserData)) {
            return $this->aUserData[$sName];
        }
        return false;
    }

    public function get_int($sName, $nMin = 0, $nMax = PHP_INT_MAX)
    {
        $sValue = $this->_retrieve($sName);
        print $sValue;
        if ( is_int($sValue) && $sValue>=$nMin && $sValue<=$nMax ) {
            print "passed";
            return $sValue;
        }
        print "failed";
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

