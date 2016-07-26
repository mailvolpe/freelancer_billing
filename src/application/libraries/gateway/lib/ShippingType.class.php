<?php

class ShippingType
{

    /***
     * @var array
     */
    private static $typeList = array(
        'PAC' => 1,
        'SEDEX' => 2,
        'NOT_SPECIFIED' => 3
    );

    /***
     * the shipping type value
     * Example: 1
     */
    private $value;

    /***
     * @param null $value
     */
    public function __construct($value = null)
    {
        if ($value) {
            $this->value = $value;
        }
    }

    /***
     * @param $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /***
     * @param $type
     * @throws Exception
     */
    public function setByType($type)
    {
        if (isset(self::$typeList[$type])) {
            $this->value = self::$typeList[$type];
        } else {
            throw new Exception("undefined index $type");
        }
    }

    /***
     * @return int the value of the shipping type
     */
    public function getValue()
    {
        return $this->value;
    }

    /***
     * @param value
     * @return ShippingType the ShippingType corresponding to the informed value
     */
    public function getTypeFromValue($value = null)
    {
        $value = ($value === null ? $this->value : $value);
        return array_search($value, self::$typeList);
    }

    /***
     * @param string
     * @return integer the code corresponding to the informed shipping type
     */
    public static function getCodeByType($type)
    {
        if (isset(self::$typeList[$type])) {
            return self::$typeList[$type];
        } else {
            return false;
        }
    }

    /***
     * @param string $type
     * @return ShippingType a ShippingType object corresponding to the informed type
     */
    public static function createByType($type)
    {
        $ShippingType = new ShippingType();
        $ShippingType->setByType($type);
        return $ShippingType;
    }
}
