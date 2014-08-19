<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/header.tpl.html'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/menu.tpl.html'; ?>

<article id="content" class="content column-three-quarters overflow">

  <h1 class="column-full">Cadastrar novo Projeto</h1>

  <form action="/admin/projetos/save" method="post" class="column-three-quarters">
    <fieldset>
      <input type="hidden" name="id" value=""/>
      <label>
        <span>Nome</span>
        <input type="text" name="name" value="" class="column-full" required="required" />
      </label>

      <label>
        <span>Descrição</span>
        <textarea name="description" rows="4" cols="40" class="column-full"></textarea>
      </label>

      <input type="submit" class="btn fright" value="Cadastrar novo" />
    </fieldset>
  </form>

</article><!-- #content -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/footer.tpl.html'; ?>
