<?php
/**
* Item.php stores the class Item which is used to create objects in the foodTruck.php
* application.
*
* @package
* @subpackage
* @author Tiana Greisel
* @version 1.0 2016/01/25
* @link tianagreisel.com/itc250/sandbox/foodTruck.php
* @license
* @todo none
*/

/**
* This class creates Item objects, which have a name, a description, and a price associated
* with each item.  The item can be anything, but for the foodTruck application it is used
* in it represents items in a food truck.
*
* @todo none
*
*/
class Item
{
    //name of item
    public $name = '';
    
    //descriptio of item
    public $description = '';
    
    //price of item
    public $price = 0;
    
    /**
    * This function is the constructor and creates Item objects.
    *
    * @param string $name Name of the item
    * @param string $description Description of the item
    * @param int $price Price of the item
    * @return string $myReturn A string representation of the form made with the items in the array parameter.
    * @todo none
    */
    public function __construct($name, $description, $price)
    {
    
    $this->name = $name;
    $this->description = $description;
    $this->price = $price;
        
    
    }
}