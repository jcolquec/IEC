
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style_crearCliente.css">
    <title>Crear Persona Responsable</title>
  </head>
  <body>
  
    <div class="center">
      
        <div class="txt_field">
            <h1>Ingrese sus datos</h1>
            <br>
            <div class="alert"> <?php echo isset($alert)? $alert: ''; ?>  </div>
            <form method="POST" action="../public/index.php?c=usuario&a=registrarUsuario">
                <div class="txt_field">
                    <input type="text" name="nombre" required>
                    <span></span>
                    <label>Nombre</label>
                </div>
                <div class="txt_field">
                    <input type="email" name="correo" required>
                    <span></span>
                    <label>Correo electrónico</label>
                </div>
                <div class="txt_field">
                    <input type="text" name="rut" required>
                    <span></span>
                    <label>RUT (12345678-0)</label>
                </div>
                <div class="txt_field">
                    <input type="text" name="rol" required>
                    <span></span>
                    <label>Rol</label>
                </div>
                <div class="txt_field">
                    <input type="text" name="direccion" required>
                    <span></span>
                    <label>Dirección</label>
                </div>
                <div class="txt_field">
                    <input type="password" name="clave" required>
                    <span></span>
                    <label>Contraseña</label>
                </div>
                <div class="wdt-33">
                    <input type="submit" value="Registrar">
                </div>
            </form>
        
            <div class="wdt-33">
                <form method="post" action="login.php">
                    <input type="submit" value="Cancelar">
                </form>
            </div>
        </div>
    </div>
  </body>
</html>
