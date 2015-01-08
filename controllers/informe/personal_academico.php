<?php
Class Personal_academico extends CI_controller{
        
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
    
        function index()
        {              
            if (($this->session->userdata('logged_in') == TRUE) AND ($this->session->userdata('informe') == "Si") )
            {
                $datos_plantilla['titulo'] = "Informe"; 
                $datos_plantilla['contenido'] = " "; 
                $this->load->view('informe_view', $datos_plantilla);   
            }
        }        
        
        function tipo()
        {
            $this->load->model('usuarios_model');
            $lista['listado'] = $this->usuarios_model->listar_academicos(); //Mando todo el Listado del pesonal
            $inv =  $this->usuarios_model->contar_investigadores_tc();
            $inv_mt = $this->usuarios_model->contar_investigadores_mt();
            $tecnico = $this->usuarios_model->contar_tecnicos();
            
            $total = $inv + $inv_mt + $tecnico; // Total del personal Académico
            $p_inv = $inv * 100 / $total; //saco porcentaje de Investigadores T.C.
            $p_inv_mt = $inv_mt * 100 / $total; //saco porcentaje de Investigadores M.T.
            $p_tecnico = $tecnico * 100 / $total; //saco porcentaje de Técnicos Académicos.
            $lista['inv'] = $inv;
            $lista['inv_mt'] = $inv_mt;
            $lista['tecnico'] = $tecnico;
            $lista['p_inv'] = round($p_inv);
            $lista['p_inv_mt'] = round($p_inv_mt);
            $lista['p_tecnico'] = round($p_tecnico);
            
            $datos_plantilla['titulo'] = "Tipo de personal";
            $datos_plantilla['contenido'] = $this->load->view('informe/tipo_view',$lista,TRUE);
            $this->load->view('informe_view', $datos_plantilla);                              
        }
        
        function grado()
        {
            $this->load->model('usuarios_model');
            $lista['listado'] = $this->usuarios_model->listar_academicos();
            
            $d = 0;//Doctorado
            $m = 0;//Maestría
            $e = 0;//Especialidad
            $em = 0;//Especialidad médica
            $l = 0;//Licenciatura
            $total = 0;
            $especialidad = 0;
            
            foreach ($lista['listado'] as $row)
            {   
                $total = $total + 1;
               
                    if($row['grado'] == "Doctorado")
                    {
                        $d = $d + 1;
                        $doctorado = $row['grado'];
                    }
                     if($row['grado'] == "Maestría")
                    {
                        $m = $m + 1;
                        $maestria = $row['grado'];
                    }
                     if($row['grado'] == "Especialidad")
                    {
                        $e = $e + 1;
                        $especialidad = $row['grado'];
                    }
                     if($row['grado'] == "Especialidad Médica")
                    {
                        $em = $em + 1;
                        $esp_medica = $row['grado'];
                    }
                     if($row['grado'] == "Licenciatura")
                    {
                        $l = $l + 1;
                        $licenciatura = $row['grado'];
                    }                
            }
            
            $p_d = $d * 100 / $total; //saco porcentaje de académicos con Doctorado.
            $p_m = $m * 100 / $total;
            $p_e = $e * 100 / $total;
            $p_em = $em * 100 / $total;
            $p_l = $l * 100 / $total;

            //$doctorado = "['".$doctorado."'," .round($p_d)."],";            
            $maestria = "['".$maestria."'," .round($p_m)."],";
            $especialidad .= "['".$especialidad."'," .$p_e."],";
            $esp_medica = "['".$esp_medica."'," .round($p_em)."],";
            $licenciatura = "['".$licenciatura."'," .round($p_l)."]";
            
            $lista['doctorado'] = $doctorado;
            $lista['p_d'] = round($p_d);
            $lista['maestria'] = $maestria;
            $lista['especialidad'] = $especialidad;
            $lista['esp_medica'] = $esp_medica;
            $lista['licenciatura'] = $licenciatura;
            $lista['d'] = $d;
            $lista['m'] = $m;
            $lista['em'] = $em;
            $lista['l'] = $l;
            
            $datos_plantilla['titulo'] = "Grado del personal Académico";
            $datos_plantilla['contenido'] = $this->load->view('informe/grado_view',$lista,TRUE);
            $this->load->view('informe_view', $datos_plantilla); 
        }
}
        
       
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */