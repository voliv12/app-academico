<?php
Class Ponencias extends CI_controller{
        
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
            $datos_plantilla['titulo'] = "Ponencias en congreso"; 
            $output->titulo_tabla = "Divulgación - Ponencias";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);
               
        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();
               
                $crud->set_table('ponencia');
                $crud->set_relation_n_n('autor_interno', 'ponencia_academico', 'academico', 'idPonencia', 'noPersonal', 'nombre');               
                $crud->set_subject('Ponencia');
                $crud->required_fields('autor_interno','nombre_ponencia','evento','lugar','fecha');                              
                $crud->set_field_upload('documento', 'assets/uploads/files');
                $crud->order_by('fecha','Desc');                               
                               
                $output = $crud->render();
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