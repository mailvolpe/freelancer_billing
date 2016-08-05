<?php

/***
 * Represents a product/item in a transaction
 */
class Item
{

    /***
     * Product identifier, such as SKU
     */
    private $id;

    /***
     * Product description
     */
    private $description;

    /***
     * Quantity
     */
    private $quantity;

    /***
     * Product unit price
     */
    private $amount;

    /***
     * Single unit weight, in grams
     */
    private $weight;

    /***
     * Single unit shipping cost
     */
    private $shippingCost;

    /***
     *
     * Initializes a new instance of the Item class
     * @param array $data
     */
    public function __construct(array $data = null)
    {
        if ($data) {
            if (isset($data['id'])) {
                $this->id = $data['id'];
            }
            if (isset($data['description'])) {
                $this->description = $data['description'];
            }
            if (isset($data['quantity'])) {
                $this->quantity = $data['quantity'];
            }
            if (isset($data['amount'])) {
                $this->amount = $data['amount'];
            }
            if (isset($data['weight'])) {
                $this->weight = $data['weight'];
            }
            if (isset($data['shippingCost'])) {
                $this->shippingCost = $data['shippingCost'];
            }
        }
    }

    /***
     * @return integer the product identifier
     */
    public function getId()
    {
        return $this->id;
    }

    /***
     * Sets the product identifier
     * @param String $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /***
     * @return String the product description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /***
     * Sets the product description
     * @param String $description
     */
    public function setDescription($description)
    {
        $this->description = Helper::formatString($description, 255);
    }

    /***
     * @return integer the quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /***
     * Sets the quantity
     * @param String $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /***
     * @return the unit amount for this item
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /***
     * sets the unit amount fot this item
     * @param String $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /***
     * @return float the weight
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /***
     * Sets the single unit weight
     * @param String $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /***
     * @return float the unit shipping cost for this item
     */
    public function getShippingCost()
    {
        return $this->shippingCost;
    }

    /***
     * Sets the unit shipping cost for this item
     * @param String $shippingCost
     */
    public function setShippingCost($shippingCost)
    {
        $this->shippingCost = $shippingCost;
    }
}
