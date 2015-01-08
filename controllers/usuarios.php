<?php
Class Usuarios extends CI_controller{

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
            $datos_plantilla['titulo'] = "Administración de Usuarios";
            $output->titulo_tabla = "Administración de Usuarios";
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);

        }

        function perfil()
        {
             if (($this->session->userdata('logged_in') == TRUE) AND ($this->session->userdata('administrar_usuarios') == "Si") )
            {
                $crud = new grocery_CRUD();

                $crud->set_table('perfil');
                $crud->set_subject('Perfil');
                $crud->set_relation('Academico_noPersonal', 'academico', 'nombre');
                $crud->change_field_type('password', 'password');
                //$crud->required_fields('nombre_catedra','nivel','programa','tipo','modalidad','periodo','estado');
                $crud->callback_before_insert(array($this,'encrypt_password_callback'));
                $crud->callback_before_update(array($this,'encrypt_password_callback'));

                $output = $crud->render();
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function academico()
        {
             if (($this->session->userdata('logged_in') == TRUE) AND ($this->session->userdata('administrar_usuarios') == "Si") )
            {
                $crud = new grocery_CRUD();

                $crud->set_table('academico');
                $crud->set_subject('Académico');
                $crud->set_relation('categoria', 'categoria', 'nombre_categoria');

                $output = $crud->render();
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function encrypt_password_callback($post_array)
        {
            $this->load->library('encrypt');

            $post_array['password'] = $this->encrypt->sha1($post_array['password']);

            return $post_array;
        }

        /*function encrypt_password_callback_2($post_array, $primary_key) {
            $this->load->library('encrypt');

            //Encrypt password only if is not empty. Else don't change the password to an empty field
            if(!empty($post_array['password']))
            {
                $post_array['password'] = $this->encrypt->encode($post_array['password'], $key);
            }
            else
            {
                unset($post_array['password']);
            }

          return $post_array;
       }*/
}
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */