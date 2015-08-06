<?php
Class Catalogos extends CI_controller{

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
            $datos_plantilla['titulo'] = "Catálogos";
            //$output->titulo_tabla = "Información del Académico";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);
        }

        function categoria()
        {
            if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('administrar_usuarios') == "Si")
            {
                $crud = new grocery_CRUD();

                $crud->set_table('categoria');
                $crud->required_fields('nombre_categoria','perfil');

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Catálogo de Categorías</h4></div>';

                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function departamento()
        {
            if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('administrar_usuarios') == "Si")
            {
                $crud = new grocery_CRUD();

                $crud->set_table('departamento');

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Catálogo de Departamentos</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function facultad()
        {
            if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('administrar_usuarios') == "Si")
            {
                $crud = new grocery_CRUD();

                $crud->set_table('facultad');

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Catálogo de Facultades</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function posgrado()
        {
            if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('administrar_usuarios') == "Si")
            {
                $crud = new grocery_CRUD();

                $crud->set_table('posgrado');

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Catálogo de Posgrados</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function lineas()
        {
            if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('administrar_usuarios') == "Si")
            {
                $crud = new grocery_CRUD();

                $crud->set_table('lineas');

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Catálogo de Líneas de investigación</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function fuentes()
        {
            if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('administrar_usuarios') == "Si")
            {
                $crud = new grocery_CRUD();

                $crud->set_table('fuente');

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Catálogo de Fuentes de financiamiento</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function periodos()
        {
            if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('administrar_usuarios') == "Si")
            {
                $crud = new grocery_CRUD();

                $crud->set_table('cat_periodos');
                $crud->order_by('codigo','DESC');

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Catálogo de Periodos</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function bd_index()
        {
            if ($this->session->userdata('logged_in') == TRUE && $this->session->userdata('administrar_usuarios') == "Si")
            {
                $crud = new grocery_CRUD();

                $crud->set_table('bases_index');

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Catálogo de Bases de Datos index</h4></div>';
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