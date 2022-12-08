<?php

class future_value {

    //Creates private values
    Private $investment, $interest_rate, $years, $compund_monthly;

    // Sets default values and the contructor
    function __construct($investment = 10000, $interest_rate = 4, $years = 10, $compound_monthly = false)
    {
        $this->investment = $investment;
        $this->interest_rate = $interest_rate;
        $this->years = $years;
        $this->compound_monthly = $compound_monthly;
    }
    
    // Sets and gets for the values
    Public function getInvestment(){
        return $this->investment;
    }

    Public function setInvestment($value){
        $this->investment = $value;
    }

    Public function getInterestRate(){
        return $this->interest_rate;
    }

    Public function setInterestRate($value){
        $this->interest_rate = $value;
    }

    Public function getYears(){
        return $this->years;
    }

    Public function setYears($value){
        $this->years = $value;
    }

    Public function getCompundMonthly(){
        return $this->compund_monthly;
    }

    Public function setCompundMonthly($value){
        $this->compund_monthly = $value;
    }

    Public function getCurrencyFormat($value){
        // Returns format for currency
        return '$' . number_format($value, 2);
    }

    Public function getPercentFormat($value) {
        // Formats for percentage value
        return $value . '%';
    }

    // Formats investment
    Public function getInvestmentFormatted() {
        return $this->getCurrencyFormat($this->investment);
    }

    // Formats interest_rate
    Public function getInterestRateFormatted() {
        return $this->getPercentFormat($this->interest_rate);
    }

    // Formats ompound Monthly
    Public function getCompoundMonthlyFormatted() {
        if ($this->getCompundMonthly() === true){
            return 'Yes';
        }else{
            return 'No';
        }
    }

    Public function getFutureValueFormatted() {

        // Set values
        $investment =  $this->getInvestment();
        $yearly_rate =  $this->getInterestRate();
        $years =  $this->getYears();
        // Uses formatted Compound Monthly
        $compound_monthy =  $this->getCompoundMonthlyFormatted();

        // calculate the future value
        $future_value = $investment;

        // if the check box is checked then it caclulates it as a monthly compound interest.
        if ($compound_monthy === 'Yes'){
            for ($i = 1; $i <= $years * 12; $i++) {
                $future_value += $future_value * ($yearly_rate/12) *.01;
            }
        }else {
            for ($i = 1; $i <= $years; $i++) {
                $future_value += $future_value * $yearly_rate *.01;
            }
        }

        return $this->getCurrencyFormat($future_value);
    }

    Public function validate($investment, $interest_rate, $years) {
        
        // validate investment
        if ($investment === FALSE ) {
            $error_message = 'Investment must be a valid number.'; 
        } else if ( $investment <= 0 ) {
            $error_message = 'Investment must be greater than zero.'; 
        // validate interest rate
        } else if ( $interest_rate === FALSE )  {
            $error_message = 'Interest rate must be a valid number.'; 
        } else if ( $interest_rate <= 0 ) {
            $error_message = 'Interest rate must be greater than zero.'; 
        // validate years
        } else if ( $years === FALSE ) {
            $error_message = 'Years must be a valid whole number.';
        } else if ( $years <= 0 ) {
            $error_message = 'Years must be greater than zero.';
        } else if ( $years > 30 ) {
            $error_message = 'Years must be less than 31.';
        // set error message to empty string if no invalid entries
        } else {
            $error_message = ''; 
        }

        // if an error message exists, go to the index page
        if ($error_message != '') {
            include('index.php');
            exit();
        }

        return $error_message;
    }
}
?>