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
        <script type="text/javascript" src="js/DataTables-1.8.1/media/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="js/DataTables-1.8.1/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="js/DataTables-1.8.1/media/js/jquery.dataTables.editable.js"></script>
        <script type="text/javascript" src="js/jquery.jeditable.js"></script>
        <script type="text/javascript" src="js/jquery.validate.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
        <script type="text/javascript" src="../recursos/Highcharts-3.0.6/js/highcharts.js" ></script>
        <script type="text/javascript" src="../recursos/Highcharts-3.0.6/js/modules/exporting.js"></script>
        <script type="text/javascript" src="../recursos/Highcharts-3.0.6/js/modules/exporting.src.js"></script>

        <link rel="stylesheet" href="js/DataTables-1.8.1/media/css/demo_table.css" type="text/css">
        <link rel="stylesheet" href="js/DataTables-1.8.1/media/css/demo_table_jui.css" type="text/css">
        <link rel="stylesheet" href="js/DataTables-1.8.1/media/css/demo_page.css" type="text/css">
        <link rel="stylesheet" href="js/themes/smoothness/jquery-ui-1.8.16.custom.css" type="text/css">
        <link rel="stylesheet" href="js/themes/base/jquery.ui.base.css" type="text/css">

        <script type="text/javascript" src="js/vanadium.js"></script>

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
          <a class="brand" >Sistema de Información Académica: <b>Reportes</b></a>
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
              <li><a href="salir">Cerrar sesión</a></li>
            </ul>
          </div>
          <div class="nav-collapse">
            <ul class="nav">
              <!--li class="active"><a href="academico/control">Inicio</a></li-->
              <li><a href="academico/control">Producción</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

     <!--#######################Modal Créditos################################-->
     <div id="creditos" class="modal hide fade in" style="display: none;">
        <div class="modal-header">
            <a data-dismiss="modal" class="close">×</a>
            <h3>Créditos</h3>
         </div>
         <div class="modal-body"  style="text-align: center">
             <p>
                <h4><b>Sistema de Información Académica</b></h4>
                <h4><b>Instituto de Ciencias de la Salud</b></h4>
                <b>Dra. Patricia Pavón León</b><br>
                Directora del Instituto<br><br>
                <b>Mtro. Víctor Olivares García</b><br>
                Técnico Académico. Desarrollador del Sistema.<br><br>
                <b>Dr. Enrique Juárez Aguilar</b><br>
                Investigador. Asesor en el manejo de la información en el sistema.<br><br>
                <b>Marcos Rodríguez de la Rosa</b><br>
                Becario. Colaborador en el desarrollo del sistema.<br><br>
             </p>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

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
                <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">Personal académico <span class="caret"></span></button>
                <ul class="dropdown-menu" align="left">
                    <li><a href="informe/personal_academico/tipo">Tipo</a></li>
                    <li><a href="informe/personal_academico/grado">Grado</a></li>
                </ul>
              </div>
              <div class="btn-group">
                <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">Divulgación <span class="caret"></span></button>
                <ul class="dropdown-menu" align="left">
                    <li class="dropdown-submenu">
                       <a tabindex="-1" href="informe/publicaciones">Publicaciones</a>
                        <ul class="dropdown-menu" align="left">
                            <li><a href="informe/dependencia">Por dependencia </a></li>
                            <li><a href="informe/departamento/publicaciones">Por departamento </a></li>
                            <li><a href="informe/tipo_publicacion/tipo">Por tipo publicación </a></li>
                            <li><a href="informe/tipo_publicacion/tipo">Por Cuerpo Académico </a></li>
                            <li><a href="informe/tipo_participacion/tipo">Por tipo de participación </a></li>
                            <li><a href="informe/listar_publicaciones/articulos">Listar Artículos </a></li>
                            <li><a href="informe/listar_publicaciones/articulos_departamento">Listar Artículos Departamento </a></li>
                        </ul>
                   </li>
                    <li><a href="informe/ponencias/listar_ponencias">Ponencias</a></li>
                </ul>
              </div>
              <div class="btn-group">
                <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">Docencia <span class="caret"></span></button>
                <ul class="dropdown-menu" align="left">
                    <li><a href="informe/docencia/catedra"><i class="icon-hand-up"></i> Cátedra </a></li>
                    <li><a href="informe/docencia/tesis"><i class="icon-screenshot"></i> Dirección de tesis </a></li>
                    <li><a href="informe/docencia/tutorias_sit"><i class="icon-check"></i> Tutorías </a></li>
                    <li><a href="informe/docencia/servicio"><i class="icon-check"></i> Servicio Social </a></li>
                </ul>
              </div>
              <div class="btn-group">
                <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">Investigación <span class="caret"></span></button>
                <ul class="dropdown-menu" align="left">
                   <li><a href="informe/investigacion/proyectos"><i class="icon-briefcase"></i> Proyectos</a></li>
                   <li><a href="informe/investigacion/cuerpos"><i class="icon-thumbs-up"></i> Cuerpos Académicos</a></li>
                   <li><a href="informe/investigacion/financiamiento"><i class="icon-tag"></i> Financiamiento</a></li>
                   <li><a href="informe/investigacion/donaciones"><i class="icon-inbox"></i> Donaciones</a></li>
                </ul>
              </div>
              <div class="btn-group">
                <button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown">Institucional <span class="caret"></span></button>
                <ul class="dropdown-menu" align="left">
                   <li><a href="informe/Institucional/alianzas"><i class="icon-random"></i> Vínculación</a></li>
                   <li><a href="informe/Institucional/reconocimientos"><i class="icon-certificate"></i> Reconocimientos</a></li>
                   <li><a href="informe/Institucional/eventos"><i class="icon-calendar"></i> Eventos académicos organizados</a></li>
                 </ul>
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
        <p>Sistema de información Académica | ICS-2015 | <a data-toggle="modal" href="#creditos">Créditos</a> </p>
      </div>
  </body>
</html>
