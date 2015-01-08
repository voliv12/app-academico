<?php
Class Proyectos extends CI_controller{
        
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
            $datos_plantilla['titulo'] = "Proyectos"; 
            $output->titulo_tabla = "Investigación - Proyectos";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);
               
        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();

                $crud->where('Academico_noPersonal',$this->noPersonal);
                $crud->set_table('proyecto');
                $crud->unset_columns('Academico_noPersonal');
                $crud->display_as('Academico_noPersonal','Núm. Personal');
                $crud->display_as('Lineas_idLineas','Linea investigacion');
                $crud->set_subject('Proyecto');
                $crud->required_fields('Titulo','Lineas_idLineas','Registro_DGI','Estado');                             
                $crud->set_relation('Lineas_idLineas','lineas','Lineas_investigacion');             
                                
                $crud->set_field_upload('documento', 'assets/uploads/files');
                $crud->order_by('Estado','Asc');
                
                $crud->callback_add_field('Academico_noPersonal',array($this,'add_field'));
                $crud->callback_add_field('productos',array($this,'add_field_productos'));
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
        
        function add_field_productos()
        {
            return '<input type="text" maxlength="50" value=" " name="productos"> (Productos comprometidos ante la DGI)';
        }         
}
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */