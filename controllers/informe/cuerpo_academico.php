<?php
Class Cuerpo_academico extends CI_controller{

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
        $fecha_de = $this->input->post('fecha_de');
        $fecha_hasta = $this->input->post('fecha_hasta');

        //$fecha_de = "2010/01/01/";
        //$fecha_hasta = "2015/02/24";

        $this->load->model('publicaciones_model');
        //*******Consulto por cuerpo academico
        $lista['ca'] = $this->publicaciones_model->cuerpo_academico("articulo", $fecha_de, $fecha_hasta);
        $lista['ca_l'] = $this->publicaciones_model->cuerpo_academico("libro", $fecha_de, $fecha_hasta);
        $lista['ca_c'] = $this->publicaciones_model->cuerpo_academico("capitulo", $fecha_de, $fecha_hasta);

        //Invierto las fechas
        $lista['desde'] = implode("/", array_reverse( preg_split("/\D/", $fecha_de) ) );
        $lista['hasta'] = implode("/", array_reverse( preg_split("/\D/", $fecha_hasta) ) );

        $action['action'] = "informe/cuerpo_academico";
        $lista['form_fechas'] = $this->load->view('informe/form_fechas',$action,TRUE);
        $datos_plantilla['titulo'] = "Tipo de Participación";
        $datos_plantilla['contenido'] = $this->load->view('informe/cuerpo_academico_view',$lista,TRUE);
        $this->load->view('informe_view', $datos_plantilla);
    }
}

 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */