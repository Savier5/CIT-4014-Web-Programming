<?php

// Savier Osman
// 11/28/2022
// Modified the program to use $cart array rather than $_SESSION array
// Modified on 11/29/2022 to account for pass by reference of the $cart array.

namespace osman\cart{

    // Add an item to the cart
    function add_item(&$cart, $key, $quantity) { // Added $cart argument pass by reference
        global $products;
        if ($quantity < 1) return;// removed return cart array

        // If item already exists in cart, update quantity
        if (isset($cart[$key])) {
            $quantity += $cart[$key]['qty'];
            update_item($cart, $key, $quantity);
            return;
        }

        // Add item
        $cost = $products[$key]['cost'];
        $total = $cost * $quantity;
        $item = array(
            'name' => $products[$key]['name'],
            'cost' => $cost,
            'qty'  => $quantity,
            'total' => $total
        );
        $cart[$key] = $item;
        return;
    }

    // Update an item in the cart
    function update_item(&$cart, $key, $quantity) { // Added $cart argument pass by reference
        $quantity = (int) $quantity;
        if (isset($cart[$key])) {
            if ($quantity <= 0) {
                unset($cart[$key]);
            } else {
                $cart[$key]['qty'] = $quantity;
                $total = $cart[$key]['cost'] *
                        $cart[$key]['qty'];
                        $cart[$key]['total'] = $total;
            }
        }
        return; 
    }

    // Get cart subtotal
    function get_subtotal ($cart, $decimal = 2) { // Added $cart argument // Added $decimal as default value
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['total'];
        }
        $subtotal_f = number_format($subtotal, $decimal);
        return $subtotal_f;
    }
}
?>