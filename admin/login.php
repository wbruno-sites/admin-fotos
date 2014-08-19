<?php
include '../inc/init.inc.php';

require 'models/Login.php';

$login = new Login(getPost('user'), getPost('password'));

if ($login->checkLogin()) {
  header('Location: /admin/home.html');
} else {
  header('Location: /admin/index.html');
}
