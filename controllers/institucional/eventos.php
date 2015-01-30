<?php
Class Eventos extends CI_controller{

        function __construct()
        {
            parent::__construct();

            /* Standard Libraries */
            $this->load->database();
            $this->load->helper('url');
            /* ------------------ */
            $this->load->library('grocery_CRUD');
            $this->noPersonal = $this->session->userdata('noPersonal');
        }

        function _example_output($output = null)
        {
            $datos_plantilla['titulo'] = "Eventos académicos";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);
        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();
                $crud->set_table('evento');
                $crud->set_model('gcrud_query_model');
                $crud->set_relation_n_n('organizadores', 'evento_academico', 'academico', 'idEvento', 'noPersonal', 'nombre');
                $crud->set_subject('Evento Académico');
                $crud->basic_model->set_join_str("evento_academico", "evento.idEvento = evento_academico.idEvento");
                $where_array = array("evento_academico.noPersonal" => $this->noPersonal);
                $crud->basic_model->set_where_str($where_array);
                $crud->required_fields('nombre_evento','organizadores','fecha');
                $crud->unset_texteditor('descripcion','full_text');
                $crud->field_type('Academico_noPersonal', 'hidden', $this->noPersonal);
                $crud->set_field_upload('documento', 'assets/uploads/academicos/'.$this->noPersonal);

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Eventos académicos organizados</h4></div>';
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