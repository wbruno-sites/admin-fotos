<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/header.tpl.html'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/menu.tpl.html'; ?>

<article id="content" class="content column-three-quarters overflow">

<h1>Usuários</h1>

<a href="/admin/usuarios/new" class="btn fright">Cadastrar novo</a>

<?php
  $view = new View();
  $model = new User('user');
  $view->listar_registros($model->all());
?>


</article><!-- #content -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/footer.tpl.html'; ?>
