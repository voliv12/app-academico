<?php
Class Institucional extends CI_controller{

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
            $datos_plantilla['titulo'] = "Institucional";
            $datos_plantilla['contenido'] = $this->load->view('outputInstitucional_view.php',$output, TRUE);
            $this->load->view('informe_view', $datos_plantilla);
        }

        function alianzas()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();
                $crud->set_table('alianza');
                $crud->display_as('institucion','Con');
                $crud->set_relation('Academico_noPersonal','academico','nombre');
                $crud->display_as('Academico_noPersonal','Nombre de Académico');
                $crud->display_as('Proyecto_idProyecto','Del proyecto');
                $crud->set_subject('Vinculación');
                $crud->set_relation('Proyecto_idProyecto','proyecto','Titulo');
                $crud->set_field_upload('documento', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->order_by('estado','Asc');
                $crud->unset_columns('descripcion');
                $crud->unset_print();
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
                //$crud->unset_read();
                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Vinculación</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function eventos()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();
                $crud->set_table('evento');
                $crud->set_relation_n_n('organizadores', 'evento_academico', 'academico', 'idEvento', 'noPersonal', 'nombre');
                $crud->set_subject('Evento Académico');
                $crud->set_field_upload('documento', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->unset_print();
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
                //$crud->unset_read();
                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Eventos académicos organizados</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }


        function reconocimientos()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();
                $crud->set_table('reconocimiento');
                $crud->set_subject('Reconocimiento');
                $crud->set_relation('Academico_noPersonal','academico','nombre');
                $crud->display_as('Academico_noPersonal','Nombre de Académico');
                $crud->unset_print();
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
                $crud->unset_read();
                $crud->set_field_upload('documento', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->order_by('fecha','Desc');
                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Reconocimientos</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }
}