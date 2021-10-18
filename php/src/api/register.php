<?php
include_once('db.php');
header('Content-Type: application/json; charset=utf-8');
// echo json_encode($_POST);

if($_POST['mobile'] != "" && $_POST['pass'] != ""){
    $mobile = $_POST['mobile'];
    $password = $_POST['pass'];

    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (mobile, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $mob, $pass);

    // set parameters and execute
    $mob = $mobile;
    $pass = $password;
    $rs = $stmt->execute();

    $data = array("status" => False,"message" => "Failed!");

    if ($rs > 0){
        $data = array("status" => True, "message" => "Successfully Registered!");
        addData(array("mobile" => $mobile,"password" => $password,"name"=>"","email" => "","age" => "","dob" => "","city" => ""));
        echo json_encode($data);
    }
    else{
        $data = array("status" => False,"message" => "Failed!","reason" => "User Exist!","error" => mysqli_error($conn));
        echo json_encode($data);
    }
    // echo json_encode(array("mobile" => $mobile,"password" => $password));

    $stmt->close();
    $conn->close();
}

?>