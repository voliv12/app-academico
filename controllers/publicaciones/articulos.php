<?php
Class Articulos extends CI_controller{

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
            $datos_plantilla['titulo'] = "Artículos publicados";
            $output->titulo_tabla = "Divulgación - Publicaciones - Artículos";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);

        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();
                //$crud->set_relation_n_n('autor_interno', 'articulo_academico', 'academico', 'idArticulo', 'noPersonal', '{nombre}',null,array('academico.noPersonal'=>$this->noPersonal));
                $crud->set_table('articulo');
                $crud->set_relation_n_n('autor_interno', 'articulo_academico', 'academico', 'idArticulo', 'noPersonal', 'nombre');
                $crud->unset_columns('version','volumen','estatus','direccion_web');
                //$crud->display_as('Academico_noPersonal','Núm. Personal');
                $crud->set_subject('Artículo');
                $crud->required_fields('fecha','version','autor_interno','titulo','nombre_revista','tipo','estatus');
                $crud->set_rules('direccion_web','Dirección web','valid_url');
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
        }*/
}
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */