<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $titulo; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href= "<?php echo $this->config->item('base_url'); ?>">

    <script type='text/javascript' src='js/jquery-1.8.2.js'></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">


    <script src="js/jquery.js" type="text/javascript"></script>
        <script src="js/jquery.ui.draggable.js" type="text/javascript"></script>
        <script type="text/javascript" src="js/DataTables-1.8.1/media/js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.jeditable.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
        <script type="text/javascript" src="js/highcharts.js"></script>
        <script type="text/javascript" src="js/exporting.js"></script>
        <script type="text/javascript" src="js/exporting.src.js"></script>

        <link rel="stylesheet" href="js/themes/smoothness/jquery-ui-1.8.16.custom.css" type="text/css">
        <link rel="stylesheet" href="js/themes/base/jquery.ui.base.css" type="text/css">

        <link href="/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">

</head>

 <body>

      <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand">Sistema de Información Academica: <b>Producción</b></a>
          <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i> <?php
                                            //$this->load->helper('text');
                                            //$count = count(explode(" ", $this->session->userdata('nombre')));
                                            //echo word_limiter($this->session->userdata('nombre'), $count - 1, " ");
                                            echo $this->session->userdata('nombre');
                                        ?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">

              <li class="disabled"><a><?php echo $this->session->userdata('perfil'); ?></a></li>
              <li class="divider"></li>
               <!-- Button trigger modal -->
              <li><a data-toggle="modal" href="#myModal"><i class="icon-refresh"></i> Cambiar contraseña</a></li>
              <li><a href="salir"><i class="icon-off"></i> Cerrar sesión</a></li>
            </ul>
          </div>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="academico/control"><i class="icon-home"></i> Inicio</a></li>
              <?php if ($this->session->userdata('informe') == "Si") { ?>
              <li><a href="informe/personal_academico"><i class="icon-list-alt"></i> Reportes</a></li>
              <?php } ?>
              <?php if ($this->session->userdata('administrar_usuarios') == "Si") { ?>
              <li><a href="usuarios/academico"><i class="icon-plus-sign"></i> Administrar usuarios</a></li>
              <?php } ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
  <!--#######################Modal para cambiar contraseña################################-->
     <div id="myModal" class="modal hide fade in" style="display: none;">
        <div class="modal-header">
            <a data-dismiss="modal" class="close">×</a>
            <h3>Cambio de contraseña</h3>
         </div>
         <div class="modal-body">
             <form action="cambiar_password" method="POST">
                 <!--label for="exampleInputEmail1">Nueva contraseña</label-->
                 <input type="password" class="form-control" name="password" placeholder="Nueva contraseña"> </br>
                 <input type="password" class="form-control" name="passconf" placeholder="Confirme nueva contraseña"></br>
             <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Cambiar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
             </div>
            </form>
        </div>


    </div>
  <!--#######################################################-->
<div class="container">

      <div class="masthead">
          <h3 class="muted"> &nbsp; </h3>
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container" align="center">
               <div class="btn-group">
                <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown"><i class="icon-bullhorn icon-white"></i> Divulgación <span class="caret"></span></button>
                <ul class="dropdown-menu" align="left">
                    <li class="dropdown-submenu">
                       <a tabindex="-1" href="publicaciones/articulos/control"><i class="icon-pencil"></i> Publicaciones</a>
                        <ul class="dropdown-menu" align="left">
                            <li><a href="publicaciones/articulos/control"><i class="icon-list"></i> Artículos</a></li>
                            <li><a href="publicaciones/libros/control"><i class="icon-book"></i> Libros</a></li>
                            <li><a href="publicaciones/capitulos/control"><i class="icon-edit"></i> Capítulos de libro</a></li>
                        </ul>
                   </li>
                    <li><a href="publicaciones/ponencias/control"><i class="icon-asterisk"></i> Ponencias</a></li>
                </ul>
              </div>
              <div class="btn-group">
                <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i> Docencia <span class="caret"></span></button>
                <ul class="dropdown-menu" align="left">
                    <li><a href="docencia/catedra/control"><i class="icon-hand-up"></i> Cátedra </a></li>
                    <li><a href="docencia/tesis/control"><i class="icon-screenshot"></i> Dirección de tesis </a></li>
                    <li><a href="docencia/tutorias/control"><i class="icon-check"></i> Tutorías </a></li>
                </ul>
              </div>
              <div class="btn-group">
                <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown"><i class="icon-folder-open icon-white"></i> Investigación <span class="caret"></span></button>
                <ul class="dropdown-menu" align="left">
                   <li><a href="investigacion/proyectos/control"><i class="icon-briefcase"></i> Proyectos</a></li>
                   <li><a href="investigacion/financiamiento/control"><i class="icon-tags"></i> Financiamiento</a></li>
                   <li><a href="investigacion/cuerpos/control"><i class="icon-thumbs-up"></i> Cuerpos Académicos</a></li>
                </ul>
              </div>
              <div class="btn-group">
                <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown"><i class="icon-flag icon-white"></i> Institucional <span class="caret"></span></button>
                <ul class="dropdown-menu" align="left">
                   <li><a href="institucional/alianzas/control"><i class="icon-random"></i> Vínculación</a></li>
                   <li><a href="institucional/reconocimientos/control"><i class="icon-certificate"></i> Reconocimientos</a></li>
                   <li><a href="institucional/eventos/control"><i class="icon-calendar"></i> Eventos académicos organizados</a></li>
                </ul>
              </div>
              <div class="btn-group">
                 <button class="btn" >
                  <a href="curriculum"><img src="imagenes/word.png"> Descargar CV</a></button>
              </div>
            </div>
          </div>
        </div><!-- /.navbar -->
      </div>
     </div> <!-- /container -->

     <div class="container-fluid">
             <?php echo $contenido; ?>
     </div>
      <hr>

      <div class="footer">
        <p>&copy; Instituo de Ciencias de la Salud 2013</p>
      </div>
  </body>
</html>
