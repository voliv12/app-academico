<?php
Class Cuerpos extends CI_controller{

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
            $datos_plantilla['titulo'] = "Cuerpos Académicos";
            $output->titulo_tabla = "Investigación - Cuerpos Académicos";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);

        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $this->load->model('investigacion_model');
                $result = $this->investigacion_model->buscar_en_CA($this->noPersonal, "cuerpo_academico");

                $crud = new grocery_CRUD();
                $crud->set_table('cuerpo');
                $crud->set_model('gcrud_query_model');
                $crud->set_relation_n_n('integrantes_internos', 'cuerpo_academico', 'academico', 'idCuerpo', 'noPersonal', 'nombre','priority');
                $crud->set_relation_n_n('colaboradores_internos', 'cuerpo_academico_col', 'academico', 'idCuerpo', 'noPersonal', 'nombre','priority');

                if($result > 0){
                    $crud->basic_model->set_join_str("cuerpo_academico", "cuerpo.idCuerpo = cuerpo_academico.idCuerpo");
                    $where_array = array("cuerpo_academico.noPersonal" => $this->noPersonal);
                    $crud->basic_model->set_where_str($where_array);
                }else{
                    $crud->basic_model->set_join_str("cuerpo_academico_col", "cuerpo.idCuerpo = cuerpo_academico_col.idCuerpo");
                    $where_array = array("cuerpo_academico_col.noPersonal" => $this->noPersonal);
                    $crud->basic_model->set_where_str($where_array);
                }

                $crud->columns('clave','nombre_CA','representante','LGAC');
                $crud->unset_texteditor('LGAC','full_text');
                $crud->unset_texteditor('integrantes_externos','full_text');
                $crud->unset_texteditor('colaboradores_externos','full_text');
                //$crud->display_as('Academico_noPersonal','Núm. Personal');
                $crud->set_subject('Cuerpo Académico');
                $crud->required_fields('clave','nombre_CA','representante','LGAC','integrantes_internos');

                //$crud->order_by('fecha','Desc');

                $crud->callback_before_insert(array($this,'convertir_a_mayusculas'));
                $crud->callback_before_update(array($this,'convertir_a_mayusculas'));

                $output = $crud->render();
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function convertir_a_mayusculas($post_array)
        {

            $post_array['nombre_CA'] = strtoupper($post_array['nombre_CA']);
            $post_array['representante'] = strtoupper($post_array['representante']);

            return $post_array;
        }

}
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */