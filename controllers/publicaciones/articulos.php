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
            $datos_plantilla['contenido'] = $this->load->view('output_view.php',$output, TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);

        }

        function control()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $this->load->model('publicaciones_model');
                $total_pub    = $this->publicaciones_model->contar_publicaciones_academico($this->noPersonal);
                $sin_publicar = $this->publicaciones_model->estatus_publicacion($this->noPersonal);
                $msj = Null;
                if($sin_publicar != 0)
                {
                    $msj = $total_pub." artículos en total. Tiene ".$sin_publicar." artículos que no han sido Publicados, por favor verique y actualice su Estatus si es necesario.";
                }else{
                    $msj = $total_pub." artículos Publicados en total.";
                }

                $crud = new grocery_CRUD();
                $crud->set_table('articulo');
                $crud->set_model('gcrud_query_model');
                $crud->set_subject('Artículo');

                $crud->set_relation_n_n('participantes', 'articulo_academico', 'academico', 'idArticulo', 'noPersonal', 'nombre','priority');
                //########Para filtrar los resultados
                $crud->basic_model->set_join_str("articulo_academico", "articulo.idArticulo=articulo_academico.idArticulo");
                $where_array = array("articulo_academico.noPersonal" => $this->noPersonal);
                $crud->basic_model->set_where_str($where_array);
                //########################*/
                $crud->columns('fecha','titulo','autor','nombre_revista','estatus');
                $crud->required_fields('fecha','version','participantes','autor','titulo','nombre_revista','tipo','estatus');
                $crud->set_relation('cuerpo_academico','cuerpo','nombre_CA');
                $crud->set_rules('direccion_web','Dirección web','valid_url');
                $crud->set_field_upload('documento', 'assets/uploads/files');
                $crud->order_by('estatus','DESC');

                //$crud->callback_add_field('Academico_noPersonal',array($this,'add_field'));

                $output = $crud->render();
                $output->titulo_tabla = '<div class="alert alert-success"><h4>Artículos</h4></div>'.$msj;
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
