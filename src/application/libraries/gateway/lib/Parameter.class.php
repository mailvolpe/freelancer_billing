<?php

/***
 * Represent a parameter
 */
class Parameter
{

    private $items;

    public function __construct(array $items = null)
    {
        if (!is_null($items) && count($items) > 0) {
            $this->setItems($items);
        }
    }

    public function addItem(ParameterItem $parameterItem)
    {

        if (!Helper::isEmpty($parameterItem->getKey())) {
            if (!Helper::isEmpty($parameterItem->getValue())) {
                $this->items[] = $parameterItem;
            } else {
                die('requered parameterValue.');
            }
        } else {
            die('requered parameterKey.');
        }
    }

    public function setItems(array $items)
    {
        $this->items = $items;
    }

    public function getItems()
    {
        if ($this->items == null) {
            $this->items = array();
        }
        return $this->items;
    }
}
