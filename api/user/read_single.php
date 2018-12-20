<?php

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

  $database = new Database();
  $db = $database->connect();

  $user = new User($db);

  $user->unit = isset($_GET['unit']) ? $_GET['unit'] : die();

  $user->read_single();

  $user_arr = array(
    'username' => $user->username,
    'unit' => $user->unit,
    'password' => $user>password
  );

  print_r(json_encode($user_arr));
