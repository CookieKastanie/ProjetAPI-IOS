<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Prof.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $prof = new Prof($db);

  // Get ID
  $prof->mailProf = isset($_GET['mailProf']) ? $_GET['mailProf'] : die();

  // Get post
  $prof->read_single();

  // Create array
  $prof_arr = array(
    'mailProf' => $prof->mailProf,
    'nom' => $prof->nom,
    'prenom' => $prof->prenom,
    'presentation' => $prof->presentation
  );

  // Make JSON
  print_r(json_encode($prof_arr));
