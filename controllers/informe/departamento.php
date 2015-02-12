<?php
Class Departamento extends CI_controller{

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
            $action['action'] = "informe/departamento/biomedicina";

            $datos['form_fechas'] = $this->load->view('informe/form_fechas',$action,TRUE);
            $datos_plantilla['titulo'] = "Informe";
            $datos_plantilla['contenido'] = $this->load->view('informe/departamento_view',$datos,TRUE);
            $this->load->view('informe_view', $datos_plantilla);
        }
    }

    function publicaciones()
    {
        $fecha_de = $this->input->post('fecha_de');
        $fecha_hasta = $this->input->post('fecha_hasta');

        $this->load->model('publicaciones_model');
        $this->load->model('usuarios_model');
        //*******BIOMEDICINA
        $art_nac = $this->publicaciones_model->articulos_departamento('Biomedicina',$fecha_de, $fecha_hasta, "Nacional");
        $art_int = $this->publicaciones_model->articulos_departamento('Biomedicina',$fecha_de, $fecha_hasta, "Internacional");
        $lib_nac = $this->publicaciones_model->libros_departamento('Biomedicina',$fecha_de, $fecha_hasta, "Nacional");
        $lib_int = $this->publicaciones_model->libros_departamento('Biomedicina',$fecha_de, $fecha_hasta, "Internacional");
        $cap_nac = $this->publicaciones_model->capitulos_departamento('Biomedicina',$fecha_de, $fecha_hasta, "Nacional");
        $cap_int = $this->publicaciones_model->capitulos_departamento('Biomedicina',$fecha_de, $fecha_hasta, "Internacional");
        //*******CLINICA
        $art_nac_cl = $this->publicaciones_model->articulos_departamento('CLINICA',$fecha_de, $fecha_hasta, "Nacional");
        $art_int_cl = $this->publicaciones_model->articulos_departamento('CLINICA',$fecha_de, $fecha_hasta, "Internacional");
        $lib_nac_cl = $this->publicaciones_model->libros_departamento('CLINICA',$fecha_de, $fecha_hasta, "Nacional");
        $lib_int_cl = $this->publicaciones_model->libros_departamento('CLINICA',$fecha_de, $fecha_hasta, "Internacional");
        $cap_nac_cl = $this->publicaciones_model->capitulos_departamento('CLINICA',$fecha_de, $fecha_hasta, "Nacional");
        $cap_int_cl = $this->publicaciones_model->capitulos_departamento('CLINICA',$fecha_de, $fecha_hasta, "Internacional");
        //*******SISTEMAS DE SALUD
        $art_nac_ss = $this->publicaciones_model->articulos_departamento('Sistemas de Salud',$fecha_de, $fecha_hasta, "Nacional");
        $art_int_ss = $this->publicaciones_model->articulos_departamento('Sistemas de Salud',$fecha_de, $fecha_hasta, "Internacional");
        $lib_nac_ss = $this->publicaciones_model->libros_departamento('Sistemas de Salud',$fecha_de, $fecha_hasta, "Nacional");
        $lib_int_ss = $this->publicaciones_model->libros_departamento('Sistemas de Salud',$fecha_de, $fecha_hasta, "Internacional");
        $cap_nac_ss = $this->publicaciones_model->capitulos_departamento('Sistemas de Salud',$fecha_de, $fecha_hasta, "Nacional");
        $cap_int_ss = $this->publicaciones_model->capitulos_departamento('Sistemas de Salud',$fecha_de, $fecha_hasta, "Internacional");
        //*******ADICCIONES
        $art_nac_ad = $this->publicaciones_model->articulos_departamento('Adicciones',$fecha_de, $fecha_hasta, "Nacional");
        $art_int_ad = $this->publicaciones_model->articulos_departamento('Adicciones',$fecha_de, $fecha_hasta, "Internacional");
        $lib_nac_ad = $this->publicaciones_model->libros_departamento('Adicciones',$fecha_de, $fecha_hasta, "Nacional");
        $lib_int_ad = $this->publicaciones_model->libros_departamento('Adicciones',$fecha_de, $fecha_hasta, "Internacional");
        $cap_nac_ad = $this->publicaciones_model->capitulos_departamento('Adicciones',$fecha_de, $fecha_hasta, "Nacional");
        $cap_int_ad = $this->publicaciones_model->capitulos_departamento('Adicciones',$fecha_de, $fecha_hasta, "Internacional");


        $invest = $this->usuarios_model->contar_por_depto('Biomedicina');
        $invest_cl = $this->usuarios_model->contar_por_depto('Clínica');
        $invest_ss = $this->usuarios_model->contar_por_depto('Sistemas de Salud');
        $invest_ad = $this->usuarios_model->contar_por_depto('Adicciones');

        $total = $art_nac + $art_int + $lib_nac + $lib_int + $cap_nac + $cap_int; //Total de publicaciones de biomedicina
        $p_art_nac = 0;
        $p_art_int = 0;
        $p_lib_nac = 0;
        $p_lib_int = 0;
        $p_cap_nac = 0;
        $p_cap_int = 0;

        $total_cl = $art_nac_cl + $art_int_cl + $lib_nac_cl + $lib_int_cl + $cap_nac_cl + $cap_int_cl; //Total de publicaciones Clínica
        $p_art_nac_cl = 0;
        $p_art_int_cl = 0;
        $p_lib_nac_cl = 0;
        $p_lib_int_cl = 0;
        $p_cap_nac_cl = 0;
        $p_cap_int_cl = 0;

        $total_ss = $art_nac_ss + $art_int_ss + $lib_nac_ss + $lib_int_ss + $cap_nac_ss + $cap_int_ss; //Total de publicaciones Sistemas de Salud
        $p_art_nac_ss = 0;
        $p_art_int_ss = 0;
        $p_lib_nac_ss = 0;
        $p_lib_int_ss = 0;
        $p_cap_nac_ss = 0;
        $p_cap_int_ss = 0;

        $total_ad = $art_nac_ad + $art_int_ad + $lib_nac_ad + $lib_int_ad + $cap_nac_ad + $cap_int_ad; //Total de publicaciones de Adicciones
        $p_art_nac_ad = 0;
        $p_art_int_ad = 0;
        $p_lib_nac_ad = 0;
        $p_lib_int_ad = 0;
        $p_cap_nac_ad = 0;
        $p_cap_int_ad = 0;

        //Saco los porcentajes de Biomedicina
        if($art_nac != 0){
            $p_art_nac = $art_nac * 100 / $total;
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

        //Saco los porcentajes de Clínica
        if($art_nac_cl != 0){
            $p_art_nac_cl = $art_nac_cl * 100 / $total_cl;
        }
        if($art_int_cl != 0){
             $p_art_int_cl = $art_int_cl * 100 / $total_cl;
        }
        if($lib_nac_cl != 0){
             $p_lib_nac_cl = $lib_nac_cl * 100 / $total_cl;
        }
        if($lib_int_cl != 0){
            $p_lib_int_cl = $lib_int_cl * 100 / $total_cl;
        }
        if($cap_nac_cl != 0){
            $p_cap_nac_cl = $cap_nac_cl * 100 / $total_cl;
        }
        if($cap_int_cl != 0){
            $p_cap_int_cl = $cap_int_cl * 100 / $total_cl;
        }

        //Saco los porcentajes de Sistemas de Salud
        if($art_nac_ss != 0){
            $p_art_nac_ss = $art_nac_ss * 100 / $total_ss;
        }
        if($art_int_ss != 0){
             $p_art_int_ss = $art_int_ss * 100 / $total_ss;
        }
        if($lib_nac_ss != 0){
             $p_lib_nac_ss = $lib_nac_ss * 100 / $total_ss;
        }
        if($lib_int_ss != 0){
            $p_lib_int_ss = $lib_int_ss * 100 / $total_ss;
        }
        if($cap_nac_ss != 0){
            $p_cap_nac_ss = $cap_nac_ss * 100 / $total_ss;
        }
        if($cap_int_ss != 0){
            $p_cap_int_ss = $cap_int_ss * 100 / $total_ss;
        }

        //Saco los porcentajes de Adicciones
        if($art_nac_ad != 0){
            $p_art_nac_ad = $art_nac_ad * 100 / $total_ad;
        }
        if($art_int_ad != 0){
             $p_art_int_ad = $art_int_ad * 100 / $total_ad;
        }
        if($lib_nac_ad != 0){
             $p_lib_nac_ad = $lib_nac_ad * 100 / $total_ad;
        }
        if($lib_int_ad != 0){
            $p_lib_int_ad = $lib_int_ad * 100 / $total_ad;
        }
        if($cap_nac_ad != 0){
            $p_cap_nac_ad = $cap_nac_ad * 100 / $total_ad;
        }
        if($cap_int_ad != 0){
            $p_cap_int_ad = $cap_int_ad * 100 / $total_ad;
        }

        $lista['desde'] = implode("/", array_reverse( preg_split("/\D/", $fecha_de) ) );
        $lista['hasta'] = implode("/", array_reverse( preg_split("/\D/", $fecha_hasta) ) );

        //Mando los porcentajes y totales de Biomedicina
        $lista['p_art_nac'] = round($p_art_nac,2);
        $lista['p_art_int'] = round($p_art_int,2);
        $lista['p_lib_nac'] = round($p_lib_nac,2);
        $lista['p_lib_int'] = round($p_lib_int,2);
        $lista['p_cap_nac'] = round($p_cap_nac,2);
        $lista['p_cap_int'] = round($p_cap_int,2);
        $lista['art_nac'] = $art_nac;
        $lista['art_int'] = $art_int;
        $lista['lib_nac'] = $lib_nac;
        $lista['lib_int'] = $lib_int;
        $lista['cap_nac'] = $cap_nac;
        $lista['cap_int'] = $cap_int;
        $lista['p_invest'] = round($total / $invest,2); //Divido el total de publicaciones por el total de Investigadores de Biomedicina

        //Mando los porcentajes y totales del área Clínica
        $lista['p_art_nac_cl'] = round($p_art_nac_cl,2);
        $lista['p_art_int_cl'] = round($p_art_int_cl,2);
        $lista['p_lib_nac_cl'] = round($p_lib_nac_cl,2);
        $lista['p_lib_int_cl'] = round($p_lib_int_cl,2);
        $lista['p_cap_nac_cl'] = round($p_cap_nac_cl,2);
        $lista['p_cap_int_cl'] = round($p_cap_int_cl,2);
        $lista['art_nac_cl'] = $art_nac_cl;
        $lista['art_int_cl'] = $art_int_cl;
        $lista['lib_nac_cl'] = $lib_nac_cl;
        $lista['lib_int_cl'] = $lib_int_cl;
        $lista['cap_nac_cl'] = $cap_nac_cl;
        $lista['cap_int_cl'] = $cap_int_cl;
        $lista['p_invest_cl'] = round($total_cl / $invest_cl,2); //Divido el total de publicaciones por el total de Investigadores del área Clínica

        //Mando los porcentajes y totales de Sistemas de Salud
        $lista['p_art_nac_ss'] = round($p_art_nac_ss,2);
        $lista['p_art_int_ss'] = round($p_art_int_ss,2);
        $lista['p_lib_nac_ss'] = round($p_lib_nac_ss,2);
        $lista['p_lib_int_ss'] = round($p_lib_int_ss,2);
        $lista['p_cap_nac_ss'] = round($p_cap_nac_ss,2);
        $lista['p_cap_int_ss'] = round($p_cap_int_ss,2);
        $lista['art_nac_ss'] = $art_nac_ss;
        $lista['art_int_ss'] = $art_int_ss;
        $lista['lib_nac_ss'] = $lib_nac_ss;
        $lista['lib_int_ss'] = $lib_int_ss;
        $lista['cap_nac_ss'] = $cap_nac_ss;
        $lista['cap_int_ss'] = $cap_int_ss;
        $lista['p_invest_ss'] = round($total_ss / $invest_ss,2); //Divido el total de publicaciones por el total de Investigadores de Sistemas de Salud

        //Mando los porcentajes y totales de Adicciones
        $lista['p_art_nac_ad'] = round($p_art_nac_ad,2);
        $lista['p_art_int_ad'] = round($p_art_int_ad,2);
        $lista['p_lib_nac_ad'] = round($p_lib_nac_ad,2);
        $lista['p_lib_int_ad'] = round($p_lib_int_ad,2);
        $lista['p_cap_nac_ad'] = round($p_cap_nac_ad,2);
        $lista['p_cap_int_ad'] = round($p_cap_int_ad,2);
        $lista['art_nac_ad'] = $art_nac_ad;
        $lista['art_int_ad'] = $art_int_ad;
        $lista['lib_nac_ad'] = $lib_nac_ad;
        $lista['lib_int_ad'] = $lib_int_ad;
        $lista['cap_nac_ad'] = $cap_nac_ad;
        $lista['cap_int_ad'] = $cap_int_ad;
        $lista['p_invest_ad'] = round($total_ad / $invest_ad,2); //Divido el total de publicaciones por el total de Investigadores de Adicciones


        $action['action'] = "informe/departamento/publicaciones";
        $lista['form_fechas'] = $this->load->view('informe/form_fechas',$action,TRUE);
        $datos_plantilla['titulo'] = "Total de publicaciones";
        $datos_plantilla['contenido'] = $this->load->view('informe/departamento_view',$lista,TRUE);
        $this->load->view('informe_view', $datos_plantilla);
    }
}

 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */