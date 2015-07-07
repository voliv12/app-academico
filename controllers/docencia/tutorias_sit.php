<?php
Class Tutorias_sit extends CI_controller{

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
                $crud->set_table('tutoria_sit');
                $crud->unset_columns('Academico_noPersonal','vigente');
                //$crud->unset_fields('vigente');
                $crud->set_subject('Tutoria');
                $crud->required_fields('nivel','total_alumnos','periodo');
                $crud->set_relation('facultad','facultad','nombre_facultad');
                $crud->set_relation('posgrado','posgrado','nombre_posgrado');
                //$crud->columns('nivel','facultad','posgrado','total_alumnos','vigente');
                $crud->field_type('Academico_noPersonal', 'hidden', $this->noPersonal);
                //$crud->field_type('total_alumnos', 'dropdown', range(1,40));
                $crud->set_relation('periodo','cat_periodos','descripcion');
                $crud->set_field_upload('reporte_SIT', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->set_rules('reporte_SIT','Reporte del SIT','max_length[26]');
                $crud->order_by('vigente','Asc');
                $crud->display_as('reporte_SIT','Reporte del SIT');
                //$crud->callback_before_insert(array($this,'action_callback'));
                //$crud->callback_before_update(array($this,'action_callback'));

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Tutorías</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }


        function action_callback($post_array)
        {

            $post_array['total_alumnos'] = $post_array['total_alumnos'] + 1;

            return $post_array;
        }

}
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */