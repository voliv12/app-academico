<?php

class Publicaciones_model extends CI_Model
{
    function __construct()
    {
        parent :: __construct();
        $this->load->database();
    }

    function listar_publicaciones($tabla, $fecha_de, $fecha_hasta)
    {
        $this->db->select('*');
        $this->db->from($tabla);
        $where = "fecha BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }

    function contar_publicaciones($tabla, $fecha_de, $fecha_hasta, $tipo)
    {
        $this->db->select('*');
        $this->db->from($tabla);
        $where = "fecha BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        $this->db->where('tipo',$tipo);
        return $this->db->count_all_results();
    }

    function articulos_departamento($depto, $fecha_de, $fecha_hasta, $tipo)
    {
        $this->db->select('articulo_academico.idArticulo');
        $this->db->distinct();
        $this->db->from('articulo_academico');
        $this->db->join('articulo','articulo.idArticulo = articulo_academico.idArticulo');
        $this->db->join('academico','academico.noPersonal = articulo_academico.noPersonal');
        $where = "articulo.fecha BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        $this->db->where('articulo.tipo',$tipo);
        $this->db->where('academico.departamento', $depto);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function libros_departamento($depto, $fecha_de, $fecha_hasta, $tipo)
    {
        $this->db->select('libro_academico.idLibro');
        $this->db->distinct();
        $this->db->from('libro_academico');
        $this->db->join('libro','libro.idLibro = libro_academico.idLibro');
        $this->db->join('academico','academico.noPersonal = libro_academico.noPersonal');
        $where = "libro.fecha BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        $this->db->where('libro.tipo',$tipo);
        $this->db->where('academico.departamento', $depto);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function capitulos_departamento($depto, $fecha_de, $fecha_hasta, $tipo)
    {
        $this->db->select('capitulo_academico.idCapitulo');
        $this->db->distinct();
        $this->db->from('capitulo_academico');
        $this->db->join('capitulo','capitulo.idCapitulo = capitulo_academico.idCapitulo');
        $this->db->join('academico','academico.noPersonal = capitulo_academico.noPersonal');
        $where = "capitulo.fecha BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        $this->db->where('capitulo.tipo',$tipo);
        $this->db->where('academico.departamento', $depto);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function tipo_publicacion($tabla, $fecha_de, $fecha_hasta, $tipo)
    {
        $this->db->select('*');
        $this->db->from($tabla);
        $where = "fecha BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        $this->db->where('tipo', $tipo);
        return $this->db->count_all_results();
    }

    function listar_ponencias($fecha_de, $fecha_hasta)
    {
        $this->db->select('ponencia_academico.idPonencia, ponencia.nombre_ponencia, ponencia.evento, ponencia.fecha, academico.nombre');
        $this->db->distinct();
        $this->db->from('ponencia_academico');
        $this->db->join('ponencia', 'ponencia_academico.idPonencia = ponencia.idPonencia');
        $this->db->join('academico', 'academico.noPersonal = ponencia_academico.noPersonal');
        $where = "fecha BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        $this->db->order_by('ponencia.fecha', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    function estatus_publicacion($noPersonal)
    {
        $this->db->select('estatus');
        $this->db->from('articulo');
        $this->db->join('articulo_academico', 'articulo.idArticulo = articulo_academico.idArticulo');
        $this->db->join('academico', 'academico.noPersonal = articulo_academico.noPersonal');
        $this->db->where('estatus <>','Publicado');
        $this->db->where('articulo_academico.noPersonal', $noPersonal);
        return $this->db->count_all_results();
    }

     function contar_publicaciones_academico($noPersonal)
    {
        $this->db->select('estatus');
        $this->db->from('articulo');
        $this->db->join('articulo_academico', 'articulo.idArticulo = articulo_academico.idArticulo');
        $this->db->join('academico', 'academico.noPersonal = articulo_academico.noPersonal');
        $this->db->where('articulo_academico.noPersonal', $noPersonal);
        return $this->db->count_all_results();
    }

    /*function ponencia_academico($idPonencia)
    {
        $this->db->select('academico.nombre');
        $this->db->from('academico');
        $this->db->join('ponencia_academico', 'ponencia_academico.noPersonal = academico.noPersonal');
        $this->db->where('ponencia_academico.idPonencia', $idPonencia);
        //$this->db->where('academico.noPersonal', $noPersonal);
        //$this->db->order_by('ponencia.fecha', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }  */
}
