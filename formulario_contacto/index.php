<?php require 'contralador/index.php';?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <title>Formulario de Contacto</title>
</head>
<body>
  <div class="wrap">
    <form class="formulario" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <input type="text" name="nombre" value="<?php if(!$enviado && isset($nombre)) echo $nombre; ?>" placeholder="Nombre">
      <input type="email" name="email" value="<?php if(!$enviado && isset($emal)) echo $emal; ?>" placeholder="Email">
      <textarea name="mensaje" placeholder="Mensaje:"><?php if(!$enviado && isset($mensaje)) echo $mensaje ?></textarea>
      <?php if(!empty($error)): ?>
      <div class="alert error" role="alert">
        <?php echo $error;?>
      </div>
    <?php elseif ($enviado): ?>
      <div class="alert succes" role="alert">
          	<?php echo 'Enviado Correctamente'; ?>
      </div>
    <?php endif; ?>
      <input type="submit" name="enviar" class="btn btn-primary" value="Enviar Correo">
    </form>

  </div>
</body>
</html>
