<?php

class Db extends mysqli {
  protected static $instance;

  private function __construct() {
    @parent::__construct($DB['host'],
                         $DB['user'],
                         $DB['pass'],
                         $DB['db'],
                         3306,
                         false
    );
  }

  public static function getInstance() {
      if( !self::$instance ) {
          self::$instance = new self();
      }
      echo '<pre>';
      var_dump(self::$instance);
      return self::$instance;
  }
}
