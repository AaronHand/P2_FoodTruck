<?php
/**
* foodTruck.php displays a form of Item objects, including the name of the object,
* a description of the object, and a price.  The item can be selected, and a quantity
* of items the user wants to purchase can be selected.  The user can hit the submit
* button which will revel another form displaying the items selected, the quantity
* of each item selected, the price, the total of each item, a subtotal, tax, and 
* the total for the purchase selected.
*
*
* @package
* @subpackage
* @author Tiana Greisel
* @version 1.0 2016/01/25
* @link tianagreisel.com/itc250/sandbox/foodTruck.php
* @license
* @todo none
*/

include 'Item.php';  //include Item class to create item objects
include 'configFoodTruck.php'; //contains all the functions for this application

//create a constant named THIS_PAGE
define('THIS_PAGE', basename($_SERVER['PHP_SELF']));


//array to hold items
$items[] = new Item("Burrito", "Includes awesome sauce!", 7.95);
$items[] = new Item("Taco", "Includes cheese and lettuce", 3.95);
$items[] = new Item("Fried Ice Cream", "Includes free sprinkles!", 2.95);



//if form submitted
if (isset($_POST['submit']))
{
  /* echo '<pre>';
    var_dump($_POST);
    echo '</pre>';*/
    
    //check to make sure user selected checkbox of item to purchase
    if (!isset($_POST['itemType'])){
        
        //if they didn't check any item boxes, display message to select at least one item
        echo "Please select at least one item to purchase";
        
        //reset $_POST data since 'submit' cached and need to reset to display form again 
        unset($_POST);
        
        // display reset button so user can go back and enter different items
        echo '
    
        <form method="post" action="' . THIS_PAGE . '">
        <input type="submit" name="reset" value="reset" />
    
        </form>
        ';
            die;
    
    }
    
    //create a variable to store POST data of items user purchased.  Associative array with indix being item
    //name and value is the quantity user purchased
    $itemsPurchased = $_POST['quantity'];
    
    //create a variable to store POST data of items selected in checkboxes 
    $itemsSelected = $_POST['itemType'];
       
    //loop through array of items user purchased, which is items they checked in checkboxes and quantity as input fields
    foreach ($itemsPurchased as $item => $input){

        //validate user input for each quantity input box to make sure an integer number
        //display feedback to the user
        if((!is_numeric($input) && $input != "") || $input < 0){ //if its not a number and not nothing, or the input is less than zero
            echo "Quantity must be an positive integer value";   //display message to user saying quantity must be an integer value
             
            //reset $_POST data since 'submit' cached and need to reset to display form again
            unset($_POST);

            // display reset button so user can go back and enter different items
            echo '
    
        <form method="post" action="' . THIS_PAGE . '">
        <input type="submit" name="reset" value="reset" />
    
        </form>
        ';
            die;   
        }  
        
        //if the user selected a item from checkbox, make sure entered a non-zero quantity value
        if (isset($_POST['itemType'])){
              
            //loop through the itemsSelected checkbox array
              foreach ($itemsSelected as $itmSelected)
                    
                  //if the itemSelected as checkbox matches quantity input value and the user didn't
                  //enter a quantity or entered zero, display a message telling user to enter non-zero value
                  if($itmSelected == $item && ($input == "" || $input == 0)){
                      
                      //display message to user to enter a non-zero quantity of selected item to purchase
                      echo "Please enter a non-zero quantity of item to purchase";
                      
                      //reset $_POST data since 'submit' cached and need to reset to display form again
                      unset($_POST);
                      
                     // display reset button so user can go back and enter different items
                     echo '
    
                    <form method="post" action="' . THIS_PAGE . '">
                    <input type="submit" name="reset" value="reset" />
    
                    </form>
                    ';
                    die;
    
                  }   
    }
    }
    
    //call function displayOrder() to display the items the user picked and the total for their order
    echo displayOrder($itemsPurchased, $items);
    
    //reset $_POST data since 'submit' cached and need to reset to display form again
    unset($_POST);

    // display reset button so user can go back and enter different items
    echo '
    
    <form method="post" action="' . THIS_PAGE . '">
    <input type="submit" name="reset" value="reset" />
    
    </form>
    ';    
}
    
else
{
    
//call to makeForm() function using the items array that contains all the available items
//makes a form dynamically based on the available items to display to user so they can select items to purchase
echo makeForm($items);
      
}



