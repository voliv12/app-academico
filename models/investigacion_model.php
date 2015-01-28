<?php

class Investigacion_model extends CI_Model
{
    function __construct()
    {
        parent :: __construct();
        $this->load->database();
    }

    function buscar_en_CA($noPersonal, $tabla)
    {
        $this->db->select('noPersonal');
        $this->db->from($tabla);
        $this->db->where('noPersonal', $noPersonal);
        $query = $this->db->get();
        return $query->num_rows();
    }

}
