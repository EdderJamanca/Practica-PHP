<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
</head>
<body>
  <div class="contenedor">
    <h3>Articulo</h3>
    <section class="articulo">
            <ul>
                <?php foreach ($articulo as $key): ?>
                  <li><?php echo $key['id'].'.-'.$key['articulo'] ?></li>
                <?php endforeach ?>
            </ul>
    </section>
    <section class="paginacion">
          <ul>
            <?php if($pagina==1): ?>
            <li class="disabled">&laquo</li>
          <?php else :?>
            <li><a href="?pagina=<?php  echo $pagina - 1 ?>">&laquo</a></li>
          <?php endif; ?>
          <?php
                for ($i=1; $i <=$numeroPagina ; $i++) {
                  if($pagina == $i){
                    echo "<li class='active'><a href='?pagina=$i'>$i</a></li>";
                  }else {
                    echo "<li><a href='?pagina=$i'>$i</a></li>";
                  }
                }
           ?>
           <?php if($pagina==$numeroPagina): ?>
           <li class="disabled">&laquo</li>
         <?php else :?>
           <li><a href="?pagina=<?php echo $pagina + 1 ?>">&raquo</a></li>
         <?php endif; ?>
          </ul>
    </section>
  </div>
</body>
</html>
