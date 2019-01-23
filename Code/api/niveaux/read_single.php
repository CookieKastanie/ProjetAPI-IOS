<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Niveaux.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $niveau = new Niveaux($db);

  // Get ID
  $niveau->idNiveau = isset($_GET['idNiveau']) ? $_GET['idNiveau'] : die();

  $niveau->read_single();

  // Create array
  $niveau_arr = array(
    'idNiveau' => $niveau->idNiveau,
    'libelle' => $niveau->libelle
  );

  // Make JSON
  print_r(json_encode($niveau_arr));
