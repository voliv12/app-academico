<?php
Class Alianzas extends CI_controller{
        
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
            $datos_plantilla['titulo'] = "Vínculación"; 
            $output->titulo_tabla = "Institucional - Vínculación";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);
               
        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();

                $crud->where('alianza.Academico_noPersonal',$this->noPersonal);
                $crud->set_table('alianza');
                $crud->unset_columns('Academico_noPersonal');
                $crud->display_as('Academico_noPersonal','Núm. Personal');                
                $crud->display_as('institucion','Con');                                                                                                                    
                $crud->display_as('Proyecto_idProyecto','Del proyecto');                                                                                                                    
                $crud->set_subject('Alianza');
                $crud->required_fields('institucion','descripcion','tipo','estado');                                             
                $crud->set_relation('Proyecto_idProyecto','proyecto','Titulo');

                $crud->set_field_upload('documento', 'assets/uploads/files');
                $crud->order_by('estado','Asc');
                
                $crud->callback_add_field('Academico_noPersonal',array($this,'add_field'));
                $crud->callback_add_field('institucion',array($this,'add_field_institucion'));
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
        
        function add_field_institucion()
        {
            return '<input type="text" maxlength="50" value="" name="institucion"> (CA, IES, IS, etc.)';
        }      
}
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */