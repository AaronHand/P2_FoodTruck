<?php
/**
 * Created by PhpStorm.
 * User: ahand
 * Date: 3/14/16
 * Time: 10:07 AM
 */

require_once '../simpletest/simpletest/web_tester.php';
require_once '../simpletest/simpletest/autorun.php';
require_once '../simpletest/includes/settings.php';
include_once '../Item.php';





class FoodTruckTest extends WebTestCase {

    /**
     *
     */

    function testContactSubmit() {
        //$this->get(VIRTUAL_PATH . '/pages/contact.php');

        $this->get(VIRTUAL_PATH . '../../foodTruck.php');

        $this->assertResponse(200);

        $this->setField("itemType[]", "burrito");
        $this->setField("quantity['burrito']", 3);
        //$this->setField("message", "I look forward to hearing from you!");

        $this->clickSubmitByName("submit");

        $this->assertResponse(200);
        //$this->assertText("Please select at least one item to purchase");
    }

    /**
     *
     * Verify error message with no fields submitted
     *
     */

    function testNofields(){
        $this->get(VIRTUAL_PATH. '../../foodTruck.php');
        $this->clickSubmitByName("submit");
        $this->assertResponse(200);
        $this->assertText("Please select at least one item to purchase");
    }


    /**
     *
     * TODO: MAKE THIS TEST PASS!
     *
     */


//    function testBadData(){
//        $this->get(VIRTUAL_PATH. '../../foodTruck.php');
//        //$this->setField("itemType", "burrito");
//        $this->setField('itemType[]','burrito');
//        $this->setField('quantity["burrito"]','r');
//        $this->clickSubmitByName("submit");
//        $this->assertResponse(200);
//        $this->assertText("Quantity must be an positive integer value");
//    }

    /**
     *
     * This function tests the form input fields and makes sure that the proper field values 
     * are set when the user enters values into the form input fields.
     */
    
    function testInvalidSubmit(){  
        $this->assertFieldValue('itemType[]',"burrito","burrito","message goes here.");
        $this->assertFieldValue('quantity["burrito"]',3,3,"another message");
    }
    

    

//    function testInvalidName() {
//        $this->get(VIRTUAL_PATH . '/pages/contact2.php');
//        $this->assertResponse(200);
//
//        $this->setField("name", "");
//        $this->setField("email", "wj@example.com");
//        $this->setField("message", "I look forward to hearing from you!");
//
//        $this->clickSubmit("Contact us!");
//
//        $this->assertResponse(200);
//        $this->assertText("Please provide your name.");
//    }

}
    






