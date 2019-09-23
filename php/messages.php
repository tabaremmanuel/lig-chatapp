<?php
require_once 'db_connect.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));


if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

switch ($method){
    case 'GET':
      $id = $_GET['id'];
      $sql = "select * from messages".($id?" where id=$id":'');
      break;
    case 'POST':
      $message = $_POST["message"];
      $msg_from = $_POST["msg_from"];

      $sql = "insert into messages (message,msg_from) values ('$message','$msg_from')";
      break;
}

$result = mysqli_query($con,$sql);

if (!$result) {
  http_response_code(404);
  die(mysqli_error($con));
}



if ($method == 'GET') {
    if (!$id) echo '[';
    for ($i=0 ; $i<mysqli_num_rows($result) ; $i++) {
      echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    }
    if (!$id) echo ']';
  } elseif ($method == 'POST') {
    echo json_encode($result);
  } else {
    echo mysqli_affected_rows($con);
  }

$con->close();


?>
