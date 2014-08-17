<?php

if( $_SERVER['REQUEST_METHOD']=='POST' ) {
  $to             = 'contato@studioag.arq.br'; //para quem vai o email
  $to             = 'rocha_bruno@hotmail.com'; //para quem vai o email
  $subject        = 'Site - ' . $_POST['subject'];

  /* Mensagem */
  $message =
  '<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
  <style>
  </style>'.
  '<img src="http://studioag.tempsite.ws/images/logo.png" alt="" />'.
  'Olá, <b>'.$_POST['name'].'</b><br><br>'.
  'Mandou a seguinte mensagem pela seção "Contato" do site: <br>'.
  nl2br($_POST['message']).
  '<br><br>E deixou o seguinte telefone para contato:<b>'.$_POST['phone'].'</b>'.
  '<br>e email:<b>'.$_POST['email'].'</b>';

  $message .= '';

  $headers = "MIME-Version: 1.1".PHP_EOL;
  $headers .= "Content-type: text/html; charset=iso-8859-1".PHP_EOL;
  $headers .= "From: contato@studioag.arq.br".PHP_EOL; // remetente
  $headers .= "Return-Path: contato@studioag.arq.br".PHP_EOL; // return-path

  //$headers .= "Bcc: outroemail@provedor.com".PHP_EOL; //altere ou comente essa linha, para receber uma cópia oculta

  mail($to, $subject, $message, $headers);
  header("Location: /contato?send=ok");

}
