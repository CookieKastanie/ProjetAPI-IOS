<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Eleve.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $eleve = new Eleve($db);

  // Get ID
  $eleve->mailEleve = isset($_GET['mailEleve']) ? $_GET['mailEleve'] : die();

  // Get eleve
  $eleve->read_single();

  // Create array
  $eleve_arr = array(
    'mailEleve' => $eleve->mailEleve,
    'nom' => $eleve->nom,
    'prenom' => $eleve->prenom,
    'adresse' => $eleve->adresse,
    'idNiv' => $eleve->idNiv,
    'niveau' => $eleve->niveau
  );

  // Make JSON
  print_r(json_encode($eleve_arr));
