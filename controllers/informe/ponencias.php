<?php
Class Ponencias extends CI_controller{

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

    function _example_output($output = null)
    {
        $datos_plantilla['titulo'] = "Artículos publicados";
        $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
        $this->load->view('informe_view', $datos_plantilla);

    }

    function listar_ponencias()
    {
         if ($this->session->userdata('logged_in') == TRUE)
        {

            $crud = new grocery_CRUD();
            $crud->set_table('ponencia');
            $crud->set_relation_n_n('autor_interno', 'ponencia_academico', 'academico', 'idPonencia', 'noPersonal', 'nombre','priority');
            $crud->columns('autor_interno','nombre_ponencia','evento','organizador','lugar','fecha');
            $crud->unset_add()->unset_edit()->unset_delete()->unset_print();
            $crud->order_by('fecha','DESC');

            $output = $crud->render();
            $output->titulo_tabla = '<div class="alert alert-success"><h4>Ponencias en total</h4></div>';
            $this->_example_output($output);
        }else
        {
            redirect('login');
        }
    }
}

 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */