<?php
Class Ponencias extends CI_controller{

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
            $datos_plantilla['titulo'] = "Ponencias en congreso";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);
        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $this->load->model('publicaciones_model');
                $total_pon    = $this->publicaciones_model->contar_libros_academico("idPonencia","ponencia_academico",$this->noPersonal);
                $msj = "<b>".$total_pon."</b> ponencia(s) Presentadas en total.";

                $crud = new grocery_CRUD();

                $crud->set_table('ponencia');
                $crud->set_model('gcrud_query_model');
                $crud->set_relation_n_n('autor_interno', 'ponencia_academico', 'academico', 'idPonencia', 'noPersonal', 'nombre', 'priority');
                $crud->set_subject('Ponencia');
                $crud->basic_model->set_join_str("ponencia_academico", "ponencia.idPonencia=ponencia_academico.idPonencia");
                $where_array = array("ponencia_academico.noPersonal" => $this->noPersonal);
                $crud->basic_model->set_where_str($where_array);
                $crud->columns('autor_interno','autor_externo','nombre_ponencia','evento','fecha');
                $crud->required_fields('autor_interno','nombre_ponencia','evento','lugar','fecha');
                $crud->set_field_upload('documento', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->order_by('fecha','Desc');

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Ponencias</h4></div>'.$msj;
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