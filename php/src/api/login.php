<?php
include_once('db.php');
header('Content-Type: application/json; charset=utf-8');


if($_POST['mobile'] != "" && $_POST['pass'] != ""){
    $mobile = $_POST['mobile'];
    $password = $_POST['pass'];

    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE mobile=? AND password=?");
    $stmt->bind_param("ss", $mob, $pass);

    $mob = $mobile;
    $pass = $password;
    $stmt->execute();
    $stmt->bind_result($num_rows);
    $stmt->fetch();
    // echo $num_rows;

    if($num_rows > 0){
        echo json_encode(array("status" => true,"message" => "Success"));
    }else{
        echo json_encode(array("status" => false,"message" => "failed","error" => mysqli_error($conn)));
    }
}
?>