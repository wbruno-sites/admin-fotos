<?php
  @session_destroy();
  include 'header.tpl.html';
?>
  <article id="content" class="content column-quarter cf">

    <form action="login/" method="post" id="form-login">
      <h1>Administrador</h1>
      <fieldset>
        <label for="user">
          <span>Usuário</span>
          <input type="text" name="user" id="user" required="required" class="column-full">
        </label>

        <label for="password">
          <span>Senha</span>
          <input type="password" name="password" id="password" required="required" class="column-full">
        </label>

        <input type="submit" name="send" value="Entrar" class="btn">
      </fieldset>
    </form>
  </article><!-- #content -->
<?php include 'footer.tpl.html'; ?>
