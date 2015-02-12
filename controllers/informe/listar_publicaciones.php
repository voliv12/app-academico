<?php
Class Listar_publicaciones extends CI_controller{

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
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('informe_view', $datos_plantilla);

        }

        function articulos()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {

                $crud = new grocery_CRUD();
                $crud->set_table('articulo');
                $crud->set_model('gcrud_query_model');
                $crud->set_subject('Artículo');
                $crud->set_relation('autor_principal','academico','nombre');
                $crud->set_relation('autor_correspondencia','academico','nombre');
                $crud->set_relation('cuerpo_academico','cuerpo','nombre_CA');
                $crud->set_relation_n_n('participantes', 'articulo_academico', 'academico', 'idArticulo', 'noPersonal', 'nombre','priority');
                $crud->columns('fecha','titulo','autor','autor_principal','autor_correspondencia','nombre_revista','estatus','cuerpo_academico');
                $crud->display_as('autor','Autor(es)');
                $crud->unset_add()->unset_edit()->unset_delete()->unset_print();
                $crud->order_by('estatus','DESC');

                //$crud->callback_add_field('Academico_noPersonal',array($this,'add_field'));

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Artículos en total</h4></div>';
                $this->_example_output($output);
            }else
            {
                redirect('login');
            }
        }

}
