<?php
require $_SERVER['DOCUMENT_ROOT'].'/inc/init.inc.php';

$model = getGet('model');

if ($model === 'projetos') {
  $action = new ProjectAction(new ProjectVO(), new DAO('project'));
  $action->save();
}
