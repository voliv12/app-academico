<?php
Class Ayuda extends CI_controller{

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

        function index()
        {
            $datos_plantilla['titulo'] = "Ayuda";
            //$output->titulo_tabla = "Ayuda";
            $datos_plantilla['contenido'] = $this->load->view('ayuda_view.php', null , TRUE);
            $this->load->view('plantilla_view', $datos_plantilla);

        }

}
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */