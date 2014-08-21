<?php

include $_SERVER['DOCUMENT_ROOT'].'/inc/init.inc.php';

$image = getPost('image');

error_log($image);
echo @unlink($image);
