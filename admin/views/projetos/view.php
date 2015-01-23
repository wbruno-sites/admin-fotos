<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/header.tpl.html'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/menu.tpl.html'; ?>

<article id="content" class="content column-three-quarters overflow">

<h1>Projetos</h1>

<?php
  $view = new View();
  $model = new Project('project');
  $view->table_list($model->all());
?>

<a href="/admin/projetos/new" class="btn clear">Cadastrar novo</a>

</article><!-- #content -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/footer.tpl.html'; ?>
