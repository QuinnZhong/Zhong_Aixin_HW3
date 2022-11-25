<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset-UFT-8");

if($_POST) {
    $receipient = "youraddressgoeshere@yoururl.com";
    $subject = "Email from my portfolio site";
    $visitor_name = "";
    $visitor_email = "";
    $message = "";
    $fail = array();
    //Checks for firstname and cleans the text.
    if(isset($_POST['firstname']) && !empty ($_POST['firstname'])) {
        $visitor_name .= filter_var($_POST['firstname'], FILTER_SANTIZE_STRING);
    }else{
        array_push($fail, "firstname");
    }
    //Checks for lastname and cleans the text.
    if (isset($_POST['lastname']) && !empty ($_POST['lastname'])) {
        $visitor_name .= " ".filter_var($_POST['lastname'], FILTER_SANTIZE_STRING);
    }else{
        array_push($fail, "lastname");
    }
    //Checks for email and cleans the text.
    if (isset($_POST['email']) && !empty ($_POST['email'])) {
        $visitor_email = str_replace(array("\r", "\n", "%0a", "%0d"),
        "", $_POST['email']);
        $visitor_email = filter_var($visitor_email, FILTER_VALIDATE_EMAIL);
    }else{
        array_push($fail, "email");
    }
    //Checks for message and cleans the text.
    if (isset($_POST['message']) && !empty ($_POST['message'])) {
        $clean = filter_var($_POST['message'], FILTER_SANTIZE_STRING)
        $message = htmlspecialchars($clean);
    }else{
        array_push($fail, "message");
    }
    //
    $headers = "From: the variable that holds their email"."\r\n"."Peply_To: Again an email from the person"."\r\n"."X-Mailer: PHP/".phpversion();

    if (count($fail)==0) {
        mail($receipient, $subject, $message, $headers);
        $results['message'] = sprintf("Thank you for contacting us,%s. We will get back to you in 24 hours.", $visitor_name);
    }else{
        header('HTTP/1.1 488 Stop being lazy, fill out the form...thanks ;');
        die(json_encode(["message"=> $fail]));
    }

}else{
    $results['message'] = "Please fill out the form."
}

echo json_encode($results);






?>