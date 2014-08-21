<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/header.tpl.html'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/menu.tpl.html'; ?>

<article id="content" class="content column-three-quarters overflow">

<h1>Páginas</h1>

<!--
<a href="/admin/paginas/new" class="btn fright">Cadastrar nova</a>
-->

<?php
  $view = new View();
  $model = new Page('page');
  $view->table_list($model->all());
?>


</article><!-- #content -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/footer.tpl.html'; ?>
