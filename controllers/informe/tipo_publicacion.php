<?php
Class Tipo_publicacion extends CI_controller{
    
    function __construct()
    {
        parent::__construct();

        /* Standard Libraries */
        $this->load->database();
        $this->load->helper('form','url');
        $this->load->library('form_validation'); 
        /* ------------------ */    
        $this->load->library('grocery_CRUD');  
        $this->noPersonal = $this->session->userdata('noPersonal');
    }                     

   
    
    function tipo()
    {                                   
        $fecha_de = $this->input->post('fecha_de');
        $fecha_hasta = $this->input->post('fecha_hasta');            
        
        $this->load->model('publicaciones_model');       
        //*******Consulto por tipo de publicación
        $art_nac = $this->publicaciones_model->tipo_publicacion("articulo", $fecha_de, $fecha_hasta, "Nacional");
        $art_int = $this->publicaciones_model->tipo_publicacion("articulo", $fecha_de, $fecha_hasta, "Internacional");
        $lib_nac = $this->publicaciones_model->tipo_publicacion("libro", $fecha_de, $fecha_hasta, "Nacional");
        $lib_int = $this->publicaciones_model->tipo_publicacion("libro", $fecha_de, $fecha_hasta, "Internacional");
        $cap_nac = $this->publicaciones_model->tipo_publicacion("capitulo", $fecha_de, $fecha_hasta, "Nacional");
        $cap_int = $this->publicaciones_model->tipo_publicacion("capitulo", $fecha_de, $fecha_hasta, "Internacional");           
             
                                  
        $total_art = $art_nac + $art_int; //Total de articulos
        $total_lib = $lib_nac + $lib_int; //Total de libros
        $total_cap = $cap_nac + $cap_int; //Total de capitulos           
        $p_art_nac = 0;
        $p_art_int = 0;
        $p_lib_nac = 0;
        $p_lib_int = 0;
        $p_cap_nac = 0;
        $p_cap_int = 0;             
    
        //Saco los porcentajes
        if($art_nac != 0){
            $p_art_nac = $art_nac * 100 / $total_art;           
        }
        if($art_int != 0){
             $p_art_int = $art_int * 100 / $total_art;
        }
        if($lib_nac != 0){
             $p_lib_nac = $lib_nac * 100 / $total_lib;
        }                  
        if($lib_int != 0){
            $p_lib_int = $lib_int * 100 / $total_lib;    
        }
        if($cap_nac != 0){
            $p_cap_nac = $cap_nac * 100 / $total_cap;    
        }
        if($cap_int != 0){
            $p_cap_int = $cap_int * 100 / $total_cap; 
        }
        
        //Invierto las fechas 
        $lista['desde'] = implode("/", array_reverse( preg_split("/\D/", $fecha_de) ) );              
        $lista['hasta'] = implode("/", array_reverse( preg_split("/\D/", $fecha_hasta) ) ); 

        //Mando los porcentajes y totales
        $lista['p_art_nac'] = round($p_art_nac,2);
        $lista['p_art_int'] = round($p_art_int,2);
        $lista['p_lib_nac'] = round($p_lib_nac,2);           
        $lista['p_lib_int'] = round($p_lib_int,2);                       
        $lista['p_cap_nac'] = round($p_cap_nac,2);
        $lista['p_cap_int'] = round($p_cap_int,2);                    
        $lista['art_nac'] = $art_nac;
        $lista['art_int'] = $art_int;
        $lista['lib_nac'] = $lib_nac;
        $lista['lib_int'] = $lib_int;
        $lista['cap_nac'] = $cap_nac;
        $lista['cap_int'] = $cap_int;            
        
        $action['action'] = "informe/tipo_publicacion/tipo";
        $lista['form_fechas'] = $this->load->view('informe/form_fechas',$action,TRUE);
        $datos_plantilla['titulo'] = "Tipo de Publicaciones";
        $datos_plantilla['contenido'] = $this->load->view('informe/tipo_publicacion_view',$lista,TRUE);
        $this->load->view('informe_view', $datos_plantilla);       
    }           
}
               
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */