<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Paket.php';

  $database = new Database();
  $db = $database->connect();

  $paket = new Paket($db);

  $data = json_decode(file_get_contents("php://input"));

  $paket->id_paket = $data->id_paket;

  if($paket->delete()) {
    echo json_encode(
      array('message' => 'Paket dihapus')
    );
  } else {
    echo json_encode(
      array('message' => 'Paket tidak berhasil dihapus')
    );
  }

