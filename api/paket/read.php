<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Paket.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $paket = new Paket($db);

  // Blog post query
  $result = $paket->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any posts
  if($num > 0) {
    // Post array
    $paket_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $paket_item = array(
        'id_paket' => $id_paket,
        'nama_pengirim' => $nama_pengirim,
        'nama_penerima' => $nama_penerima,
        'no_hp' => $no_hp,
        'unit' => $unit,
        'tanggal_datang' => $tanggal_datang,
        'tanggal_pengambilan' => $tanggal_pengambilan,                
        'status' => $status
      );

      // Push to "data"
      array_push($paket_arr, $paket_item);
      // array_push($paket_arr['data'], $paket_item);
    }

    // Turn to JSON & output
    echo json_encode($paket_arr);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'Tidak ada paket')
    );
  }
