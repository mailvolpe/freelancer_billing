<?php

/***
 * Represent a parameter item
 */
class ParameterItem
{

    /***
     * Allow add extra information to order
     *
     * @var string
     */
    private $key;

    /***
     * Value of corresponding key
     *
     * @var mixed
     */
    private $value;

    /***
     * Used for grouping values of parameter items
     * @var mixed
     */
    private $group;

    public function __construct($key, $value, $group = null)
    {
        if (isset($key) && !Helper::isEmpty($key)) {
            $this->setKey($key);
        }
        if (isset($value) && !Helper::isEmpty($value)) {
            $this->setValue($value);
        }
        if (isset($group) && !Helper::isEmpty($group)) {
            $this->setGroup($group);
        }
    }

    /***
     * Gets the parameter item key
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /***
     * Sets the parameter item key
     *
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /***
     * Gets parameter item value
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /***
     * Sets parameter item value
     *
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /***
     * Gets parameter item group
     *
     * @return int
     */
    public function getGroup()
    {
        return $this->group;
    }

    /***
     * Sets parameter item group
     *
     * @param int $group
     */
    public function setGroup($group)
    {
        $this->group = (int) $group;
    }
}
