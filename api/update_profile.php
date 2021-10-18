<?php
include_once('db.php');
header('Content-Type: application/json; charset=utf-8');

if($_POST['name'] != "" && $_POST['age'] != "" && $_POST['dob'] != "" &&$_POST['email'] != "" && $_POST['city'] != "" && $_POST['mobile']){
    
    // prepare and bind
    $stmt = $conn->prepare("UPDATE users SET name=?,age=?,dob=?,email=?,city=? WHERE mobile=?");
    $stmt->bind_param("sissss", $name,$age,$dob,$email,$city,$_POST['mobile']);

    // set parameters and execute
    $name = $_POST['name'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $rs = $stmt->execute();

    $data = array("status" => False,"message" => "Failed!");

    if ($rs > 0){
        $data = array("status" => True, "message" => "Successfully Updated!");
        $d = array('name' => $name,'email' => $email,"age" => $age, "dob" => $dob,"city" => $city);
        updateData($_POST['mobile'],$d);
        echo json_encode($data);
    }else{
        $data = array("status" => False,"message" => "Failed!","reason" => "User Exist!","error" => mysqli_error($conn));
        echo json_encode($data);
    }

    $stmt->close();
    $conn->close();
    
}

?>