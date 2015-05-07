<?php
Class Docencia extends CI_controller{

        function __construct()
        {
            parent::__construct();

            /* Standard Libraries */
            $this->load->database();
            $this->load->helper('form','url');
            $this->load->library('form_validation');
            $this->load->library('grocery_CRUD');
            /* ------------------ */
            $this->noPersonal = $this->session->userdata('noPersonal');
        }

        function _example_output($output = null)
        {
            $datos_plantilla['titulo'] = "Docencia";
            $datos_plantilla['contenido'] = $this->load->view('outputDocencia_view.php',$output, TRUE);
            $this->load->view('informe_view', $datos_plantilla);
        }

        function catedra()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();
                $crud->set_table('catedra');

                $crud->set_subject('Cátedra');
                $crud->order_by('estado','Asc');
                $crud->set_field_upload('documento', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->set_relation('Academico_noPersonal','academico','nombre');
                $crud->display_as('Academico_noPersonal','Nombre de Académico');
                $crud->unset_print();
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();
                $crud->unset_read();
                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Cátedra</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }


        function servicio()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();
                $crud->set_table('servicio_social');
                $crud->set_subject('Servicio Social');
                $crud->display_as('area_instituto','Area donde realiza el servicio');
                $crud->set_relation('Academico_noPersonal','academico','nombre');
                $crud->display_as('Academico_noPersonal','Nombre de Académico');
                $crud->order_by('fecha_inicio','Desc');

                $crud->unset_print();
                $crud->unset_read();
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Servicio Social</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function tesis()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();


                $crud->set_table('tesis');
                $crud->set_subject('Tesis');
                $crud->display_as('intervencion','Intervención')->display_as('titulo_tesis','Título tesis')->display_as('fecha_presentacion','Fecha presentación');
                $crud->set_relation('Academico_noPersonal','academico','nombre');
                $crud->display_as('Academico_noPersonal','Nombre de Académico');
                $crud->set_field_upload('documento', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->order_by('fecha_presentacion','Desc');
                $crud->unset_print();
                $crud->unset_read();
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();


                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Dirección de tesis</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }


         function tutorias_sit()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $crud = new grocery_CRUD();


                $crud->set_table('tutoria_sit');
                $crud->set_subject('Tutoria');
                $crud->set_relation('facultad','facultad','nombre_facultad');
                $crud->set_relation('posgrado','posgrado','nombre_posgrado');
                $crud->set_relation('Academico_noPersonal','academico','nombre');
                $crud->display_as('Academico_noPersonal','Nombre de Académico');
                $crud->field_type('total_alumnos', 'dropdown', range(1,40));
                $crud->set_field_upload('reporte_SIT', 'assets/uploads/academicos/');
                //$crud->order_by('vigente','Asc');
                $crud->display_as('reporte_SIT','Reporte del SIT');
                $crud->unset_print();
                $crud->unset_read();
                $crud->unset_add();
                $crud->unset_edit();
                $crud->unset_delete();

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Tutorías</h4></div>';
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