<?php
Class Donaciones extends CI_controller{

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

                $crud->where('donacion.Academico_noPersonal',$this->noPersonal);
                $crud->set_table('donacion');
                $crud->unset_columns('Academico_noPersonal');
                //$crud->display_as('Proyecto_idProyecto','Proyecto')->display_as('Cuerpo_idCuerpo','Cuerpo Académico')->display_as('Posgrado_idPosgrado','Posgrado');
                //$crud->display_as('Fuente_idFuente','Fuente');
                $crud->set_subject('Donación');
                $crud->required_fields('destino','tipo','donante','fecha_donacion');
                $crud->set_rules('monto','Monto','numeric');
                $crud->field_type('Academico_noPersonal', 'hidden', $this->noPersonal);
                $crud->unset_texteditor('descripcion','full_text');
                $crud->unset_texteditor('observaciones','full_text');
                $crud->columns('destino','tipo','donante','monto','cantidad','descripcion');
                $crud->order_by('fecha_donacion','Desc');

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Donaciones</h4></div>';
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