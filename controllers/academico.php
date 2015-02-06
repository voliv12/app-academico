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
                $crud->set_relation('departamento', 'departamento', 'nombre_depto');
                $crud->unset_columns('noPersonal','direccion','rfc','curp','correos');
                $crud->unset_add();
                $crud->unset_delete();

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