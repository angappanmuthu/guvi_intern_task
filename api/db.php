<?php
$host='localhost';
$username='root';
$pass='';
$db='guvi';

$conn = mysqli_connect($host,$username,$pass,$db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

function addData($data){
  $file = realpath('../data/db.json');
  $rdata = json_decode(file_get_contents($file));
  $array = json_decode(json_encode($rdata), true);
  array_push($array['users'],$data);
  // print_r($array);
  file_put_contents($file, json_encode($array));
}

function updateData($mobile,$data){
  $file = realpath('../data/db.json');
  $rdata = json_decode(file_get_contents($file));
  $array = json_decode(json_encode($rdata), true);
  $users = $array['users'];
  // Update array
  $i = 0;
  foreach($users as $usr){
    $replacements = $data;

    if ($usr['mobile'] == $mobile){
      $rs = $users[$i] = array_replace($usr,$replacements);
      // print_r($rs);
    }else{
      $usr;
      // echo "else";
    }
    // array_push($array['users'],$rs);
    $i = $i + 1; 
  }
  // print_r($users);
  // echo json_encode($users);
  $user_table = array("users" => $users);
  file_put_contents($file, json_encode($user_table));
}



// $mobile = "8825942331";
// $name = "test";
// $email = "email";
// $age = "21";
// $dob = "2000-03-23";
// $city = "karaikudi";
// $d = array('name' => $name,'email' => $email,"age" => $age, "dob" => $dob,"city" => $city);

// updateData($mobile,$d);
?>