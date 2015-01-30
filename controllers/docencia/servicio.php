<?php
Class Servicio extends CI_controller{

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
            $datos_plantilla['titulo'] = "Servicio Social";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);

        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();

                $crud->where('Academico_noPersonal',$this->noPersonal);
                $crud->set_table('servicio_social');
                $crud->unset_columns('Academico_noPersonal');
                $crud->set_subject('Servicio Social');
                $crud->required_fields('nombre_alumno','facultad', 'fecha_inicio','fecha_de_termino','area_instituto');
                $crud->field_type('Academico_noPersonal', 'hidden', $this->noPersonal);
                //$crud->set_field_upload('documento', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->order_by('fecha_inicio','Desc');
                //$crud->display_as('matricula','Matrícula')->display_as('fecha_termino','Fecha término');

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Servicio Social</h4></div>';
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