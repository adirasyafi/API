<?php
  class User {
    private $conn;
    private $table = 'user';

    public $username;
    public $unit;
    public $password;


    public function __construct($db) {
      $this->conn = $db;
    }

    public function read() {
      $query = 'SELECT
        username,
        unit,
        password
      FROM
        ' . $this->table . '
      ORDER BY
        unit DESC';

      $stmt = $this->conn->prepare($query);

      $stmt->execute();

      return $stmt;
    }

  public function read_single(){
    // Create query
    $query = 'SELECT
          username,
		  unit
        FROM
          ' . $this->table . '
      WHERE unit = ?
      LIMIT 0,1';

      $stmt = $this->conn->prepare($query);

      $stmt->bindParam(1, $this->unit);

      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $this->username = $row['username'];
      $this->password = $row['password'];
  }

  public function create() {
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      username = :username
      password = :password';

  $stmt = $this->conn->prepare($query);

  $this->username = htmlspecialchars(strip_tags($this->username));

  $stmt-> bindParam(':username', $this->username);

  if($stmt->execute()) {
    return true;
  }

  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  public function update() {
    $query = 'UPDATE ' .
      $this->table . '
    SET
      username = :username
      password = :password
      WHERE
      unit = :unit';

  $stmt = $this->conn->prepare($query);

  $this->username = htmlspecialchars(strip_tags($this->username));
  $this->unit = htmlspecialchars(strip_tags($this->unit));
  $this->password = htmlspecialchars(strip_tags($this->password));

  $stmt-> bindParam(':username', $this->username);
  $stmt-> bindParam(':unit', $this->unit);
  $stmt-> bindParam(':password', $this->password);

  if($stmt->execute()) {
    return true;
  }

  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  public function delete() {
    $query = 'DELETE FROM ' . $this->table . ' WHERE unit = :unit';

    $stmt = $this->conn->prepare($query);

    $this->unit = htmlspecialchars(strip_tags($this->unit));

    $stmt-> bindParam(':unit', $this->unit);

    if($stmt->execute()) {
      return true;
    }

    printf("Error: $s.\n", $stmt->error);

    return false;
    }
  }
