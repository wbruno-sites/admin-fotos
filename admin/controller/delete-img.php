<?php

include $_SERVER['DOCUMENT_ROOT'].'/inc/init.inc.php';

$image = getPost('image');

echo @unlink($_SERVER['DOCUMENT_ROOT'] . $image);
