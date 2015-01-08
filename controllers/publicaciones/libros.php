<?php
Class Libros extends CI_controller{
        
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
            $datos_plantilla['titulo'] = "Libros publicados"; 
            $output->titulo_tabla = "Divulgación - Publicaciones - Libros";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);
               
        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();
                
                $crud->set_table('libro');
                $crud->set_relation_n_n('autor_interno', 'libro_academico', 'academico', 'idLibro', 'noPersonal', 'nombre');
                //$crud->unset_columns('Academico_noPersonal');
                //$crud->display_as('Academico_noPersonal','Núm. Personal');
                $crud->set_subject('Libro');
                $crud->required_fields('fecha','autor_interno','titulo','editorial','tipo','lugar_publicacion');                             
                $crud->set_field_upload('documento', 'assets/uploads/files');
                $crud->order_by('fecha','Desc');
                
                //$crud->callback_add_field('Academico_noPersonal',array($this,'add_field'));
                               
                $output = $crud->render();
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }
        
        /*function add_field()
        {
            return '<input type="text" maxlength="50" value="'.$this->noPersonal.'" name="Academico_noPersonal" readonly>';
        }   */                                     
}
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */