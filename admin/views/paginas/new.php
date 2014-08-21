<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/header.tpl.html'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/menu.tpl.html'; ?>

<article id="content" class="content column-three-quarters overflow">

<?php if (getGet('id')) { ?>
  <h1 class="column-full">Editar Página</h1>
<?php } else { ?>
  <h1 class="column-full">Cadastrar nova Página</h1>
<?php }?>


<?php
  $vo = new PageVO();
  $controller = new PageController($vo, new Page());
  $controller->byId(getGet('id'));
?>

  <form action="/admin/paginas/save" method="post" enctype="multipart/form-data" class="column-three-quarters">
    <fieldset>
      <input type="hidden" name="id" value="<?php echo $vo->get_id(); ?>" id="id" />
      <label>
        <span>Título</span>
        <input type="text" name="title" value="<?php echo $vo->get_title(); ?>" class="column-full" required="required" />
      </label>

      <label>
        <span>Conteúdo</span>
        <textarea name="text" rows="10" cols="40" class="column-full"><?php echo $vo->get_text(); ?></textarea>
      </label>

<?php if ($vo->get_id()) { ?>
      <label>
        <span>Imagem principal <small> - 1000x400</small></span>
        <input type="file" name="header" id="img-header" />
        <?php
          $photo = new Photo();
          $file = $photo->header(getGet('id'));
        ?>
      </label>
      <?php if(is_file($file)){?>
            <ul class="images-list">
              <li data-img="<?php echo $file; ?>"><?php echo basename($file); ?> - <img src="/admin/images/action4.gif" /></li>
            </ul>
      <?php } ?>

<?php } else { ?>
      <p>Após salvar, entre novamente para cadastrar as imagens</p>
<?php } ?>

      <input type="submit" class="btn fright" value="Salvar" />
    </fieldset>
  </form>

</article><!-- #content -->
<?php include $_SERVER['DOCUMENT_ROOT'].'/admin/views/footer.tpl.html'; ?>
