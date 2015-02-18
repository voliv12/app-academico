<?php
Class Dependencia extends CI_controller{

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries */
        $this->load->database();
        $this->load->helper('form','url');
        $this->load->library('form_validation');
        /* ------------------ */
        $this->load->library('grocery_CRUD');
        $this->noPersonal = $this->session->userdata('noPersonal');
    }

    function index()
    {
        if (($this->session->userdata('logged_in') == TRUE) AND ($this->session->userdata('informe') == "Si") )
        {
            $datos['art_nac'] = 0;
            $datos['art_int'] = 0;
            $datos['lib_nac'] = 0;
            $datos['lib_int'] = 0;
            $datos['cap_nac'] = 0;
            $datos['cap_int'] = 0;
            $datos['p_invest'] = 0;
            $action['action'] = "informe/dependencia/reporte_general";
            $datos['form_fechas'] = $this->load->view('informe/form_fechas',$action,TRUE);
            $datos_plantilla['titulo'] = "Informe";
            $datos_plantilla['contenido'] = $this->load->view('informe/publicaciones_view',$datos,TRUE);
            $this->load->view('informe_view', $datos_plantilla);
        }
    }

    function reporte_general()
    {
        $fecha_de = $this->input->post('fecha_de');
        $fecha_hasta = $this->input->post('fecha_hasta');

        $this->load->model('publicaciones_model');
        $this->load->model('usuarios_model');
        $art_nac = $this->publicaciones_model->contar_publicaciones('articulo',$fecha_de, $fecha_hasta, "Nacional");
        $art_int = $this->publicaciones_model->contar_publicaciones('articulo',$fecha_de, $fecha_hasta, "Internacional");
        $lib_nac = $this->publicaciones_model->contar_publicaciones('libro',$fecha_de, $fecha_hasta, "Nacional");
        $lib_int = $this->publicaciones_model->contar_publicaciones('libro',$fecha_de, $fecha_hasta, "Internacional");
        $cap_nac = $this->publicaciones_model->contar_publicaciones('capitulo',$fecha_de, $fecha_hasta, "Nacional");
        $cap_int = $this->publicaciones_model->contar_publicaciones('capitulo',$fecha_de, $fecha_hasta, "Internacional");
        $inv_tc = $this->usuarios_model->contar_investigadores_tc();
        $inv_mt = $this->usuarios_model->contar_investigadores_mt();

        $invest = $inv_tc + $inv_mt; //Total de Investigadores
        $total = $art_nac + $art_int + $lib_nac + $lib_int + $cap_nac + $cap_int; //Total de publicaciones
        $p_art_nac = 0;
        $p_art_int = 0;
        $p_lib_nac = 0;
        $p_lib_int = 0;
        $p_cap_nac = 0;
        $p_cap_int = 0;

        if($art_nac != 0){
            $p_art_nac = $art_nac * 100 / $total;//Saco los porcentajes
        }
        if($art_int != 0){
             $p_art_int = $art_int * 100 / $total;
        }
        if($lib_nac != 0){
             $p_lib_nac = $lib_nac * 100 / $total;
        }
        if($lib_int != 0){
            $p_lib_int = $lib_int * 100 / $total;
        }
        if($cap_nac != 0){
            $p_cap_nac = $cap_nac * 100 / $total;
        }
        if($cap_int != 0){
            $p_cap_int = $cap_int * 100 / $total;
        }

        $lista['p_art_nac'] = round($p_art_nac,2);
        $lista['p_art_int'] = round($p_art_int,2);
        $lista['p_lib_nac'] = round($p_lib_nac,2);
        $lista['p_lib_int'] = round($p_lib_int,2);
        $lista['p_cap_nac'] = round($p_cap_nac,2);
        $lista['p_cap_int'] = round($p_cap_int,2);
        $lista['desde'] = implode("/", array_reverse( preg_split("/\D/", $fecha_de) ) );
        $lista['hasta'] = implode("/", array_reverse( preg_split("/\D/", $fecha_hasta) ) );
        $lista['art_nac'] = $art_nac;
        $lista['art_int'] = $art_int;
        $lista['lib_nac'] = $lib_nac;
        $lista['lib_int'] = $lib_int;
        $lista['cap_nac'] = $cap_nac;
        $lista['cap_int'] = $cap_int;
        $lista['p_invest'] = round($total / $invest,2); //Divido el total de publicaciones por el total de Investigadores

        $action['action'] = "informe/dependencia/reporte_general";
        $lista['form_fechas'] = $this->load->view('informe/form_fechas',$action,TRUE);
        $datos_plantilla['titulo'] = "Total de publicaciones";
        $datos_plantilla['contenido'] = $this->load->view('informe/publicaciones_view',$lista,TRUE);
        $this->load->view('informe_view', $datos_plantilla);

    }
}

 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */