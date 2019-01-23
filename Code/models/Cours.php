<?php
  class Cours {
    // DB Stuff
    private $conn;
    private $table = 'COURS';

    // Properties
    public $mailEleve;
    public $mailProf;
    public $idMat;
    public $idNiveau;
    public $dateCours;
    public $etat;
    public $matiere;
    public $niveau;


    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get matieres
    public function read() {
      // Create query
      $query = 'SELECT
        mailEleve,
        mailProf,
        '.$this->table.'.idMat,
        '.$this->table.'.idNiveau,
        dateCours,
        etat,
        MATIERES.libelle as matiere, NIVEAUX.libelle as niveau
      FROM
        ' . $this->table .'
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
          mailEleve,
          mailProf,
          '.$this->table.'.idMat,
          '.$this->table.'.idNiveau,
          dateCours,
          etat,
          MATIERES.libelle as matiere, NIVEAUX.libelle as niveau
        FROM
          ' . $this->table . '
          inner join MATIERES on '.$this->table.'.idMat=MATIERES.idMat
          inner join NIVEAUX on '.$this->table.'.idNiveau=NIVEAUX.idNiveau
      WHERE mailEleve = ? AND mailProf = ? AND '.$this->table.'.idMat = ? AND '.$this->table.'.idNiveau = ? AND dateCours = ?
      LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->mailEleve);
      $stmt->bindParam(2, $this->mailProf);
      $stmt->bindParam(3, $this->idMat);
      $stmt->bindParam(4, $this->idNiveau);
      $stmt->bindParam(5, $this->dateCours);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->mailEleve = $row['mailEleve'];
      $this->mailProf = $row['mailProf'];
      $this->idMat = $row['idMat'];
      $this->idNiveau = $row['idNiveau'];
      $this->dateCours = $row['dateCours'];
      $this->etat = $row['etat'];
      $this->matiere = $row['matiere'];
      $this->niveau = $row['niveau'];
  }

  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      mailEleve = :mailEleve,
      mailProf = :mailProf,
      idMat = :idMat,
      idNiveau = :idNiveau,
      dateCours = :dateCours,
      etat = :etat';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->mailEleve = htmlspecialchars(strip_tags($this->mailEleve));
  $this->mailProf = htmlspecialchars(strip_tags($this->mailProf));
  $this->idMat = htmlspecialchars(strip_tags($this->idMat));
  $this->idNiveau = htmlspecialchars(strip_tags($this->idNiveau));
  $this->dateCours = htmlspecialchars(strip_tags($this->dateCours));
  $this->etat = htmlspecialchars(strip_tags($this->etat));

  // Bind data
  $stmt->bindParam(':mailEleve', $this->mailEleve);
  $stmt->bindParam(':mailProf', $this->mailProf);
  $stmt->bindParam(':idMat', $this->idMat);
  $stmt->bindParam(':idNiveau', $this->idNiveau);
  $stmt->bindParam(':dateCours', $this->dateCours);
  $stmt->bindParam(':etat', $this->etat);

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
      mailEleve = :mailEleve,
      mailProf = :mailProf,
      idMat = :idMat,
      idNiveau = :idNiveau,
      dateCours = :dateCours,
      etat = :etat
    WHERE mailEleve = :mailEleve AND mailProf = :mailProf AND idMat = :idMat AND idNiveau = :idNiveau AND dateCours = :dateCours';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->mailEleve = htmlspecialchars(strip_tags($this->mailEleve));
  $this->mailProf = htmlspecialchars(strip_tags($this->mailProf));
  $this->idMat = htmlspecialchars(strip_tags($this->idMat));
  $this->idNiveau = htmlspecialchars(strip_tags($this->idNiveau));
  $this->dateCours = htmlspecialchars(strip_tags($this->dateCours));
  $this->etat = htmlspecialchars(strip_tags($this->etat));

  // Bind data
  $stmt->bindParam(':mailEleve', $this->mailEleve);
  $stmt->bindParam(':mailProf', $this->mailProf);
  $stmt->bindParam(':idMat', $this->idMat);
  $stmt->bindParam(':idNiveau', $this->idNiveau);
  $stmt->bindParam(':dateCours', $this->dateCours);
  $stmt->bindParam(':etat', $this->etat);

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
    $query = 'DELETE FROM ' . $this->table . ' WHERE mailEleve = :mailEleve AND mailProf = :mailProf AND idMat = :idMat AND idNiveau = :idNiveau AND dateCours = :dateCours';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->mailEleve = htmlspecialchars(strip_tags($this->mailEleve));
    $this->mailProf = htmlspecialchars(strip_tags($this->mailProf));
    $this->idMat = htmlspecialchars(strip_tags($this->idMat));
    $this->idNiveau = htmlspecialchars(strip_tags($this->idNiveau));
    $this->dateCours = htmlspecialchars(strip_tags($this->dateCours));

    // Bind Data
    $stmt->bindParam(':mailEleve', $this->mailEleve);
    $stmt->bindParam(':mailProf', $this->mailProf);
    $stmt->bindParam(':idMat', $this->idMat);
    $stmt->bindParam(':idNiveau', $this->idNiveau);
    $stmt->bindParam(':dateCours', $this->dateCours);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
  }
}
