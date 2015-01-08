<?php
Class Tutorias extends CI_controller{

        function __construct()
        {
            parent::__construct();

            /* Standard Libraries */
            $this->load->database();
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            /* ------------------ */
            $this->load->library('grocery_CRUD');
            $this->noPersonal = $this->session->userdata('noPersonal');
        }

        function _example_output($output = null)
        {
            $datos_plantilla['titulo'] = "Tutorías";
            $output->titulo_tabla = "Docencia - Tutorías";
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
                $crud->set_field_upload('documento', 'assets/uploads/files');
                $crud->order_by('estado','Asc');

                $crud->callback_add_field('Academico_noPersonal',array($this,'add_field'));
                $crud->callback_add_field('programa',array($this,'add_field_programa'));
                $crud->callback_add_field('fecha_inicio',array($this,'add_field_inicio'));
                $crud->callback_add_field('fecha_termino',array($this,'add_field_termino'));
                $crud->callback_before_insert(array($this,'limpia_fecha'));
                $crud->callback_before_update(array($this,'limpia_fecha'));

                $crud->set_lang_string('insert_error', 'El campo "Fecha termino" debe ser nulo');//Mensaje por si hay un error al insertar
                //$crud->set_lang_string('update_error', 'El campo "Fecha termino" debe ser nulo');//Mensaje por si hay un error al actualizar

                $output = $crud->render();
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function add_field()
        {
            return '<input type="text" maxlength="50" value="'.$this->noPersonal.'" name="Academico_noPersonal" readonly>';
        }

        function add_field_programa()
        {
            return '<input type="text" maxlength="50" name="programa"> (Nombre de la carrera o posgrado)';
        }

        function add_field_inicio()
        {
            return '<input type="date" maxlength="50" name="fecha_inicio">';
        }

        function add_field_termino()
        {
            return '<input type="date" maxlength="50" name="fecha_termino"> (poner sólo si el estado de la Tutoría es "Concluida" )';
        }

        function limpia_fecha($post_array)
        {
            //$post_array['fecha_inicio'] = implode("/", array_reverse( preg_split("/\D/", $post_array['fecha_inicio']) ) );
            //$post_array['fecha_termino'] = implode("/", array_reverse( preg_split("/\D/", $post_array['fecha_termino']) ) );
            //$crud = new grocery_CRUD();

            if(($post_array['estado'] == "En proceso" ) AND ($post_array['fecha_termino'] != NULL) )
            {
                //$post_array['fecha_termino']  = NULL;
                return FALSE;

            }else
            {
                //return $this->db->insert('tutoria',$post_array);
                return TRUE;
            }


        }
}
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */