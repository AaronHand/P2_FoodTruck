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


    $myReturn = '';
        
        $myReturn .= '<form method="post" action="' . THIS_PAGE . '">
    
    <table border="1" style="width:50%">
    <tr>
    <td>Select Items</td>
    <td>Quantity</td>
    <td>Item</td>
    <td>Description</td>
    <td>Price</td>
    </tr>';
    
    foreach ($array as $item)
    {
    
        $myReturn .= 
        
    '<tr><td><input type="checkbox" name="itemType[]" value="' . $item->name . '"</td>
    <td><input type="text" name="quantity['. $item->name .']" /></td>
    <td>' . $item->name . '</td>
    <td>' . $item->description . '</td>
    <td>$' . $item->price . '</td>
    </tr>';
    
    } 
    
    $myReturn .= '<tr><td></td><td></td><td></td><td></td><td><input type="submit" name="submit" value="Submit Order" /></td></tr></table></form>';   
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
        
    
    foreach($itemsPurchased as $item => $quantity){
        
        foreach ($itemsAvailable as $itm){
         
         if ($itm->name == $item )
              $itemObject = $itm;
                $price = $itemObject->price;
            
                
     }
        $total += ($price * $quantity);
        
    }
    
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
    $myReturn = '';
        
    $total = calculateTotal($itemsPurchased, $itemsAvailable);
    
        $myReturn .= '
    <table border="1" style="width:50%">
    <tr>
    <td>Quantity</td>
    <td>Item</td>
    <td>Price</td>
    <td>Item Total</td>
    </tr>';
    
    foreach ($itemsPurchased as $item => $quantity)
    {
        
        foreach ($itemsAvailable as $itm){
         
         if ($itm->name == $item )
              $itemObject = $itm;
                $price = $itemObject->price;
            
        
                
     }
    
        //in $_POST[] even if user didn't pick, empty string.  This makes a 0 in quantity for better
        //output formatting in output table
        if ($quantity == "")
        {
            
            $quantity = 0;
        }
        $subTotalArray[] = ($price * $quantity);
        $myReturn .= 
        
    '<tr><td>' . $quantity . '</td>
    <td>' . $item . '</td>
    <td>' . number_format($price, 2) . '</td>
    <td>$' . number_format(($price * $quantity), 2) . '</td>
    
    </tr>';
    
    } 
    $subTotal = 0;
    foreach ($subTotalArray as $itemTotal){
        
        $subTotal += $itemTotal;
        
    }
    $tax = ($subTotal * .095);
    $myReturn .= '<tr><td></td><td></td><td>Subtotal</td><td>$' . number_format($subTotal, 2) . '</td></tr>
                <tr><td></td><td></td><td>Tax</td><td>$' . number_format($tax, 2) . '</td></tr>
        <tr><td></td><td></td><td>Total</td><td>$' . number_format(($total + $tax) , 2) . '</td></tr></table>';   
    return $myReturn;
    
    
    
}//end displayOrder()
    
?>