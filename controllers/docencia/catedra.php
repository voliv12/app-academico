<?php
Class Catedra extends CI_controller{

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
        $datos_plantilla['titulo'] = "Cátedra impartida";
        $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
        $this->load->view('plantilla_view', $datos_plantilla);
    }

    function control()
    {
         if ($this->session->userdata('logged_in') == TRUE)
        {
            $crud = new grocery_CRUD();

            $crud->where('Academico_noPersonal',$this->noPersonal);
            $crud->set_table('catedra');
            $crud->unset_columns('Academico_noPersonal', 'estado');
            $crud->unset_fields('estado');
            $crud->display_as('Academico_noPersonal','Núm. Personal');
            $crud->set_subject('Cátedra');
            $crud->required_fields('nombre_catedra','nivel','programa','tipo','modalidad','periodo');

            $crud->field_type('Academico_noPersonal', 'hidden', $this->noPersonal);
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
            $crud->set_field_upload('documento', 'assets/uploads/academicos/'.$this->noPersonal);
            $crud->set_rules('documento','Documento','max_length[26]');
            $crud->callback_add_field('programa',array($this,'add_field_programa'));

            $output = $crud->render();
            $output->titulo_tabla = '<div class="alert alert-success"><h4>Cátedra</h4></div>';
            $this->_example_output($output);
        }else
        {
            redirect('login');
        }
    }

    function add_field_programa()
    {
        return '<input type="text" maxlength="100" name="programa"> (Nombre de la carrera o posgrado)';
    }
}
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */