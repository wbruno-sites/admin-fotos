<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/header.tpl.html'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/menu.tpl.html'; ?>

<article id="content" class="content column-three-quarters overflow">

<?php if (getGet('id')) { ?>
  <h1 class="column-full">Editar Projeto</h1>
<?php } else { ?>
  <h1 class="column-full">Cadastrar novo Projeto</h1>
<?php }?>


<?php
  $vo = new ProjectVO();
  $controller = new ProjectController($vo, new Project());
  $controller->byId(getGet('id'));
?>

  <form action="/admin/projetos/save" method="post" enctype="multipart/form-data" class="column-three-quarters">
    <fieldset>
      <input type="hidden" name="id" value="<?php echo $vo->get_id(); ?>" id="id" />
      <label>
        <span>Nome</span>
        <input type="text" name="name" value="<?php echo $vo->get_name(); ?>" class="column-full" required="required" />
      </label>

      <label>
        <span>Descrição</span>
        <textarea name="description" rows="4" cols="40" class="column-full"><?php echo $vo->get_description(); ?></textarea>
      </label>

<?php if ($vo->get_id()) { ?>
      <label>
        <span>Imagens principal <small> - 220x220</small></span>
        <input type="file" name="image" id="image" />
        <p class="response">
<?php
  $photo = new Photo();
  $photo->base = '../../';
  $file = $photo->image(getGet('id'));
  echo $file;
?>
        </p>
      </label>

      <label>
        <span>Imagens para o carousel <small> - 638x400</small></span>
        <input type="file" name="carousel[]" id="carousel" multiple="multiple" />
        <p class="response">
<?php
  $files = $photo->carousel(getGet('id'));

  foreach($files AS $file) {
    echo $file.'<br>';
  }
?>
        </p>
      </label>

      <label>
        <span>Plantas/Desenhos <small> - max 667x...</small></span>
        <input type="file" name="blueprint[]" id="blueprint" multiple="multiple" />
        <p class="response">
<?php
  $files = $photo->blueprint(getGet('id'));

  foreach($files AS $file) {
    echo $file.'<br>';
  }
?>
        </p>
      </label>
<?php } else { ?>
      <p>Após salvar, entre novamente para cadastrar as imagens</p>
<?php }?>

      <input type="submit" class="btn fright" value="Salvar" />
    </fieldset>
  </form>

<script src="/admin/javascript/xhr.js"></script>
<script src="/admin/javascript/all.js"></script>
</article><!-- #content -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/footer.tpl.html'; ?>
