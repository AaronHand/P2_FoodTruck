<?php
/**
 * Created by PhpStorm.
 * User: ahand
 * Date: 3/16/16
 * Time: 1:28 PM
 */


require_once '../simpletest/simpletest/unit_tester.php';
require_once '../simpletest/simpletest/autorun.php';
require_once '../simpletest/includes/settings.php';
include_once '../foodTruck.php';
require_once '../Item.php';
require_once '../configFoodTruck.php';
class configFoodTruckTest extends UnitTestCase
{

    function testMakeForm(){
        //$this->get(VIRTUAL_PATH . '../../configFoodTruck.php');

        $form = <<<'FORM'

<form method="post" action="configFoodTruckTest.php">
    <table border="1" style="width:50%">
    <tr>
    <td>Select Items</td>
    <td>Quantity</td>
    <td>Item</td>
    <td>Description</td>
    <td>Price</td>
    </tr><tr><td><input type="checkbox" name="itemType[]" value="taco"</td>
    <td><input type="text" name="quantity[taco]" /></td>
    <td>taco</td>
    <td>taco</td>
    <td>$2.00</td>
    </tr><tr><td><input type="checkbox" name="itemType[]" value="burrito"</td>
    <td><input type="text" name="quantity[burrito]" /></td>
    <td>burrito</td>
    <td>burrito</td>
    <td>$3</td>
    </tr><tr><td><input type="checkbox" name="itemType[]" value="Ice Cream"</td>
    <td><input type="text" name="quantity[Ice Cream]" /></td>
    <td>Ice Cream</td>
    <td>hot dog</td>
    <td>$7</td>
    </tr><tr><td></td><td></td><td></td><td></td><td><input type="submit" name="submit" value="Submit Order" /></td></tr></table></form>

FORM;





        $itemsTest = array(
            new Item('taco','taco',2.00),
            new Item('burrito','burrito',3),
            new Item('Ice Cream','hot dog',7)
        );
        
        
        
        $this->assertEqual($form,makeForm($itemsTest));

    }

    function testCalculateTotal()
    {
        //$this->get(VIRTUAL_PATH . '../../configFoodTruck.php');

        $items = array(
            new Item('burrito', 'burrito', 6),
            new Item('taco', 'taco', 4)
        );

        $purchased = array(
            'burrito' => 3,
            'taco' => 2
        );

        $this->assertEqual(calculateTotal($purchased, $items), 26);
    }
    
    function testDisplayOrder(){
        
    }

}