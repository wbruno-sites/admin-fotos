<?php
require $_SERVER['DOCUMENT_ROOT'].'/inc/init.inc.php';

$model = getGet('model');

if ($model === 'projetos') {
  $controller = new ProjectController(new ProjectVO(), new Project());
  $controller->save();

  include 'upload.php';
}

if ($model === 'paginas') {
  $controller = new PageController(new PageVO(), new Page());
  $controller->save();

  include 'upload.php';
}
