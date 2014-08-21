<?php

$id_project = getPost('id');

if( $id_project ) {

  if (isset($_FILES["image"])) {
    $dir = $_SERVER['DOCUMENT_ROOT']."/uploads/image/{$id_project}/";
    @mkdir($dir);
    move_uploaded_file( $_FILES["image"]["tmp_name"], $dir . $_FILES["image"]["name"]);
  }

  if (isset($_FILES["carousel"])) {
    $dir = $_SERVER['DOCUMENT_ROOT']."/uploads/carousel/{$id_project}/";
    upload($_FILES["carousel"], $dir);
  }

  if (isset($_FILES["blueprint"])) {
    $dir = $_SERVER['DOCUMENT_ROOT']."/uploads/blueprint/{$id_project}/";
    upload($_FILES["blueprint"], $dir);
  }

  if (isset($_FILES["header"])) {
    $dir = $_SERVER['DOCUMENT_ROOT']."/uploads/header/{$id_project}/";
    @mkdir($dir);
    move_uploaded_file( $_FILES["header"]["tmp_name"], $dir . $_FILES["header"]["name"]);
  }
}

header('Location:/admin/'.$model.'/view');

function upload($files, $dir) {
  @mkdir($dir);

  foreach ($files["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
      $tmp_name = $files["tmp_name"][$key];
      $name = $files["name"][$key];
      move_uploaded_file( $tmp_name, $dir . $name);
    }
  }
}
