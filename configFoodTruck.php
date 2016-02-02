<?php

/**
* configFoodTruck.php is a file that holds all the functions related to the foodTruck.php 
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
* This function creates a dynamic form based on items in the array provided as a parameter to the function.
* The form allows  the usert to select items on the form as checkboxes, to input text quantities of each
* item desired, and it also displays the item and a description to the item.  It displays the form in a 
* nicely formatted table.
*
* @param array $array An array of items to be dynamically added to the form
* @return string $myReturn A string representation of the form made with the items in the array parameter.
* @todo none
*/
function makeForm($array)
{
    //create a string to hold the form string to echo to the page
    $myReturn = '';
        
        //add form tags to form string.  With method being post and have it be a postback form
        //add table tages to format form with columns for selecting item, quantity, item, description, and price
        $myReturn .= '<form method="post" action="' . THIS_PAGE . '">
    
    <table border="1" style="width:50%">
    <tr>
    <td>Select Items</td>
    <td>Quantity</td>
    <td>Item</td>
    <td>Description</td>
    <td>Price</td>
    </tr>';
    
    //loop through array provided as parameter to the function that holds items for form to display
    foreach ($array as $item)
    {
        //add each item to form string with item name, description and price in separate columns
        //create checkbox that stores the item name and input box for user to enter number of each
        //item they want and store in an associate array name quantity that key is item name and value is
        //quanity the user enters
        $myReturn .= 
        
    '<tr><td><input type="checkbox" name="itemType[]" value="' . $item->name . '"</td>
    <td><input type="text" name="quantity['. $item->name .']" /></td>
    <td>' . $item->name . '</td>
    <td>' . $item->description . '</td>
    <td>$' . $item->price . '</td>
    </tr>';
    
    } 
    
    //add submit button to form
    $myReturn .= '<tr><td></td><td></td><td></td><td></td><td><input type="submit" name="submit" value="Submit Order" /></td></tr></table></form>';   
    
    //return form string with all items from array parameter added to the form
    return $myReturn;  
}//end makeForm()


/**
* This function calculate the total cost of a purchase based on the $itemsPurchased parameter
* which is an array storing the items the customer purchased and the quantity of each of those
* items the customer purchased, and the $itemsAvailable parameter which is an array storing Item
* objects that hold the price of each of those items.  The total is calculated based on price 
* times quantity.
*
*
* @param Array $itemsPurchased An array storing items purchased as key and quantity purchased as
*                               its value
* @param Array $itemsAvailable An array of Item objects that hold the price of each item
* @return Int  $total          The total cost of the purchase (price * quantity)
* @todo none
**/
function calculateTotal($itemsPurchased, $itemsAvailable)
{
        
    //loop through itemsPurchased array that hold the items the user purchased as key and quantity purchased as value
    foreach($itemsPurchased as $item => $quantity){
        
        //loop through itemsAvailable array which is Item array that holds the items available that dynamically get added to form
        foreach ($itemsAvailable as $itm){
         
         //if the item name in itemsAvailable array matches the item the user selected
         if ($itm->name == $item )
             
             //grab the item object from the itemsAvailable array
              $itemObject = $itm;
                
             //find the price of the array by selecting the price property of the item and store in price variable
             $price = $itemObject->price;
            
                
     }
        //calculate the total of the purchase which is the price times quantity of each item purchased 
        $total += ($price * $quantity);
 
    }
    
    //return total
    return $total;
    
    }//end calculateTotal()


/**
* This function displays a form of an order purchased based on the $itemsPuchased parameter 
* which is an array storing the items the customer purchased and the quantity of each of those
* items the customer purchased, and the $itemsAvailable parameter which is an array storing Item
* objects that hold the price of each of those items. The form displays each item purchased, the
* quantity purchased, the price of the item, and the item total.  It also displays the subtotal,
* tax, and the total cost of the order.  It displays it in a nicely formatted table.
*
* @param Array $itemsPurchased An array storing items purchased as key and quantity purchased as
*                               its value
* @param Array $itemsAvailable An array of Item objects that hold the price of each item
* @return String  $myReturn    A string representation of the form of items purchased and cost of
*                               each item, subtotal cost, tax, and the total cost of the purchase.
* @todo none
**/
function displayOrder($itemsPurchased, $itemsAvailable)
{
    //create a string to hold form that holds purchased order form
    $myReturn = '';
        
    //use the calculateTotal() function to calculate the total of the order based on items user selected 
    $total = calculateTotal($itemsPurchased, $itemsAvailable);
    
    //add table tags to format form table, with quanity, item, price, and item total columns
    $myReturn .= '
    <table border="1" style="width:50%">
    <tr>
    <td>Quantity</td>
    <td>Item</td>
    <td>Price</td>
    <td>Item Total</td>
    </tr>';
    
    //loop through the itemsPurchased array to get the items the user purchased and quantity of each item they want to purchase
    foreach ($itemsPurchased as $item => $quantity)
    {
        
        //loop through itemsAvailable array which is Item array that holds the items available that dynamically get added to form
        foreach ($itemsAvailable as $itm){
         
        //if the item name in itemsAvailable array matches the item the user selected
         if ($itm->name == $item )
             
             //grabe the item object from the itemsAvailable array
              $itemObject = $itm;
            
             //find the price of the array by selecting the price property of the item and store in price variable
             $price = $itemObject->price;          
     }
    
        //in $_POST[] even if user didn't pick, empty string.  This makes a 0 in quantity for better
        //output formatting in output table
        if ($quantity == "")
        {
            //display a 0 if user didn't enter a quantity for better output formatting
            $quantity = 0;
        }
        
        //create a subTotal array to store subtotal of each item (price * quantity)
        $subTotalArray[] = ($price * $quantity);
        
        //add quantity user selected, item name, price of each item, and subtotal of each item formatted to 2 decimal places
        //to the purchased order form
        $myReturn .= 
        
    '<tr><td>' . $quantity . '</td>
    <td>' . $item . '</td>
    <td>' . number_format($price, 2) . '</td>
    <td>$' . number_format(($price * $quantity), 2) . '</td>
    
    </tr>';
    
    } 
    
    //create a subTotal variable to store the subTotal of the whole purchase, not just each item as subTotal did above
    $subTotal = 0;
    
    //loop through subTotalArray that stores the subTotal of each item
    foreach ($subTotalArray as $itemTotal){
        
        //add the subtotal of each item to the subTotal of the entire order
        $subTotal += $itemTotal;
        
    }
    
    //calculate tax of the subTotal as 9.5% tax rate
    $tax = ($subTotal * .095);
    
    //add subTotal, tax, and total (subTotal plus tax) to the form columns
    $myReturn .= '<tr><td></td><td></td><td>Subtotal</td><td>$' . number_format($subTotal, 2) . '</td></tr>
                <tr><td></td><td></td><td>Tax</td><td>$' . number_format($tax, 2) . '</td></tr>
        <tr><td></td><td></td><td>Total</td><td>$' . number_format(($total + $tax) , 2) . '</td></tr></table>';   
    
    //return the purchased order form string
    return $myReturn;
    
}//end displayOrder()
    
?>