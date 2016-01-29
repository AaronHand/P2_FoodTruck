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

include 'Item.php';  //include Item class to 
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
    
  // $total = 0;
    
    
    $itemsPurchased = $_POST['quantity'];
       
    foreach ($itemsPurchased as $input){
    /*if (!is_numeric($input) && $input != ""){
        echo "Please enter an integer value";
        
    }*/
        //validate user input for each quantity box to make sure an integer number
        //display feedback to the user
        //if(!filter_var($input, FILTER_VALIDATE_INT) && $input != ""){
          if((!is_numeric($input) && $input != "") || $input < 0){  
            echo "Quantity must be an integer value";
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
//makes a form dynamically based on the available items
echo makeForm($items);
 

       
}



