<?php
require $_SERVER['DOCUMENT_ROOT'].'/inc/init.inc.php';

if (isPost()) {
  $id = getPost('id');
  $model = getPost('model');


  if ($model === 'projetos') {
    $controller = new ProjectController(new ProjectVO(), new Project());
    echo $controller->del().PHP_EOL;

    $photo = new Photo();

    echo $photo->delTree("uploads/image/{$id}/").PHP_EOL;
    echo $photo->delTree("uploads/carousel/{$id}/").PHP_EOL;
    echo $photo->delTree("uploads/blueprint/{$id}/").PHP_EOL;
  }

  if ($model === 'paginas') {
    $controller = new PageController(new PageVO(), new Page());
    echo $controller->del().PHP_EOL;

    $photo = new Photo();
    echo $photo->delTree("uploads/header/{$id}/").PHP_EOL;
  }
}
