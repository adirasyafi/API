<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $user = new User($db);

  // Category read query
  $result = $user->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $user_arr = array();
        $user_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $user_item = array(
            'username' => $username,
            'unit' => $unit,
            'password' => $password
          );

          // Push to "data"
          array_push($user_arr['data'], $user_item);
        }

        // Turn to JSON & output
        echo json_encode($user_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'Tidak ada User')
        );
  }
