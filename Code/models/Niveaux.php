<?php
class Niveaux {
    // DB Stuff
    private $conn;
    private $table = 'NIVEAUX';

    // Properties
    public $idNiveau;
    public $libelle;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get niveaux
    public function read() {
        // Create query
        $query = 'SELECT
        idNiveau,
        libelle
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
          idNiveau,
          libelle
        FROM
          ' . $this->table . '
      WHERE idNiveau = ?
      LIMIT 0,1';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->idNiveau);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->idNiveau = $row['idNiveau'];
        $this->libelle = $row['libelle'];
    }

    public function create() {
        // Create Query
        $query = 'INSERT INTO ' .
            $this->table . '
    SET
      libelle = :libelle';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->libelle = htmlspecialchars(strip_tags($this->libelle));

        // Bind data
        $stmt-> bindParam(':libelle', $this->libelle);

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
      libelle = :libelle
      WHERE
      idNiveau = :idNiveau';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->libelle = htmlspecialchars(strip_tags($this->libelle));
        $this->idNiveau = htmlspecialchars(strip_tags($this->idNiveau));

        // Bind data
        $stmt-> bindParam(':libelle', $this->libelle);
        $stmt-> bindParam(':idNiveau', $this->idNiveau);

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
        $query = 'DELETE FROM ' . $this->table . ' WHERE idNiveau = :idNiveau';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->idNiveau = htmlspecialchars(strip_tags($this->idNiveau));

        // Bind Data
        $stmt-> bindParam(':idNiveau', $this->idNiveau);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: $s.\n", $stmt->error);

        return false;
    }
}
