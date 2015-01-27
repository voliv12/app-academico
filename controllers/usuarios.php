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
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);

        }

        function perfil($noPersonal)
        {
             if (($this->session->userdata('logged_in') == TRUE) AND ($this->session->userdata('administrar_usuarios') == "Si") )
            {
                $crud = new grocery_CRUD();
                $crud->where('Academico_noPersonal', $noPersonal);
                $crud->set_table('perfil');
                $crud->set_subject('Perfil');
                $crud->set_relation('Academico_noPersonal', 'academico', 'nombre');
                $crud->columns('Academico_noPersonal', 'informe', 'administrar_usuarios');
                $crud->field_type('Academico_noPersonal','readonly');
                $crud->display_as('Academico_noPersonal', 'Académico');
                $crud->unset_add();
                $crud->unset_edit_fields('password');
                $crud->unset_delete();
                $crud->callback_before_insert(array($this,'encrypt_password_callback'));
                $crud->callback_before_update(array($this,'encrypt_password_callback'));

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Permisos del usuario</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

        function cambiar_password($noPersonal)
        {
             if (($this->session->userdata('logged_in') == TRUE) AND ($this->session->userdata('administrar_usuarios') == "Si") )
            {
                $crud = new grocery_CRUD();
                $crud->where('Academico_noPersonal', $noPersonal);
                $crud->set_table('perfil');
                $crud->set_subject('Perfil');
                $crud->set_relation('Academico_noPersonal', 'academico', 'nombre');
                $crud->columns('Academico_noPersonal', 'password');
                $crud->field_type('Academico_noPersonal','readonly')->field_type('password','password');
                $crud->display_as('Academico_noPersonal', 'Académico');
                $crud->unset_add();
                $crud->unset_edit_fields('informe','administrar_usuarios');
                $crud->unset_delete();
                $crud->callback_before_insert(array($this,'encrypt_password_callback'));
                $crud->callback_before_update(array($this,'encrypt_password_callback'));

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Permisos del usuario</h4></div>';
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
                $crud->set_relation('departamento', 'departamento', 'nombre_depto');
                $crud->columns('noPersonal', 'nombre', 'categoria', 'grado','departamento');
                $crud->required_fields('noPersonal', 'nombre', 'categoria', 'grado', 'departamento');
                $crud->add_action('Actualizar contraseña', 'imagenes/refresh.png', 'usuarios/cambiar_password');
                $crud->add_action('Asignar permisos', 'imagenes/key.png', 'usuarios/perfil');
                $crud->callback_after_insert(array($this, 'insertar_en_perfil'));
                $crud->callback_after_insert(array($this, 'crea_directorio'));
                //$crud->unset_edit();
                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Administración de usuarios</h4></div>';
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

        function insertar_en_perfil($post_array,$primary_key)
        {
            $insert_noPersonal = array(
                "Academico_noPersonal" => $post_array['noPersonal']
            );

            $this->db->insert('perfil',$insert_noPersonal);

            return true;
        }

        function crea_directorio($post_array, $primary_key)
        {
            $this->load->helper('path');
            $dir = 'assets/uploads/academicos/'.$post_array['noPersonal'];

            if(!is_dir($dir))
            {
              mkdir($dir, 0777);
            }else
            {
              echo "Error: El Directorio ya existe.";
            }

            return TRUE;
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