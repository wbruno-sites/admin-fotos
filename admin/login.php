<?php
include '../inc/init.inc.php';

if( isPost() )
{
  $login = getPost( 'user' );
  $senha = getPost( 'password' );


  if( !empty($login) && !empty($senha) ){
    $user = new User();

    if( $user->login( $login, $senha ) )
      header('Location: /admin/home');
    else
      header('Location:  /admin/index?error=2');
  }
  else {
    //session_destroy();
    header('Location:  /admin/index?error=1');
  }
}
else {
  //session_destroy();
  header('Location:  /admin/index?error=0');//tentar acessar essa página diretamente
}
