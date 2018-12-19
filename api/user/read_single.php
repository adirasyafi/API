<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $user = new User($db);

  // Get ID
  $user->unit = isset($_GET['unit']) ? $_GET['unit'] : die();

  // Get post
  $unit->read_single();

  // Create array
  $unit_arr = array(
    'username' => $user->username,
    'unit' => $user->unit,
    'password' => $user>password
  );

  // Make JSON
  print_r(json_encode($user_arr));
