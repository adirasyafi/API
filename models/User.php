<?php
  class User {
    // DB Stuff
    private $conn;
    private $table = 'user';

    // Properties
    public $username;
    public $unit;
    public $password;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get categories
    public function read() {
      // Create query
      $query = 'SELECT
        username,
        unit,
        password
      FROM
        ' . $this->table . '
      ORDER BY
        unit DESC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Category
  public function read_single(){
    // Create query
    $query = 'SELECT
          username,
		  unit
        FROM
          ' . $this->table . '
      WHERE unit = ?
      LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->unit);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->username = $row['username'];
      $this->password = $row['password'];
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      username = :username
      password = :password';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->username = htmlspecialchars(strip_tags($this->username));

  // Bind data
  $stmt-> bindParam(':username', $this->username);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Update Category
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      username = :username
      password = :password
      WHERE
      unit = :unit';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->username = htmlspecialchars(strip_tags($this->username));
  $this->unit = htmlspecialchars(strip_tags($this->unit));
  $this->password = htmlspecialchars(strip_tags($this->password));

  // Bind data
  $stmt-> bindParam(':username', $this->username);
  $stmt-> bindParam(':unit', $this->unit);
  $stmt-> bindParam(':password', $this->password);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Delete Category
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE unit = :unit';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->unit = htmlspecialchars(strip_tags($this->unit));

    // Bind Data
    $stmt-> bindParam(':unit', $this->unit);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
  }
