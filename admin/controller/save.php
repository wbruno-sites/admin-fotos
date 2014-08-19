<?php
require $_SERVER['DOCUMENT_ROOT'].'/inc/init.inc.php';

$model = getGet('model');

if ($model === 'projetos') {
  $controller = new ProjectController(new ProjectVO(), new Project());
  $controller->save();

  include 'upload.php';
}
