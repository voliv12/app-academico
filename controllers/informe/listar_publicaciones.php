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
            $crud->set_relation('autor_principal','academico','nombre');
            $crud->set_relation('autor_correspondencia','academico','nombre');
            $crud->set_relation('cuerpo_academico','cuerpo','nombre_CA');
            $crud->set_relation_n_n('participantes', 'articulo_academico', 'academico', 'idArticulo', 'noPersonal', 'nombre','priority');
            //$crud->columns('fecha','titulo','autor','autor_principal','autor_correspondencia','nombre_revista','estatus','cuerpo_academico','tipo');
            $crud->display_as('autor','Autor(es) como aparecen en la publicación');
            $crud->field_type('total_autores','dropdown',range(1, 20));
            $crud->field_type('posicion','dropdown',range(1, 20));
            $crud->field_type('autocitas','dropdown',range(1, 50));
            $crud->field_type('citas_externas','dropdown',range(1, 50));
            $crud->unset_add()->unset_edit()->unset_delete()->unset_print();
            $crud->order_by('estatus','DESC');


            $output = $crud->render();
            $output->titulo_tabla = '<div class="alert alert-success"><h4>Artículos en total</h4></div>';
            $this->_example_output($output);
        }else
        {
            redirect('login');
        }
    }

    function libros()
    {
         if ($this->session->userdata('logged_in') == TRUE)
        {

            $crud = new grocery_CRUD();
            $crud->set_table('libro');
            $crud->set_relation('cuerpo_academico','cuerpo','nombre_CA');
            $crud->set_relation_n_n('participantes', 'libro_academico', 'academico', 'idLibro', 'noPersonal', 'nombre','priority');
            //$crud->columns('fecha','titulo','autor','participantes','cuerpo_academico','tipo');
            $crud->display_as('autor','Editor(es)');
            $crud->unset_add()->unset_edit()->unset_delete()->unset_print();
            $crud->order_by('fecha','DESC');


            $output = $crud->render();
            $output->titulo_tabla = '<div class="alert alert-success"><h4>Libros en total</h4></div>';
            $this->_example_output($output);
        }else
        {
            redirect('login');
        }
    }

    function capitulos()
    {
         if ($this->session->userdata('logged_in') == TRUE)
        {

            $crud = new grocery_CRUD();
            $crud->set_table('capitulo');
            $crud->set_relation('autor_principal','academico','nombre');
            $crud->set_relation('cuerpo_academico','cuerpo','nombre_CA');
            $crud->set_relation_n_n('participantes', 'capitulo_academico', 'academico', 'idCapitulo', 'noPersonal', 'nombre','priority');
            //$crud->columns('fecha','titulo','autor','autor_principal','autor_libro','titulo_libro','editorial','cuerpo_academico','tipo');
            $crud->display_as('autor','Autor(es) como aparecen en la publicación');
            $crud->unset_add()->unset_edit()->unset_delete()->unset_print();
            $crud->order_by('fecha','DESC');


            $output = $crud->render();
            $output->titulo_tabla = '<div class="alert alert-success"><h4>Capítulos en total</h4></div>';
            $this->_example_output($output);
        }else
        {
            redirect('login');
        }
    }

    function articulos_departamento()
    {
         if ($this->session->userdata('logged_in') == TRUE)
        {

            $crud = new grocery_CRUD();
            $crud->set_table('articulo_departamento');
            $crud->set_primary_key('idArticulo');
            $crud->set_relation('autor_correspondencia','academico','nombre');
            $crud->set_relation('autor_principal','academico','nombre');
            $crud->set_relation_n_n('participantes', 'articulo_academico', 'academico', 'idArticulo', 'noPersonal', 'nombre','priority');
            $crud->columns('idArticulo','nombre_depto','titulo','nombre_revista','autor','autor_principal','participantes','fecha');
            $crud->display_as('autor','Autor(es) como aparecen en la publicación');
            $crud->unset_add()->unset_edit()->unset_delete()->unset_print();

            $output = $crud->render();
            $output->titulo_tabla = '<div class="alert alert-success"><h4>Artículos por Departamento</h4></div>';
            $this->_example_output($output);
        }else
        {
            redirect('login');
        }
    }

    function libros_departamento()
    {
         if ($this->session->userdata('logged_in') == TRUE)
        {

            $crud = new grocery_CRUD();
            $crud->set_table('libro_departamento');
            $crud->set_primary_key('idLibro');
            $crud->set_relation_n_n('participantes', 'libro_academico', 'academico', 'idLibro', 'noPersonal', 'nombre','priority');
            $crud->columns('idLibro','nombre_depto','titulo','autor','participantes','fecha');
            $crud->unset_add()->unset_edit()->unset_delete()->unset_print();
            $output = $crud->render();
            $output->titulo_tabla = '<div class="alert alert-success"><h4>Libros por Departamento</h4></div>';
            $this->_example_output($output);
        }else
        {
            redirect('login');
        }
    }

    function capitulos_departamento()
    {
         if ($this->session->userdata('logged_in') == TRUE)
        {

            $crud = new grocery_CRUD();
            $crud->set_table('capitulo_departamento');
            $crud->set_primary_key('idCapitulo');
            $crud->set_relation('autor_principal','academico','nombre');
            $crud->set_relation_n_n('participantes', 'capitulo_academico', 'academico', 'idCapitulo', 'noPersonal', 'nombre','priority');
            $crud->columns('idCapitulo','nombre_depto','titulo','titulo_libro','editorial','autor','autor_principal','participantes','fecha');
            $crud->display_as('autor','Autor(es) como aparecen en la publicación');
            $crud->unset_add()->unset_edit()->unset_delete()->unset_print();

            $output = $crud->render();
            $output->titulo_tabla = '<div class="alert alert-success"><h4>Capítulos por Departamento</h4></div>';
            $this->_example_output($output);
        }else
        {
            redirect('login');
        }
    }

    function articulos_colaboracion()
    {
         if ($this->session->userdata('logged_in') == TRUE)
        {

            $crud = new grocery_CRUD();
            $crud->set_table('articulo_colaboracion');
            $crud->set_primary_key('idArticulo');
            $crud->set_relation('autor_correspondencia','academico','nombre');
            $crud->set_relation('autor_principal','academico','nombre');
            $crud->set_relation_n_n('participantes', 'articulo_academico', 'academico', 'idArticulo', 'noPersonal', 'nombre','priority');
            $crud->columns('idArticulo','nombre_depto','titulo','autor','autor_principal','participantes','fecha');
            $crud->display_as('autor','Autor(es) como aparecen en la publicación');
            $crud->unset_add()->unset_edit()->unset_delete()->unset_print();

            $output = $crud->render();
            $output->titulo_tabla = '<div class="alert alert-success"><h4>Colaboración entre Departamentos en Artículos</h4></div>';
            $this->_example_output($output);
        }else
        {
            redirect('login');
        }
    }

    function capitulos_colaboracion()
    {
         if ($this->session->userdata('logged_in') == TRUE)
        {

            $crud = new grocery_CRUD();
            $crud->set_table('capitulo_colaboracion');
            $crud->set_primary_key('idCapitulo');
            $crud->set_relation('autor_principal','academico','nombre');
            $crud->set_relation_n_n('participantes', 'capitulo_academico', 'academico', 'idCapitulo', 'noPersonal', 'nombre','priority');
            $crud->columns('idCapitulo','nombre_depto','titulo','autor','autor_principal','participantes','fecha');
            $crud->display_as('autor','Autor(es) como aparecen en la publicación');
            $crud->unset_add()->unset_edit()->unset_delete()->unset_print();

            $output = $crud->render();
            $output->titulo_tabla = '<div class="alert alert-success"><h4>Colaboración entre Departamentos en Capítulos</h4></div>';
            $this->_example_output($output);
        }else
        {
            redirect('login');
        }
    }

}
