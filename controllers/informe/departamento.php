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
        //$fecha_hasta = "2015/03/03";

        $this->load->model('publicaciones_model');
        $deptos_array = $this->publicaciones_model->lista_departamentos();
        //*******Consulto la producción de los Departamentos
        $art_n = $this->publicaciones_model->produccion_departamento("articulo_academico","articulo","idArticulo",$fecha_de,$fecha_hasta,"Nacional","total_n","porcentaje_n");
        $art_i = $this->publicaciones_model->produccion_departamento("articulo_academico","articulo","idArticulo",$fecha_de,$fecha_hasta,"Internacional","total_i","porcentaje_i");
        $lib_n = $this->publicaciones_model->produccion_departamento("libro_academico","libro","idLibro",$fecha_de,$fecha_hasta,"Nacional","total_n","porcentaje_n");
        $lib_i = $this->publicaciones_model->produccion_departamento("libro_academico","libro","idLibro",$fecha_de,$fecha_hasta,"Internacional","total_i","porcentaje_i");
        $cap_n = $this->publicaciones_model->produccion_departamento("capitulo_academico","capitulo","idCapitulo",$fecha_de,$fecha_hasta,"Nacional","total_n","porcentaje_n");
        $cap_i = $this->publicaciones_model->produccion_departamento("capitulo_academico","capitulo","idCapitulo",$fecha_de,$fecha_hasta,"Internacional","total_i","porcentaje_i");

        $deptos = array(); //Catalogo Departamentos
        foreach($deptos_array as $row){
            array_push($deptos, $row['nombre_depto']);
        }

        //###################### Para los nacionales ####################################
        //ARTICULOS NACIONALES
        $pila = array();
        $aux = array();
        foreach ($deptos as $row_1) {
            foreach ($art_n as $row_2) {
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

        //LIBROS NACIONALES
        $pila_lib = array();
        $aux_lib = array();
        foreach ($deptos as $row_1) {
            foreach ($lib_n as $row_2) {
                if($row_1 == $row_2['nombre_depto']){
                    $pila_lib[] = array(
                                    'nombre_depto'  => $row_1,
                                    'total_n'       => $row_2['total_n'],
                                    'porcentaje_n'  => $row_2['porcentaje_n']
                                );
                    array_push($aux_lib, $row_2['nombre_depto']);
                }
            }
        }

        $diff_lib = array_diff($deptos,$aux_lib);
        foreach ($diff_lib as $row) {
            $pila_lib[] = array('nombre_depto' => $row, 'total_n' => 0, 'porcentaje_n' => 0);
        }

        //CAPITULOS NACIONALES
        $pila_cap = array();
        $aux_cap = array();
        foreach ($deptos as $row_1) {
            foreach ($cap_n as $row_2) {
                if($row_1 == $row_2['nombre_depto']){
                    $pila_cap[] = array(
                                    'nombre_depto'  => $row_1,
                                    'total_n'       => $row_2['total_n'],
                                    'porcentaje_n'  => $row_2['porcentaje_n']
                                );
                    array_push($aux_cap, $row_2['nombre_depto']);
                }
            }
        }

        $diff_cap = array_diff($deptos,$aux_cap);
        foreach ($diff_cap as $row) {
            $pila_cap[] = array('nombre_depto' => $row, 'total_n' => 0, 'porcentaje_n' => 0);
        }


        //###################### Para los internacionales################################
        //ARTICULOS INTERNACIONALES
        $pila_2 = array();
        $aux_2 = array();
        foreach ($deptos as $row_1) {
            foreach ($art_i as $row_2) {
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

        //LIBROS INTERNACIONALES
        $pila_lib_i = array();
        $aux_lib_i = array();
        foreach ($deptos as $row_1) {
            foreach ($lib_i as $row_2) {
                if($row_1 == $row_2['nombre_depto']){
                    $pila_lib_i[] = array(
                                    'nombre_depto'  => $row_1,
                                    'total_i' => $row_2['total_i'],
                                    'porcentaje_i' => $row_2['porcentaje_i']
                                );
                    array_push($aux_lib_i, $row_2['nombre_depto']);
                }
            }
        }

        $diff_lib_i = array_diff($deptos,$aux_lib_i); //saco la diferencia de los departamentos internacionales
        foreach ($diff_lib_i as $row) {
            $pila_lib_i[] = array('nombre_depto' => $row, 'total_i' => 0, 'porcentaje_i' => 0);
        }

        //CAPITULOS INTERNACIONALES
        $pila_cap_i = array();
        $aux_cap_i = array();
        foreach ($deptos as $row_1) {
            foreach ($cap_i as $row_2) {
                if($row_1 == $row_2['nombre_depto']){
                    $pila_cap_i[] = array(
                                    'nombre_depto'  => $row_1,
                                    'total_i' => $row_2['total_i'],
                                    'porcentaje_i' => $row_2['porcentaje_i']
                                );
                    array_push($aux_cap_i, $row_2['nombre_depto']);
                }
            }
        }

        $diff_cap_i = array_diff($deptos,$aux_cap_i); //saco la diferencia de los departamentos internacionales
        foreach ($diff_cap_i as $row) {
            $pila_cap_i[] = array('nombre_depto' => $row, 'total_i' => 0, 'porcentaje_i' => 0);
        }


        //###### Mezclo nacionales e internacionales
        //ARTICULOS
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

        //LIBROS
        $pila_mix_lib = array();
        foreach ($pila_lib as $row_n) {
            foreach ($pila_lib_i as $row_i) {
                if($row_n['nombre_depto'] == $row_i['nombre_depto']){
                    $pila_mix_lib[] = array(
                                        'nombre_depto'  => $row_n['nombre_depto'],
                                        'total_n'       => $row_n['total_n'],
                                        'porcentaje_n'  => $row_n['porcentaje_n'],
                                        'total_i'       => $row_i['total_i'],
                                        'porcentaje_i'  => $row_i['porcentaje_i']
                                    );
                }
            }
        }

        //CAPITULOS
        $pila_mix_cap = array();
        foreach ($pila_cap as $row_n) {
            foreach ($pila_cap_i as $row_i) {
                if($row_n['nombre_depto'] == $row_i['nombre_depto']){
                    $pila_mix_cap[] = array(
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
        $lista['lib'] = $pila_mix_lib;
        $lista['cap'] = $pila_mix_cap;

        //print_r($pila_mix_lib);
        //print_r($pila_lib);
        //print_r($cap_n);

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