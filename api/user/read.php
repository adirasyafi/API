<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

  $database = new Database();
  $db = $database->connect();

  $user = new User($db);

  $result = $user->read();

  $num = $result->rowCount();

  if($num > 0) {
        $user_arr = array();
        $user_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $user_item = array(
            'username' => $username,
            'unit' => $unit,
            'password' => $password
          );

          array_push($user_arr['data'], $user_item);
        }

        echo json_encode($user_arr);

  } else {
        echo json_encode(
          array('message' => 'Tidak ada User')
        );
  }
