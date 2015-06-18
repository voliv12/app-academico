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
            $crud->set_relation('facultad','facultad','nombre_facultad');
            $crud->set_relation('posgrado','posgrado','nombre_posgrado');
            $crud->field_type('Academico_noPersonal', 'hidden', $this->noPersonal);
            $crud->set_relation('periodo','cat_periodos','descripcion');
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