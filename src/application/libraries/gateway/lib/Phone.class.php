<?php

/***
 * Represents a phone number
 */
class Phone
{

    /***
     * Area code
     */
    private $areaCode;

    /***
     * Phone number
     */
    private $number;

    /***
     * Initializes a new instance of the Phone class
     *
     * @param String $areaCode
     * @param String $number
     * @return Phone
     */
    public function __construct($areaCode = null, $number = null)
    {
        $this->areaCode = ($areaCode == null ? null : $areaCode);
        $this->number = ($number == null ? null : $number);
        return $this;
    }

    /***
     * @return int the area code
     */
    public function getAreaCode()
    {
        return $this->areaCode;
    }

    /***
     * @return int the number
     */
    public function getNumber()
    {
        return $this->number;
    }

    /***
     * Sets the area code
     * @param String $areaCode
     * @return Phone
     */
    public function setAreaCode($areaCode)
    {
        $this->areaCode = $areaCode;
        return $this;
    }

    /***
     * Sets the number
     * @param String $number
     * @return Phone
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /***
     * Sets the number from a formatted string
     *
     * @param $number String formatted string like <code>(099) [9]9999-9999</code>
     * @return $this
     */
    public function setFullPhone($number)
    {
        /** We clean the string that is coming. Can be formatted or not */

        $number = preg_replace("/[^0-9]/", '', $number);
        $number = $number[0] == 0 ? substr($number, 1) : $number;

        $number = str_split($number, 1);
        $areaCode = array_shift($number) . array_shift($number);
        $phone = implode('', $number);

        $this->setAreaCode($areaCode);
        $this->setNumber($phone);

        return $this->areaCode . $this->number;
    }
}
