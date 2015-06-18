<?php
Class Personal_academico extends CI_controller{

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
            $datos_plantilla['titulo'] = "Informe";
            $datos_plantilla['contenido'] = " ";
            $this->load->view('informe_view', $datos_plantilla);
        }
    }

     function _example_output($output = null)
    {
        $datos_plantilla['titulo'] = "Personal Académico";
        $datos_plantilla['contenido'] = $this->load->view('informe/tipo_view',$output,TRUE);
        //$datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
        $this->load->view('informe_view', $datos_plantilla);

    }

    function tipo()
    {
         if ($this->session->userdata('logged_in') == TRUE)
        {
            $this->load->model('usuarios_model');
            $inv =  $this->usuarios_model->contar_investigadores_tc();
            $inv_mt = $this->usuarios_model->contar_investigadores_mt();
            $tecnico = $this->usuarios_model->contar_tecnicos();

            $crud = new grocery_CRUD();

            $crud->set_table('academico');
            $crud->set_relation('categoria', 'categoria', 'nombre_categoria');
            $crud->set_relation('departamento', 'departamento', 'nombre_depto');
            $crud->columns('noPersonal','nombre','categoria','departamento');
            $crud->unset_fields('grado','nombre_grado');
            $crud->set_field_upload('titulo_cedula_lic', 'assets/uploads/academicos/');
            $crud->set_field_upload('titulo_cedula_esp', 'assets/uploads/academicos/');
            $crud->set_field_upload('titulo_cedula_mae', 'assets/uploads/academicos/');
            $crud->set_field_upload('titulo_cedula_doc', 'assets/uploads/academicos/');
            $crud->unset_add()->unset_delete()->unset_edit();
            $crud->order_by('nombre', 'asc');

            $output = $crud->render();
            $total = $inv + $inv_mt + $tecnico; // Total del personal Académico
            if($total != 0 ){
                $p_inv = $inv * 100 / $total; //saco porcentaje de Investigadores T.C.
                $p_inv_mt = $inv_mt * 100 / $total; //saco porcentaje de Investigadores M.T.
                $p_tecnico = $tecnico * 100 / $total; //saco porcentaje de Técnicos Académicos.
            }else{
                $p_inv = 0;
                $p_inv_mt = 0;
                $p_tecnico = 0;
            }

            $output->inv = $inv;
            $output->inv_mt = $inv_mt;
            $output->tecnico = $tecnico;
            $output->p_inv = round($p_inv);
            $output->p_inv_mt = round($p_inv_mt);
            $output->p_tecnico = round($p_tecnico);
            $output->titulo_tabla = '<div class="alert alert-success"><h4>Personal Académico</h4></div>';
            $this->_example_output($output);
        }else
        {
            redirect('login');
        }
    }

    function grado()
    {
        $this->load->model('usuarios_model');
        $total = 0;

        $d = $this->usuarios_model->contar_academicos_grado("Doctorado");
        $m = $this->usuarios_model->contar_academicos_grado("Maestría");
        $e = $this->usuarios_model->contar_academicos_grado("Especialidad");
        $em = $this->usuarios_model->contar_academicos_grado("Especialidad Médica");
        $l = $this->usuarios_model->contar_academicos_grado("Licenciatura");
        $total = $d + $m + $e + $em + $l;

        if($total != 0){
            $p_d = round($d * 100 / $total); //saco porcentaje de académicos con Doctorado.
            $p_m = round($m * 100 / $total);
            $p_e = round($e * 100 / $total);
            $p_em = round($em * 100 / $total);
            $p_l = round($l * 100 / $total);
        }else{
            $p_d = 0;
            $p_m = 0;
            $p_e = 0;
            $p_em = 0;
            $p_l = 0;
        }

        $lista['p_d'] = $p_d;   //Mando los porcentajes de Docotorado
        $lista['p_m'] = $p_m;   //                      de Maestría
        $lista['p_e'] = $p_e;   //                      de Especialidad
        $lista['p_em'] = $p_em; //                      de Especialidad Médica
        $lista['p_l'] = $p_l;   //                      de Licenciatura
        $lista['d'] = $d;
        $lista['m'] = $m;
        $lista['e'] = $e;
        $lista['em'] = $em;
        $lista['l'] = $l;

        $datos_plantilla['titulo'] = "Grado del personal Académico";
        $datos_plantilla['contenido'] = $this->load->view('informe/grado_view',$lista,TRUE);
        $this->load->view('informe_view', $datos_plantilla);
        //echo $maestria;
    }

}


 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */