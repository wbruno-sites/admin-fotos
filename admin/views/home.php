<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/header.tpl.html'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/menu.tpl.html'; ?>

<article id="content" class="content column-three-quarters overflow">

<h1>Área <span>Administrativa</span></h1>
<?php
  if( !isset($_GET['erro']) )
    echo 'Bem Vindo!';
  else if( getGet('erro')==0 )
    echo 'Sucesso!';
?>

</article><!-- #content -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/footer.tpl.html'; ?>
