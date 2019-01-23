<?php
  class Eleve {
    // DB Stuff
    private $conn;
    private $table = 'ELEVE';

    // Properties
    public $mailEleve;
    public $nom;
    public $prenom;
    public $adresse;
    public $idNiv;
    public $niveau;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get categories
    public function read() {
      // Create query
      $query = 'SELECT
        e.mailEleve,
        e.nom,
        e.prenom,
        e.adresse,
        e.idNiv,
        n.libelle as niveau
      FROM
        ' . $this->table . ' e LEFT JOIN NIVEAUX n ON e.idNiv = n.idNiveau';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

  public function read_single(){
    // Create query
      $query = 'SELECT
        e.mailEleve,
        e.nom,
        e.prenom,
        e.adresse,
        e.idNiv,
        n.libelle as niveau
      FROM
        ' . $this->table . ' e LEFT JOIN NIVEAUX n
        ON e.idNiv = n.idNiveau
        WHERE e.mailEleve = ? LIMIT 0,1';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->mailEleve);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->mailEleve = $row['mailEleve'];
      $this->nom = $row['nom'];
      $this->prenom = $row['prenom'];
      $this->adresse = $row['adresse'];
      $this->idNiv = $row['idNiv'];
      $this->niveau = $row['niveau'];
  }

  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table . '
    SET
      mailEleve = :mailEleve,
      nom = :nom,
      prenom = :prenom,
      adresse = :adresse,
      idNiv = :idNiv
      ';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->mailEleve = htmlspecialchars(strip_tags($this->mailEleve));
  $this->nom = htmlspecialchars(strip_tags($this->nom));
  $this->prenom = htmlspecialchars(strip_tags($this->prenom));
  $this->adresse = htmlspecialchars(strip_tags($this->adresse));
  $this->idNiv = htmlspecialchars(strip_tags($this->idNiv));

  // Bind data
  $stmt-> bindParam(':mailEleve', $this->mailEleve);
  $stmt-> bindParam(':nom', $this->nom);
  $stmt-> bindParam(':prenom', $this->prenom);
  $stmt-> bindParam(':adresse', $this->adresse);
  $stmt-> bindParam(':idNiv', $this->idNiv);

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
      adresse = :adresse,
      idNiv = :idNiv
      WHERE
      mailEleve = :mailEleve';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->mailEleve = htmlspecialchars(strip_tags($this->mailEleve));
  $this->nom = htmlspecialchars(strip_tags($this->nom));
  $this->prenom = htmlspecialchars(strip_tags($this->prenom));
  $this->adresse = htmlspecialchars(strip_tags($this->adresse));
  $this->idNiv = htmlspecialchars(strip_tags($this->idNiv));

  // Bind data
  $stmt-> bindParam(':mailEleve', $this->mailEleve);
  $stmt-> bindParam(':nom', $this->nom);
  $stmt-> bindParam(':prenom', $this->prenom);
  $stmt-> bindParam(':adresse', $this->adresse);
  $stmt-> bindParam(':idNiv', $this->idNiv);

  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  /*public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE mailEleve = :mailEleve';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->mailEleve = htmlspecialchars(strip_tags($this->mailEleve));

    // Bind Data
    $stmt-> bindParam(':mailEleve', $this->mailEleve);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
  }*/
}
