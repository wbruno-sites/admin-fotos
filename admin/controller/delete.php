<?php
require $_SERVER['DOCUMENT_ROOT'].'/inc/init.inc.php';

if (isPost()) {

  $id = getPost('id');

  $controller = new ProjectController(new ProjectVO(), new Project());
  echo $controller->del().PHP_EOL;

  $photo = new Photo();
  $photo->base = '../../';

  echo $photo->delTree("uploads/image/{$id}/").PHP_EOL;
  echo $photo->delTree("uploads/carousel/{$id}/").PHP_EOL;
  echo $photo->delTree("uploads/blueprint/{$id}/").PHP_EOL;
}
