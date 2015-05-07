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
                $crud->unset_columns('Academico_noPersonal');
                $crud->unset_fields('vigente');
                $crud->set_subject('Tutoria');
                $crud->required_fields('nivel','total_alumnos','periodo');
                $crud->set_relation('facultad','facultad','nombre_facultad');
                $crud->set_relation('posgrado','posgrado','nombre_posgrado');
                //$crud->columns('nivel','facultad','posgrado','total_alumnos','vigente');
                $crud->field_type('Academico_noPersonal', 'hidden', $this->noPersonal);
                $crud->field_type('total_alumnos', 'dropdown', range(1,40));
                $crud->field_type('periodo', 'dropdown',  array('201401' => 'Agosto 2013 - Enero 2014',
                                                            '201451' => 'Febrero - Julio 2014',
                                                            '201501' => 'Agosto 2014 - Enero 2015' ,
                                                            '201551' => 'Febrero - Julio 2015',
                                                            '201601' => 'Agosto 2015 - Enero 2016',
                                                            '201651' => 'Febrero - Julio 2016',
                                                            '201701' => 'Agosto 2016 - Enero 2017',
                                                            '201751' => 'Febrero - Julio 2017',
                                                            '201801' => 'Agosto 2017 - Enero 2018',
                                                            '201851' => 'Febrero - Julio 2018',
                                                            '201901' => 'Agosto 2018 - Enero 2019',
                                                            '201951' => 'Febrero - Julio 2019',
                                                            '202001' => 'Agosto 2019 - Enero 2020',
                                                            '202051' => 'Febrero - Julio 2020'
                                                            ));
                $crud->set_field_upload('reporte_SIT', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->set_rules('reporte_SIT','Reporte del SIT','max_length[26]');
                $crud->order_by('vigente','Asc');
                $crud->display_as('reporte_SIT','Reporte del SIT');
                $crud->callback_before_insert(array($this,'action_callback'));
                $crud->callback_before_update(array($this,'action_callback'));

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