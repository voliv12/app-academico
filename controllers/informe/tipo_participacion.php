<?php
Class Tipo_participacion extends CI_controller{

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



    function tipo()
    {
        $fecha_de = $this->input->post('fecha_de');
        $fecha_hasta = $this->input->post('fecha_hasta');

        $this->load->model('publicaciones_model');
        //*******Consulto por tipo de participacion
        $art_ap = $this->publicaciones_model->tipo_participacion("articulo", $fecha_de, $fecha_hasta, "autor_principal");
        $art_ac = $this->publicaciones_model->tipo_participacion("articulo", $fecha_de, $fecha_hasta, "autor_correspondencia");
        $art_co = $this->publicaciones_model->tipo_participacion_col("articulo", $fecha_de, $fecha_hasta);
        $cap_ap = $this->publicaciones_model->tipo_participacion("capitulo", $fecha_de, $fecha_hasta, "autor_principal");
        $cap_co = $this->publicaciones_model->tipo_participacion_col_cap("capitulo", $fecha_de, $fecha_hasta);

        //obtengo el total de articulos
        $total_art = $this->publicaciones_model->total_publicaciones("articulo", $fecha_de, $fecha_hasta);
        $total_cap = $this->publicaciones_model->total_publicaciones("capitulo", $fecha_de, $fecha_hasta);

        //Invierto las fechas
        $lista['desde'] = implode("/", array_reverse( preg_split("/\D/", $fecha_de) ) );
        $lista['hasta'] = implode("/", array_reverse( preg_split("/\D/", $fecha_hasta) ) );

        if($total_art != 0)
        {
            $lista['p_art_ap'] = round($art_ap * 100 / $total_art);
            $lista['p_art_ac'] = round($art_ac * 100 / $total_art);
            $lista['p_art_co'] = round($art_co * 100 / $total_art);
            $lista['total_art'] = $total_art;
        }else{
            $lista['p_art_ap'] = 0;
            $lista['p_art_ac'] = 0;
            $lista['p_art_co'] = 0;
            $lista['total_art'] = 0;
        }
        if($total_cap != 0)
        {
            $lista['p_cap_ap'] = round($cap_ap * 100 / $total_cap);
            $lista['p_cap_co'] = round($cap_co * 100 / $total_cap);
            $lista['total_cap'] = $total_cap;
        }else{
            $lista['p_cap_ap'] = 0;
            $lista['p_cap_co'] = 0;
            $lista['total_cap'] = 0;
        }

        //Mando los totales
        $lista['art_ap'] = $art_ap;
        $lista['art_ac'] = $art_ac;
        $lista['art_co'] = $art_co;
        $lista['cap_ap'] = $cap_ap;
        $lista['cap_co'] = $cap_co;


        $action['action'] = "informe/tipo_participacion/tipo";
        $lista['form_fechas'] = $this->load->view('informe/form_fechas',$action,TRUE);
        $datos_plantilla['titulo'] = "Tipo de Participación";
        $datos_plantilla['contenido'] = $this->load->view('informe/tipo_participacion_view',$lista,TRUE);
        $this->load->view('informe_view', $datos_plantilla);
    }
}

 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */