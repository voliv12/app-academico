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
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);
        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $this->load->model('publicaciones_model');
                $total_lib    = $this->publicaciones_model->contar_libros_academico("idLibro","libro_academico",$this->noPersonal);
                $msj = "<b>".$total_lib."</b> libro(s) Publicados en total.";

                $crud = new grocery_CRUD();

                $crud->set_table('libro');
                $crud->set_model('gcrud_query_model');
                $crud->set_relation_n_n('participantes', 'libro_academico', 'academico', 'idLibro', 'noPersonal', 'nombre', 'priority');
                $crud->basic_model->set_join_str("libro_academico", "libro.idLibro=libro_academico.idLibro");
                $where_array = array("libro_academico.noPersonal" => $this->noPersonal);
                $crud->basic_model->set_where_str($where_array);

                $crud->columns('fecha','titulo','autor','tipo');
                //$crud->display_as('Academico_noPersonal','Núm. Personal');
                $crud->set_subject('Libro');
                $crud->required_fields('fecha','participantes','autor','titulo','editorial','tipo','lugar_publicacion');
                $crud->display_as('participantes','Participantes internos')->display_as('autor','Editor(es)');
                $crud->unset_texteditor('autor','full_text');
                $crud->set_relation('cuerpo_academico','cuerpo','nombre_CA');
                $crud->set_field_upload('documento', 'assets/uploads/academicos/'.$this->noPersonal);
                $crud->order_by('fecha','Desc');

                //$crud->callback_add_field('Academico_noPersonal',array($this,'add_field'));

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Libros</h4></div>'.$msj;
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