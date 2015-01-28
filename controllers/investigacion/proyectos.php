<?php
Class Proyectos extends CI_controller{

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
            $datos_plantilla['titulo'] = "Proyectos";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);

        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();

                $crud->where('Academico_noPersonal',$this->noPersonal);
                $crud->set_table('proyecto');
                $crud->unset_columns('Academico_noPersonal');
                $crud->display_as('Academico_noPersonal','Núm. Personal');
                $crud->display_as('Lineas_idLineas','Linea investigacion')->display_as('Registro_DGI','Fecha registro DGI')->display_as('productos','Productos comprometidos ante la DGI');
                $crud->set_subject('Proyecto');
                $crud->required_fields('Titulo','Lineas_idLineas','Estado');
                $crud->set_relation('Lineas_idLineas','lineas','Lineas_investigacion');
                $crud->field_type('Academico_noPersonal', 'hidden', $this->noPersonal);
                //$crud->set_field_upload('documento', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->unset_texteditor('Observaciones','full_text')->unset_texteditor('productos','full_text');
                $crud->order_by('Estado','Asc');

                $crud->callback_before_insert(array($this,'convertir_a_mayusculas'));
                $crud->callback_before_update(array($this,'convertir_a_mayusculas'));

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Proyectos</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function convertir_a_mayusculas($post_array)
        {

            $post_array['Titulo'] = strtoupper($post_array['Titulo']);

            return $post_array;
        }


}
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */