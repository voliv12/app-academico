<?php
Class Financiamiento extends CI_controller{

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
            $datos_plantilla['titulo'] = "Financiamiento de proyectos";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);

        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();

                $crud->where('financiamiento.Academico_noPersonal',$this->noPersonal);
                $crud->set_table('financiamiento');
                $crud->unset_columns('Academico_noPersonal');
                $crud->display_as('Academico_noPersonal','Núm. Personal');
                $crud->display_as('Proyecto_idProyecto','Proyecto')->display_as('Cuerpo_idCuerpo','Cuerpo Académico')->display_as('Posgrado_idPosgrado','Posgrado');
                $crud->display_as('Fuente_idFuente','Fuente');
                $crud->set_subject('Financiamiento');
                $crud->required_fields('Destino','Fuente_idFuente','Periodo','Estado','Monto');
                $crud->set_rules('Monto','Monto','required|numeric');
                $crud->set_relation('Fuente_idFuente','fuente','Fuente');
                $crud->set_relation('Proyecto_idProyecto','proyecto','Titulo');
                $crud->set_relation('Cuerpo_idCuerpo','cuerpo','nombre_CA');
                $crud->set_relation('Posgrado_idPosgrado','posgrado','nombre_posgrado');
                $crud->field_type('Academico_noPersonal', 'hidden', $this->noPersonal);
                $crud->unset_texteditor('Observaciones','full_text');
                $crud->columns('Destino','Fuente_idFuente','Otra_fuente','Monto');
                $crud->order_by('Estado','Asc');

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Financiamiento</h4></div>';
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