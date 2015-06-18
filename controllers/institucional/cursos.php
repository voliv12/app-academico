<?php
Class Cursos extends CI_controller{

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
            $datos_plantilla['titulo'] = "Cursos de Actualización";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);
        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();
                $crud->where('Academico_noPersonal',$this->noPersonal);
                $crud->set_table('cursos_actualizacion');
                $crud->set_subject('Curso de actualización');
                $crud->unset_columns('Academico_noPersonal');
                $crud->required_fields('nombre_curso','fecha_inicio','fecha_termino','horas');
                $crud->unset_texteditor('descripcion','full_text');
                $crud->field_type('Academico_noPersonal', 'hidden', $this->noPersonal);
                $crud->set_field_upload('constancia', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->set_rules('constancia','Constancia','max_length[26]');

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Cursos de Actualización</h4></div>';
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