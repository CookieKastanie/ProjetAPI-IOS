<?php
class Prof {
    // DB Stuff
    private $conn;
    private $table = 'PROF';

    // Properties
    public $mailProf;
    public $nom;
    public $prenom;
    public $presentation;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get profs
    public function read() {
        // Create query
        $query = 'SELECT
        mailProf,
        nom,
        prenom,
        presentation
      FROM
        ' . $this->table;

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    public function read_single(){
        // Create query
        $query = 'SELECT
          mailProf,
          nom,
          prenom,
          presentation
        FROM
          ' . $this->table . '
      WHERE mailProf = ?
      LIMIT 0,1';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->mailProf);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->mailProf = $row['mailProf'];
        $this->nom = $row['nom'];
        $this->prenom = $row['prenom'];
        $this->presentation = $row['presentation'];
    }

    public function create() {
        // Create Query
        $query = 'INSERT INTO ' .
            $this->table . '
    SET
      mailProf = :mailProf,
      nom = :nom,
      prenom = :prenom,
      presentation = :presentation';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->nom = htmlspecialchars(strip_tags($this->nom));

        // Bind data
        $stmt-> bindParam(':mailProf', $this->mailProf);
        $stmt-> bindParam(':nom', $this->nom);
        $stmt-> bindParam(':prenom', $this->prenom);
        $stmt-> bindParam(':presentation', $this->presentation);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: $s.\n", $stmt->error);

        return false;
    }

    public function update() {
        // Create Query
        $query = 'UPDATE ' .
            $this->table . '
    SET
      nom = :nom,
      prenom = :prenom,
      presentation = :presentation
      WHERE
      mailProf = :mailProf';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->nom = htmlspecialchars(strip_tags($this->nom));
        $this->prenom = htmlspecialchars(strip_tags($this->prenom));
        $this->presentation = htmlspecialchars(strip_tags($this->presentation));
        $this->mailProf = htmlspecialchars(strip_tags($this->mailProf));

        // Bind data
        $stmt-> bindParam(':nom', $this->nom);
        $stmt-> bindParam(':prenom', $this->prenom);
        $stmt-> bindParam(':presentation', $this->presentation);
        $stmt-> bindParam(':mailProf', $this->mailProf);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: $s.\n", $stmt->error);

        return false;
    }

    public function delete() {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE mailProf = :mailProf';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->mailProf = htmlspecialchars(strip_tags($this->mailProf));

        // Bind Data
        $stmt-> bindParam(':mailProf', $this->mailProf);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: $s.\n", $stmt->error);

        return false;
    }
}
