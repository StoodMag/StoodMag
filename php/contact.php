<?php 

$array = array("firstname" => "", "name" => "", "email" => "", "phone" => "", "message" => "", "firstnameError" => "", "nameError" => "", "emailError" => "", "phoneError" => "", "messageError" => "", "isSuccess" => false);
$emailTo = "pierre.konyk@gmail.com";

if($_SERVER["REQUEST_METHOD"]== "POST"){
    $array["firstname"] = veryInput($_POST['firstname']);
    $array["name"] = veryInput($_POST['name']);
    $array["email"] = veryInput($_POST['email']);
    $array["phone"]= veryInput($_POST['phone']);
    $array["message"] = veryInput($_POST['message']);
    $array["isSuccess"]= true;
    $emailText = "";

        if(empty($array["firstname"])){
            $array["firstnameError"]= "This field cannot be left empty.";
            $array["isSuccess"] = false;
        } else {
            $emailText .= "Firstname: {$array["firstname"]}\n";
        };


        if(empty($array["name"])){
            $array["nameError"] = "This field cannot be left  empty.";
            $array["isSuccess"] = false;
        } else {
            $emailText .= "Name: {$array["name"]}\n";
        };


        if(!isEmail($array["email"])){
            $array["emailError"] = "Please enter a valid email address.";
            $array["isSuccess"] = false;
        } else {
            $emailText .= "Email: {$array["email"]}\n";
        };

        if(empty($array["message"])){
            $array["messageError"] = "This field cannot be  left empty.";
            $array["isSuccess"] = false;
        } else {
            $emailText .= "Message: {$array["message"]}\n";
        };

        if($array["isSuccess"]){
            $headers = "From:  {$array["firstname"]} {$array["name"]} <{$array["email"]}>\r\nReply-To: {$array["email"]}";
            mail($emailTo, "A message", $emailText, $headers);
        }

        echo json_encode($array);
}


function isEmail($var){
    return filter_var($var, FILTER_VALIDATE_EMAIL);
}

function veryInput($var){
    $var = trim($var);
    $var = stripslashes($var);
    $var = htmlspecialchars($var);
    return $var;
}
?>
