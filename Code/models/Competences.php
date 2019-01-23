<?php
class Competences {
    // DB Stuff
    private $conn;
    private $table = 'COMPETENCES';

    // Properties
    public $mailProf;
    public $idMat;
    public $idNiveau;
    public $matiere;
    public $niveau;

    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // Get competences
    public function read() {

        /*select mailProf, matieres.libelle as matiere, niveaux.libelle as niveau from competences inner join matieres on competences.idMat=matieres.idMat inner join niveaux on competences.idNiveau=niveaux.idNiveau;*/

        // Create query
        $query = 'SELECT
        mailProf,
        '.$this->table.'.idMat,
        '.$this->table.'.idNiveau,
        MATIERES.libelle as matiere, NIVEAUX.libelle as niveau
      FROM
        ' . $this->table.'
        inner join MATIERES on '.$this->table.'.idMat=MATIERES.idMat
        inner join NIVEAUX on '.$this->table.'.idNiveau=NIVEAUX.idNiveau';

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
        '.$this->table.'.idMat,
        '.$this->table.'.idNiveau,
        MATIERES.libelle as matiere, NIVEAUX.libelle as niveau
      FROM
          ' . $this->table . '
          inner join MATIERES on '.$this->table.'.idMat=MATIERES.idMat
        inner join NIVEAUX on '.$this->table.'.idNiveau=NIVEAUX.idNiveau
      WHERE mailProf = ? AND '.$this->table.'.idMat = ? AND '.$this->table.'.idNiveau = ?
      LIMIT 0,1';

        //Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->mailProf);
        $stmt->bindParam(2, $this->idMat);
        $stmt->bindParam(3, $this->idNiveau);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->mailProf = $row['mailProf'];
        $this->idNiveau = $row['idNiveau'];
        $this->idMat = $row['idMat'];
        $this->matiere = $row['matiere'];
        $this->niveau = $row['niveau'];
    }

    public function create() {
        // Create Query
        $query = 'INSERT INTO ' .
            $this->table . '
    SET
      mailProf = :mailProf,
      idMat = :idMat,
      idNiveau = :idNiveau';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->mailProf = htmlspecialchars(strip_tags($this->mailProf));
        $this->idMat = htmlspecialchars(strip_tags($this->idMat));
        $this->idNiveau = htmlspecialchars(strip_tags($this->idNiveau));

        // Bind data
        $stmt-> bindParam(':mailProf', $this->mailProf);
        $stmt-> bindParam(':idMat', $this->idMat);
        $stmt-> bindParam(':idNiveau', $this->idNiveau);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: $s.\n", $stmt->error);

        return false;
    }

    //A réfléchir --> clés étrangères qui sont primaires
    /*public function update() {
        // Create Query
        $query = 'UPDATE ' .
            $this->table . '
    SET
      libelle = :libelle
      WHERE
      idMat = :idMat';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->libelle = htmlspecialchars(strip_tags($this->libelle));
        $this->idMat = htmlspecialchars(strip_tags($this->idMat));

        // Bind data
        $stmt-> bindParam(':libelle', $this->libelle);
        $stmt-> bindParam(':idMat', $this->idMat);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: $s.\n", $stmt->error);

        return false;
    }*/

    // Attention clé étrangère
    /*public function delete() {
        // Create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE idMat = :idMat';

        // Prepare Statement
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->idMat = htmlspecialchars(strip_tags($this->idMat));

        // Bind Data
        $stmt-> bindParam(':idMat', $this->idMat);

        // Execute query
        if($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: $s.\n", $stmt->error);

        return false;
    }*/
}
