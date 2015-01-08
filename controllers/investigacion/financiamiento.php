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
            $output->titulo_tabla = "Investigación - Financiamiento";
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
                $crud->display_as('Proyecto_idProyecto','Proyecto');                
                $crud->display_as('Fuente_idFuente','Fuente');                
                $crud->set_subject('Financiamiento');
                $crud->required_fields('Proyecto_idProyecto','Fuente_idFuente','Periodo','Estado','Monto');                             
                $crud->set_rules('Monto','Monto','required|numeric');
                $crud->set_relation('Proyecto_idProyecto','proyecto','Titulo');
                $crud->set_relation('Fuente_idFuente','fuente','Fuente');
                
                $crud->set_field_upload('documento', 'assets/uploads/files');
                $crud->order_by('Estado','Asc');
                
                $crud->callback_add_field('Academico_noPersonal',array($this,'add_field'));
                //$crud->callback_add_field('programa',array($this,'add_field_programa'));
                //$crud->callback_insert(array($this,'limpia_fecha'));
                               
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
}
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */