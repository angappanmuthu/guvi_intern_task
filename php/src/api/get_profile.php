<?php
include_once('db.php');
header('Content-Type: application/json; charset=utf-8');

if($_POST['mobile'] != ""){
    $sql = "SELECT name,age,dob,email,city
        FROM users
        WHERE mobile= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $mob);
    $mob = $_POST['mobile'];
    $stmt->execute();
    // $stmt->bind_result($name,$dob,$email,$city);
    // $stmt->fetch();
    // echo json_encode(array("name" => $name,"dob" => $dob, "email" => $email,"city" => $city));
    $result = $stmt->get_result();
    $resultset = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($resultset);
    
}

?>