<?php 
  class Paket {
    // DB stuff
    private $conn;
    private $table = 'paket';

    // Post Properties
    public $id_paket;
    public $nama_pengirim;
    public $nama_penerima;
    public $no_hp;
    public $unit;
    public $tanggal_datang;
    public $tanggal_pengambilan;                
    public $status;


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT p.id_paket, p.nama_pengirim, p.nama_penerima, p.no_hp, p.unit, p.tanggal_datang, p.tanggal_pengambilan, p.status
                                FROM ' . $this->table . ' p
                                ORDER BY
                                  p.tanggal_datang DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT p.id_paket, p.nama_pengirim, p.nama_penerima, p.no_hp, p.unit, p.tanggal_datang, p.tanggal_pengambilan, p.status
                                FROM ' . $this->table . ' p
                                    WHERE
                                      p.id_paket = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->nama_pengirim = $row['nama_pengirim'];
		  $this->nama_penerima = $row['nama_penerima'];
		  $this->no_hp = $row['no_hp'];
		  $this->unit = $row['unit'];
		  $this->tanggal_datang = $row['tanggal_datang'];
		  $this->tanggal_pengambilan = $row['tanggal_pengambilan'];
		  $this->status = $row['status']; 
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET nama_pengirim = :nama_pengirim, nama_penerima = :nama_penerima, no_hp = :no_hp, unit = :unit, tanggal_datang = :tanggal_datang, tanggal_pengambilan = :tanggal_pengambilan, status = :status';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
		  $this->nama_pengirim = htmlspecialchars(strip_tags($this->nama_pengirim));
		  $this->nama_penerima = htmlspecialchars(strip_tags($this->nama_penerima));
		  $this->no_hp = htmlspecialchars(strip_tags($this->no_hp));
		  $this->unit = htmlspecialchars(strip_tags($this->unit));
		  $this->tanggal_datang = htmlspecialchars(strip_tags($this->tanggal_datang));
		  $this->tanggal_pengambilan = htmlspecialchars(strip_tags($this->tanggal_pengambilan));
		  $this->status = htmlspecialchars(strip_tags($this->status));

          // Bind data
          $stmt->bindParam(':nama_pengirim', $this->nama_pengirim);
		  $stmt->bindParam(':nama_penerima', $this->nama_penerima);
		  $stmt->bindParam(':no_hp', $this->no_hp);
		  $stmt->bindParam(':unit', $this->unit);
		  $stmt->bindParam(':tanggal_datang', $this->tanggal_datang);
		  $stmt->bindParam(':tanggal_pengambilan', $this->tanggal_pengambilan);
		  $stmt->bindParam(':status', $this->status); 
		  

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET nama_pengirim = :nama_pengirim, nama_penerima = :nama_penerima, no_hp = :no_hp, unit = :unit, tanggal_datang = :tanggal_datang, tanggal_pengambilan = :tanggal_pengambilan, status = :status
                                WHERE id_paket = :id_paket';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
		  $this->id_paket = htmlspecialchars(strip_tags($this->id_paket));
		  $this->nama_pengirim = htmlspecialchars(strip_tags($this->nama_pengirim));
		  $this->nama_penerima = htmlspecialchars(strip_tags($this->nama_penerima));
		  $this->no_hp = htmlspecialchars(strip_tags($this->no_hp));
		  $this->unit = htmlspecialchars(strip_tags($this->unit));
		  $this->tanggal_datang = htmlspecialchars(strip_tags($this->tanggal_datang));
		  $this->tanggal_pengambilan = htmlspecialchars(strip_tags($this->tanggal_pengambilan));
		  $this->status = htmlspecialchars(strip_tags($this->status));

          // Bind data
          $stmt->bindParam(':id_paket', $this->id_paket);
          $stmt->bindParam(':nama_pengirim', $this->nama_pengirim);
		  $stmt->bindParam(':nama_penerima', $this->nama_penerima);
		  $stmt->bindParam(':no_hp', $this->no_hp);
		  $stmt->bindParam(':unit', $this->unit);
		  $stmt->bindParam(':tanggal_datang', $this->tanggal_datang);
		  $stmt->bindParam(':tanggal_pengambilan', $this->tanggal_pengambilan);
		  $stmt->bindParam(':status', $this->status); 

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }

    // Delete Post
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id_paket = :id_paket';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id_paket = htmlspecialchars(strip_tags($this->id_paket));

          // Bind data
          $stmt->bindParam(':id_paket', $this->id_paket);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }
