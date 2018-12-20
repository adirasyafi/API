<?php 
  class Paket {
    private $conn;
    private $table = 'paket';

    public $id_paket;
    public $nama_pengirim;
    public $nama_penerima;
    public $no_hp;
    public $unit;
    public $tanggal_datang;
    public $tanggal_pengambilan;                
    public $status;

    public function __construct($db) {
      $this->conn = $db;
    }

    public function read() {
      $query = 'SELECT p.id_paket, p.nama_pengirim, p.nama_penerima, p.no_hp, p.unit, p.tanggal_datang, p.tanggal_pengambilan, p.status
                                FROM ' . $this->table . ' p
                                ORDER BY
                                  p.tanggal_datang DESC';
      
      $stmt = $this->conn->prepare($query);

      $stmt->execute();

      return $stmt;
    }

    public function read_single() {
          $query = 'SELECT p.id_paket, p.nama_pengirim, p.nama_penerima, p.no_hp, p.unit, p.tanggal_datang, p.tanggal_pengambilan, p.status
                                FROM ' . $this->table . ' p
                                    WHERE
                                      p.id_paket = ?
                                    LIMIT 0,1';

          $stmt = $this->conn->prepare($query);

          $stmt->bindParam(1, $this->id);

          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          $this->nama_pengirim = $row['nama_pengirim'];
		  $this->nama_penerima = $row['nama_penerima'];
		  $this->no_hp = $row['no_hp'];
		  $this->unit = $row['unit'];
		  $this->tanggal_datang = $row['tanggal_datang'];
		  $this->tanggal_pengambilan = $row['tanggal_pengambilan'];
		  $this->status = $row['status']; 
    }

    public function create() {
          $query = 'INSERT INTO ' . $this->table . ' SET nama_pengirim = :nama_pengirim, nama_penerima = :nama_penerima, no_hp = :no_hp, unit = :unit, tanggal_datang = :tanggal_datang, tanggal_pengambilan = :tanggal_pengambilan, status = :status';

          $stmt = $this->conn->prepare($query);

		  $this->nama_pengirim = htmlspecialchars(strip_tags($this->nama_pengirim));
		  $this->nama_penerima = htmlspecialchars(strip_tags($this->nama_penerima));
		  $this->no_hp = htmlspecialchars(strip_tags($this->no_hp));
		  $this->unit = htmlspecialchars(strip_tags($this->unit));
		  $this->tanggal_datang = htmlspecialchars(strip_tags($this->tanggal_datang));
		  $this->tanggal_pengambilan = htmlspecialchars(strip_tags($this->tanggal_pengambilan));
		  $this->status = htmlspecialchars(strip_tags($this->status));

          $stmt->bindParam(':nama_pengirim', $this->nama_pengirim);
		  $stmt->bindParam(':nama_penerima', $this->nama_penerima);
		  $stmt->bindParam(':no_hp', $this->no_hp);
		  $stmt->bindParam(':unit', $this->unit);
		  $stmt->bindParam(':tanggal_datang', $this->tanggal_datang);
		  $stmt->bindParam(':tanggal_pengambilan', $this->tanggal_pengambilan);
		  $stmt->bindParam(':status', $this->status); 
		  
          if($stmt->execute()) {
            return true;
      }

      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    public function update() {
          $query = 'UPDATE ' . $this->table . '
                                SET nama_pengirim = :nama_pengirim, nama_penerima = :nama_penerima, no_hp = :no_hp, unit = :unit, tanggal_datang = :tanggal_datang, tanggal_pengambilan = :tanggal_pengambilan, status = :status
                                WHERE id_paket = :id_paket';

          $stmt = $this->conn->prepare($query);

		  $this->id_paket = htmlspecialchars(strip_tags($this->id_paket));
		  $this->nama_pengirim = htmlspecialchars(strip_tags($this->nama_pengirim));
		  $this->nama_penerima = htmlspecialchars(strip_tags($this->nama_penerima));
		  $this->no_hp = htmlspecialchars(strip_tags($this->no_hp));
		  $this->unit = htmlspecialchars(strip_tags($this->unit));
		  $this->tanggal_datang = htmlspecialchars(strip_tags($this->tanggal_datang));
		  $this->tanggal_pengambilan = htmlspecialchars(strip_tags($this->tanggal_pengambilan));
		  $this->status = htmlspecialchars(strip_tags($this->status));

          $stmt->bindParam(':id_paket', $this->id_paket);
          $stmt->bindParam(':nama_pengirim', $this->nama_pengirim);
		  $stmt->bindParam(':nama_penerima', $this->nama_penerima);
		  $stmt->bindParam(':no_hp', $this->no_hp);
		  $stmt->bindParam(':unit', $this->unit);
		  $stmt->bindParam(':tanggal_datang', $this->tanggal_datang);
		  $stmt->bindParam(':tanggal_pengambilan', $this->tanggal_pengambilan);
		  $stmt->bindParam(':status', $this->status); 

          if($stmt->execute()) {
            return true;
          }

          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    public function delete() {
          $query = 'DELETE FROM ' . $this->table . ' WHERE id_paket = :id_paket';

          $stmt = $this->conn->prepare($query);

          $this->id_paket = htmlspecialchars(strip_tags($this->id_paket));

          $stmt->bindParam(':id_paket', $this->id_paket);

          if($stmt->execute()) {
            return true;
          }

          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }
