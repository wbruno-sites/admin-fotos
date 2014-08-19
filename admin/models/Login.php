<?php
require_once 'Db.php';

class Login {

  private $db;

  public function __construct ($user, $pass) {
    $this->db = Db::getInstance();

    $this->user = $user;
    $this->pass = $pass;
  }
  public function checkLogin() {
    $sql = $this->db->query('SELECT * FROM user');

    echo $sql, 'aee'; exit;
    return false;
  }
}
