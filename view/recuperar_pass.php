<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="../css/style_recupPass.css">
  </head>
  <body>
    <div class="center">
      <h1>Recuperar Contraseña</h1>
        <form method="post">
          <div class="txt_field">
            <input type="text" required>
            <span></span>
            <label>Correo electrónico</label>
          </div>
          <p>Se le enviará un correo electrónico con la confirmación para reestablecer la nueva contraseña</p>
        </form>
        <div class="wdt-33">
        <form method="post" action="index.php?c=usuario">
          <input type="submit" value="Enviar"></input>
            <form method="post" action="index.php?c=usuario">
            <input type="submit" value="Cancelar"></input>
          </form>
        </div>
        <p></p>
    </div>
  </body>
</html>
