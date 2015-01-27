<?php
Class Tutorias extends CI_controller{

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
            $datos_plantilla['titulo'] = "Tutorías";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);

        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();

                $crud->where('Academico_noPersonal',$this->noPersonal);
                $crud->set_table('tutoria');
                $crud->unset_columns('Academico_noPersonal');
                $crud->display_as('Academico_noPersonal','Núm. Personal');
                $crud->set_subject('Tutoria');
                $crud->required_fields('nombre_alumno','nivel','programa','fecha_inicio','estado');
                $crud->field_type('Academico_noPersonal', 'hidden', $this->noPersonal);
                $crud->set_field_upload('documento', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->order_by('estado','Asc');
                $crud->display_as('matricula','Matrícula')->display_as('fecha_termino','Fecha término');
                $crud->callback_add_field('programa',array($this,'add_field_programa'));
                //$crud->callback_add_field('fecha_inicio',array($this,'add_field_inicio'));
                //$crud->callback_add_field('fecha_termino',array($this,'add_field_termino'));
                //$crud->callback_before_insert(array($this,'limpia_fecha'));
                //$crud->callback_before_update(array($this,'limpia_fecha'));

                //$crud->set_lang_string('insert_error', 'El campo "Fecha termino" debe ser nulo');//Mensaje por si hay un error al insertar
                //$crud->set_lang_string('update_error', 'El campo "Fecha termino" debe ser nulo');//Mensaje por si hay un error al actualizar

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Tutorías</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function add_field_programa()
        {
            return '<input type="text" maxlength="50" name="programa"> (Nombre de la carrera o posgrado)';
        }
}
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */