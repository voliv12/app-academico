<?php

class Docencia_model extends CI_Model
{
        
    function __construct()
    {
        parent :: __construct();
        $this->load->database();
    }
         
    function contar_tutorias($noPersonal, $nivel)
    {                
        $this->db->select('idtutoria');
        $this->db->from('tutoria');
        $this->db->where('estado','En proceso');
        $this->db->where('nivel', $nivel);        
        $this->db->where('Academico_noPersonal', $noPersonal);
        return $this->db->count_all_results();                    
     }
    
    function contar_catedra($noPersonal, $tipo, $estado, $nivel)
    {                
        $this->db->select('idClases');
        $this->db->from('catedra');
        $this->db->where('tipo', $tipo);
        $this->db->where('estado', $estado);
        $this->db->where('nivel', $nivel);
        $this->db->where('Academico_noPersonal', $noPersonal);
        return $this->db->count_all_results();                    
     }

    function contar_tesis($noPersonal, $fecha_de, $fecha_hasta, $intervencion, $nivel)
    {                
        $this->db->select('idtesis');
        $this->db->from('tesis');
        $where = "fecha_presentacion BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        $this->db->where('intervencion', $intervencion);
        $this->db->where('nivel', $nivel);
        $this->db->where('Academico_noPersonal', $noPersonal);
        return $this->db->count_all_results();        
     } 

     function catedra_por_academico($noPersonal)
     {
        $this->db->select('*');
        $this->db->from('catedra');                
        $this->db->where('Academico_noPersonal', $noPersonal);
        $query = $this->db->get(); 
        return $query->result_array();   
     }             
}
