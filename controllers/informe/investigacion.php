<?php
Class Investigacion extends CI_controller{

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
            $datos_plantilla['titulo'] = "Investigación";
            $datos_plantilla['contenido'] = $this->load->view('outputInvestigacion_view.php',$output, TRUE);
            $this->load->view('informe_view', $datos_plantilla);
        }

        function cuerpos()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $this->load->model('investigacion_model');
                $result = $this->investigacion_model->buscar_en_CA($this->noPersonal, "cuerpo_academico");

                $crud = new grocery_CRUD();
                $crud->set_table('cuerpo');
                $crud->set_relation_n_n('integrantes_internos', 'cuerpo_academico', 'academico', 'idCuerpo', 'noPersonal', 'nombre','priority');
                $crud->set_relation_n_n('colaboradores_internos', 'cuerpo_academico_col', 'academico', 'idCuerpo', 'noPersonal', 'nombre','priority');
                $crud->unset_print();
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
                $crud->columns('clave','nombre_CA','representante','LGAC');
                $crud->set_subject('Cuerpo Académico');
                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Cuerpos Académicos</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            } 
        }


        function donaciones()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();
                $crud->set_table('donacion');
                $crud->unset_print();
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
                $crud->set_subject('Donación');
                $crud->set_rules('monto','Monto','numeric');
                $crud->order_by('fecha_donacion','Desc');
                $crud->set_relation('Academico_noPersonal','academico','nombre');
                $crud->display_as('Academico_noPersonal','Nombre de Académico');
                $crud->columns('destino','tipo','donante','monto','cantidad','descripcion');
                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Donaciones</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }


        function financiamiento()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();
                $crud->set_table('financiamiento');
                $crud->set_relation('Academico_noPersonal','academico','nombre');
                $crud->display_as('Academico_noPersonal','Nombre de Académico');
                $crud->display_as('Proyecto_idProyecto','Proyecto')->display_as('Cuerpo_idCuerpo','Cuerpo Académico')->display_as('Posgrado_idPosgrado','Posgrado');
                $crud->display_as('Fuente_idFuente','Fuente');
                $crud->set_subject('Financiamiento');
                $crud->set_relation('Fuente_idFuente','fuente','Fuente');
                $crud->set_relation('Proyecto_idProyecto','proyecto','Titulo');
                $crud->set_relation('Cuerpo_idCuerpo','cuerpo','nombre_CA');
                $crud->set_relation('Posgrado_idPosgrado','posgrado','nombre_posgrado');
                $crud->columns('Destino','Fuente_idFuente','Otra_fuente','Monto');
                $crud->order_by('Estado','Asc');
                $crud->unset_print();
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Financiamiento</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }




        function proyectos()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();
                $crud->set_table('proyecto');
                $crud->set_relation('Academico_noPersonal','academico','nombre');
                $crud->display_as('Academico_noPersonal','Nombre de Académico');
                $crud->display_as('Lineas_idLineas','Linea investigacion')->display_as('Registro_DGI','Fecha registro DGI')->display_as('productos','Productos comprometidos ante la DGI');
                $crud->set_subject('Proyecto');
                $crud->set_relation('Lineas_idLineas','lineas','Lineas_investigacion');
                $crud->unset_columns('Observaciones');
                $crud->unset_print();
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
                
                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Proyectos</h4></div>';
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