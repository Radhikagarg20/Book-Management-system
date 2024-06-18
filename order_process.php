<?php
session_start();

include("includes/connection.php");

if(!empty($_POST))
{
    extract($_POST);
    extract($_SESSION);

    $_SESSION['error']=array();

    if(empty($fnm))
    {
        $_SESSION['error'][]="Enter Full Name";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $fnm)) {
        $_SESSION['error'][]="Name must contain only alphabetical characters";
    }

    if(empty($add))
    {
        $_SESSION['error'][]="Enter Full Address";
    }

    if (empty($pc)) {
        $_SESSION['error'][] = "Enter City Pincode";
    } elseif (!is_numeric($pc) || strlen($pc) != 6) {
        $_SESSION['error'][] = "Pin code must be a 6-digit numeric value";
    }    

    if(empty($city))
    {
        $_SESSION['error'][]="Enter City";
    } elseif (!ctype_alpha($city)) {
        $_SESSION['error'][]="City must contain only alphabetical characters";
    }

    if(empty($state))
    {
        $_SESSION['error']['state']="Enter State";
    } elseif (!ctype_alpha($state)) {
        $_SESSION['error']['state']="State must contain only alphabetical characters";
    }

    if(empty($mno))
    {
        $_SESSION['error'][]="Enter Mobile Number";
    }
    elseif(!is_numeric($mno) || strlen($mno) != 10)
    {
        $_SESSION['error'][]="Mobile Number must be 10 digits";
    }

    if(!empty($_SESSION['error']))
    {
        header("location:order.php");
    }
    else
    {
        $rid=$_SESSION['client']['id'];

        $q="INSERT INTO `bms`.`order` (
                    `o_id` ,
                    `o_name` ,
                    `o_address` ,
                    `o_pincode` ,
                    `o_city` ,
                    `o_state` ,
                    `o_mobile` ,
                    `o_rid`
                    )
                    VALUES (
                    NULL , '$fnm', '$add', '$pc', '$city', '$state', '$mno', '$rid'
                    )";

        $res=mysqli_query($link,$q);
        if ($res) {
            // If insertion was successful, redirect to order_summary.php
            header("location: order_summary.php?total=$total");
            exit();
        } else {
            // Handle any errors here...
        }
    }
} else {
    header("location: order.php");
}
?>
