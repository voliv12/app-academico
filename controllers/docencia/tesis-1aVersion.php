<?php
Class Tesis extends CI_controller{

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
            $datos_plantilla['titulo'] = "Dirección de tesis";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);

        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();

                $crud->where('Academico_noPersonal',$this->noPersonal);
                $crud->set_table('tesis');
                $crud->unset_columns('Academico_noPersonal');
                $crud->display_as('Academico_noPersonal','Núm. Personal');
                $crud->set_subject('Tesis');
                $crud->required_fields('intervencion','nombre_tesista','titulo_tesis','nivel','programa','fecha_presentacion');
                //$crud->set_relation('facultad','facultad','nombre_facultad');
                //$crud->set_relation('posgrado','posgrado','nombre_posgrado');
                $crud->display_as('intervencion','Intervención')->display_as('titulo_tesis','Título tesis')->display_as('fecha_presentacion','Fecha presentación');
                $crud->field_type('Academico_noPersonal', 'hidden', $this->noPersonal);
                $crud->set_field_upload('documento', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->set_rules('documento','Documento','max_length[26]');
                $crud->order_by('fecha_presentacion','Desc');

                $crud->callback_add_field('programa',array($this,'add_field_programa'));

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Dirección de tesis</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function add_field_programa()
        {
            return '<input type="text" maxlength="200" name="programa"> (Nombre de la carrera o posgrado)';
        }
}
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */