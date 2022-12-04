<?php

// Savier Osman
// 12/03/2022
// Created the three different functions 
// (calculate_future_value(), get_currency_format(), and get_percentage_format())
// for display_results.php to use.

function calculate_future_value($investment, $yearly_rate, $years, $compound_monthy) {

    // calculate the future value
    $future_value = $investment;
    // if the check box is checked then it caclulates it as a monthly compound interest.
    if ($compound_monthy === true){
        for ($i = 1; $i <= $years * 12; $i++) {
            $future_value += $future_value * ($yearly_rate/12) *.01;
        }
    }else {
        for ($i = 1; $i <= $years; $i++) {
            $future_value += $future_value * $yearly_rate *.01;
        }
    }

    return $future_value;
}

function get_currency_format($value) {

    // Formats for currency
    $formatted_value = '$' . number_format($value, 2);

    return $formatted_value;
}

function get_percentage_format($value) {

    // Formats for percentage value
    $formatted_value = $value . '%';

    return $formatted_value;
}

?>