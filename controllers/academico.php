<?php
Class Academico extends CI_controller{

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
            $datos_plantilla['titulo'] = "Academico";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);

        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();

                $crud->where('noPersonal',$this->noPersonal);
                $crud->set_table('academico');
                $crud->set_relation('categoria', 'categoria', 'nombre_categoria');
                $crud->set_relation('departamento','departamento', 'nombre_depto');
                $crud->unset_columns('noPersonal','nombre_grado','direccion','rfc','curp','correos','licenciatura','titulo_cedula_lic','especialidad','titulo_cedula_esp','maestria','titulo_cedula_mae','doctorado','titulo_cedula_doc');
                $crud->unset_fields('nombre_grado');
                $crud->unset_add();
                $crud->unset_delete();
                $crud->display_as('titulo_cedula_lic','Titulo y Cédula Lic');
                $crud->display_as('titulo_cedula_esp','Titulo y Cédula Esp');
                $crud->display_as('titulo_cedula_mae','Titulo y Cédula Mae');
                $crud->display_as('titulo_cedula_doc','Titulo y Cédula Doc');
                $crud->display_as('grado','Ultimo grado de estudios');
                $crud->field_type('noPersonal','readonly');
                $crud->set_field_upload('titulo_cedula_lic', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->set_field_upload('titulo_cedula_esp', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->set_field_upload('titulo_cedula_mae', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->set_field_upload('titulo_cedula_doc', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->set_rules('titulo_cedula_lic','Titulo y Cédula Lic','max_length[26]');
                $crud->set_rules('titulo_cedula_esp','Titulo y Cédula Esp','max_length[26]');
                $crud->set_rules('titulo_cedula_mae','Titulo y Cédula Mae','max_length[26]');
                $crud->set_rules('titulo_cedula_doc','Titulo y Cédula Doc','max_length[26]');
                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Información personal del Académico</h4></div>';
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