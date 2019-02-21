<?php

//check whether stripe token is not empty
if(!empty($_POST['stripeToken'])){
    //get token, card and user info from the form
    $token  = $_POST['stripeToken'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $card_num = $_POST['card_num'];
    $card_cvc = $_POST['cvc'];
    $card_exp_month = $_POST['exp_month'];
    $card_exp_year = $_POST['exp_year'];
    
    //include Stripe PHP library
    require_once('../stripe-php-6.29.3/init.php'); 
    
    //set api key
    $stripe = array(
      "secret_key"      => "sk_test_rcHcPOtgSwy9sJgo0HXDWnxS",
      "publishable_key" => "pk_test_pUFkdQjBPOvTswhElBfiCXPH"
    );
    
    \Stripe\Stripe::setApiKey($stripe['secret_key']);
    
    //add customer to stripe
    $customer = \Stripe\Customer::create(array(
        'email' => $email,
        'source'  => $token
    ));
    
    //item information
    $itemName = "Premium Script CodexWorld";
    $itemNumber = "PS123456";
    $itemPrice = 55;
    $currency = "usd";
    $orderID = "SKA92712382139";
    
    //charge a credit or a debit card
    $charge = \Stripe\Charge::create(array(
        'customer' => $customer->id,
        'amount'   => $itemPrice,
        'currency' => $currency,
        'description' => $itemName,
        'metadata' => array(
            'order_id' => $orderID
        )
    ));
    
    //retrieve charge details
    $chargeJson = $charge->jsonSerialize();

    //check whether the charge is successful
    if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1){
        //order details 
        $amount = $chargeJson['amount'];
        $balance_transaction = $chargeJson['balance_transaction'];
        $currency = $chargeJson['currency'];
        $status = $chargeJson['status'];
        $date = date("Y-m-d H:i:s");
        
        //include database config file
        include_once 'config.php';
        
        //insert tansaction data into the database
        $sql = "INSERT INTO orders(name,email,card_num,card_cvc,card_exp_month,card_exp_year,item_name,item_number,item_price,item_price_currency,paid_amount,paid_amount_currency,txn_id,payment_status,created,modified) VALUES('".$name."','".$email."','".$card_num."','".$card_cvc."','".$card_exp_month."','".$card_exp_year."','".$itemName."','".$itemNumber."','".$itemPrice."','".$currency."','".$amount."','".$currency."','".$balance_transaction."','".$status."','".$date."','".$date."')";
        //$insert = $db->query($link, $sql));
        //$last_insert_id = $db->insert_id;
        

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssssssssss", $param_name, $param_email, $param_card_num,$param_card_cvc,$param_card_exp_month,$param_card_exp_year,$param_item_name,$param_item_number,$param_item_price,$param_item_price_currency,$param_paid_amount,$param_paid_amount_currency,$param_txn_id,$param_payment_status,$param_created,$param_modified, $param_users_id);
            
            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_card_num = $card_num;
            $param_card_cvc = $card_cvc;
            $param_card_exp_month = $card_exp_month;
            $param_card_exp_year = $card_exp_year;
            $param_item_name = $item_name;
            $param_item_number = $item_number;
            $param_item_price = $item_price;
            $param_item_price_currency = $item_price_currency;
            $param_paid_amount = $paid_amount;
            $param_paid_amount_currency = $paid_amount_currency;
            $param_txn_id = $txn_id;
            $param_payment_status = $payment_status;
            $param_created = $created;
            $param_modified = $modified;



            $param_users_id = htmlspecialchars($_SESSION["id"]);
            
           

            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: welcomes.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
                   }
        }

           
       
              //if order inserted successfully
            if($last_insert_id && $status == 'succeeded'){
            $statusMsg = "<h2>The transaction was successful.</h2><h4>Order ID: {$last_insert_id}</h4>";

                 




   }    else{
                  $statusMsg = "Transaction has been failed";
                     }
    }            else{
                  $statusMsg = "Transaction has been failed";
                     }
}                 else{
                  $statusMsg = "Form submission error.......";
                      }

//show success or error message
echo $statusMsg;
?>
