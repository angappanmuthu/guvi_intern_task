<?php
$host=!empty($_ENV['MYSQL_HOST'])?$_ENV['MYSQL_HOST']:"localhost";
$username=!empty($_ENV['MYSQL_USER'])?$_ENV['MYSQL_USER']:"root";
$pass=!empty($_ENV['MYSQL_PASSWORD'])?$_ENV['MYSQL_PASSWORD']:"";
$db=!empty($_ENV['MYSQL_DB'])?$_ENV['MYSQL_DB']:"test";

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
    }else{
      $usr;
    }
    $i = $i + 1; 
  }
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