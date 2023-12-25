<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet"  href="../css/style_iniciar_sesion2.css">
  </head>
  <body>

    <div class="login-box">
      <img src="../img/cambio-climatico.png" class="avatar" alt="Avatar Image">
      <h1>Ingresa tus credenciales</h1>

      <?php if(!empty($mensage)):  ?>
        <p><?=$mensage?></p>
      <?php endif;?>
      
      <form action=../public/index.php?c=usuario&a=validarCredenciales method="post">
        <!-- USERNAME INPUT -->
        <label for="username">Correo Electrónico</label>
        <input type="text" name="username" placeholder="Ingresa tu correo electrónico">
        <!-- PASSWORD INPUT -->
        <label for="password">Contraseña</label>
        <input type="password" name="pass" placeholder="Ingresa tu contraseña">
        
        <input type="submit" value="Ingresar"></input>
        <input type="submit" value="Cancelar"></input>

        <div class="pass">
          <a href="index.php?c=usuario&a=mostrarFormRecuperar">¿Olvidaste la contraseña?</a>
        </div>
        <div class="singup_link">
          <a href="index.php?c=usuario&a=mostrarFormRegistro">Crear cuenta</a>
        </div>
      </form>
    </div>
  </body>
</html>