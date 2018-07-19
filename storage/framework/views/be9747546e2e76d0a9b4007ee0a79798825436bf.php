<!DOCTYPE html>
  <html>
    <head>   
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="<?php echo e(asset('Back/Mate/css/materialize.min.css')); ?>"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="<?php echo e(asset('Back/Mate/css/menu.css')); ?>"/>
     
      <script type="text/javascript" src="<?php echo e(asset('Back/Mate/js/jquery.js')); ?>"></script>
      <!--Let browser know website is optimized for mobile-->
     
    </head>

<body>
  <nav>
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo center">Cafeteria</a>
      <a href="#" data-activates="mobile-demo" class="button-collapse left">
        <i class="material-icons">menu</i>
      </a>
      <ul class="side-nav fixed" id="mobile-demo">
        <li>
          <div class="user-view">
            <div class="background">
              <img src="<?php echo e(asset('Back/img/fondo3.jpg')); ?>" class="responsive-img">
            </div>
            <a href="#!user"><img class="circle" src="<?php echo e(asset('Back/img/yoel.jpg')); ?>" class="responsive-img"></a>
            <a href="#!name"><span class="white-text name">Administrador</span></a>
            <a href="#!email"><span class="white-text email">Yoel Armando Aguilar Gomez</span></a>
         </div>
        </li>
        <li><a href="#!"><i class="material-icons right">exit_to_app</i>Cerrar sesion</a></li>
        <li><div class="divider"></div></li>
        <li><a class="subheader">Menu</a></li>
        <li><a class="waves-effect waves-teal" href="/Back/Mesas">Mesas <i class="material-icons right">chevron_right</i></a></li>
        <li><a class="waves-effect waves-teal" href="/Back/Categorias">Categorias<i class="material-icons right">chevron_right</i>
         <li><a class="waves-effect waves-teal" href="/Back/Productos">Productos<i class="material-icons right">chevron_right</i></a></li>   

        <li class="no-padding">
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header">Estadisticas<i class="material-icons">expand_more</i></a>
            <div class="collapsible-body">
              <ul>
                <li><a href="#!">First</a></li>
                <li><a href="#!">Second</a></li>
                <li><a href="#!">Third</a></li>
                <li><a href="#!">Fourth</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </li>
      </ul>
    </div>
  </nav> 
  
  <?php echo $__env->yieldContent('contenido'); ?>
 

<script type="text/javascript" src="<?php echo e(asset('Back/Mate/js/menu.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('Back/Mate/js/materialize.min.js')); ?>"></script>
</body>
