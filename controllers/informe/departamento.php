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
        $fecha_de = $this->input->post('fecha_de');
        $fecha_hasta = $this->input->post('fecha_hasta');

        //$fecha_de = "2010/01/01/";
        //$fecha_hasta = "2015/02/24";

        $this->load->model('publicaciones_model');
        $deptos_array = $this->publicaciones_model->lista_departamentos();
        //*******Consulto la producción de los Departamentos
        $deptos_2 = $this->publicaciones_model->produccion_departamento("articulo_academico","articulo","idArticulo",$fecha_de,$fecha_hasta,"Nacional","total_n","porcentaje_n");
        $deptos_3 = $this->publicaciones_model->produccion_departamento("articulo_academico","articulo","idArticulo",$fecha_de,$fecha_hasta,"Internacional","total_i","porcentaje_i");

        $deptos = array(); //Catalogo Departamentos
        foreach($deptos_array as $row){
            array_push($deptos, $row['nombre_depto']);
        }

        //###################### Para los nacionales ####################################
        $pila = array();
        $aux = array();
        foreach ($deptos as $row_1) {
            foreach ($deptos_2 as $row_2) {
                if($row_1 == $row_2['nombre_depto']){
                    $pila[] = array(
                                    'nombre_depto'  => $row_1,
                                    'total_n'       => $row_2['total_n'],
                                    'porcentaje_n' => $row_2['porcentaje_n']
                                );
                    array_push($aux, $row_2['nombre_depto']);
                }
            }
        }

        $diff = array_diff($deptos,$aux); //saco la diferencia de los departamentos nacionales
        foreach ($diff as $row) {
            $pila[] = array('nombre_depto' => $row, 'total_n' => 0, 'porcentaje_n' => 0);
        }

        //###################### Para los internacionales################################
        $pila_2 = array();
        $aux_2 = array();
        foreach ($deptos as $row_1) {
            foreach ($deptos_3 as $row_2) {
                if($row_1 == $row_2['nombre_depto']){
                    $pila_2[] = array(
                                    'nombre_depto'  => $row_1,
                                    'total_i' => $row_2['total_i'],
                                    'porcentaje_i' => $row_2['porcentaje_i']
                                );
                    array_push($aux_2, $row_2['nombre_depto']);
                }
            }
        }

        $diff_2 = array_diff($deptos,$aux_2); //saco la diferencia de los departamentos internacionales
        foreach ($diff_2 as $row) {
            $pila_2[] = array('nombre_depto' => $row, 'total_i' => 0, 'porcentaje_i' => 0);
        }

        //###### Mezclo nacionales e internacionales
        $pila_mix = array();
        foreach ($pila as $row_n) {
            foreach ($pila_2 as $row_i) {
                if($row_n['nombre_depto'] == $row_i['nombre_depto']){
                    $pila_mix[] = array(
                                        'nombre_depto'  => $row_n['nombre_depto'],
                                        'total_n'       => $row_n['total_n'],
                                        'porcentaje_n'  => $row_n['porcentaje_n'],
                                        'total_i'       => $row_i['total_i'],
                                        'porcentaje_i'  => $row_i['porcentaje_i']
                                    );
                }
            }
        }

        $lista['art'] = $pila_mix;

        //Invierto las fechas
        $lista['desde'] = implode("/", array_reverse( preg_split("/\D/", $fecha_de) ) );
        $lista['hasta'] = implode("/", array_reverse( preg_split("/\D/", $fecha_hasta) ) );

        $action['action'] = "informe/departamento";
        $lista['form_fechas'] = $this->load->view('informe/form_fechas',$action,TRUE);
        $datos_plantilla['titulo'] = "Publicaciones por Departamento";
        $datos_plantilla['contenido'] = $this->load->view('informe/departamento_view',$lista,TRUE);
        $this->load->view('informe_view', $datos_plantilla);
    }
}

 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */