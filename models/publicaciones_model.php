<?php

class Publicaciones_model extends CI_Model
{
    function __construct()
    {
        parent :: __construct();
        $this->load->database();
    }

    function total_publicaciones($tabla, $fecha_de, $fecha_hasta)
    {
        $this->db->select('*');
        $this->db->from($tabla);
        $where = "fecha BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        return $this->db->count_all_results();
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

    function tipo_participacion($tabla, $fecha_de, $fecha_hasta, $tipo_autor)
    {
        $this->db->select('*');
        $this->db->from($tabla);
        $where = "fecha BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        $this->db->where($tipo_autor." <>", 0);
        return $this->db->count_all_results();
    }

    function tipo_participacion_col($tabla, $fecha_de, $fecha_hasta) //como colaborador
    {
        $this->db->select('*');
        $this->db->from($tabla);
        $where = "fecha BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        $this->db->where("autor_principal =", 0);
        $this->db->where("autor_correspondencia =", 0);
        return $this->db->count_all_results();
    }

    function tipo_participacion_col_cap($tabla, $fecha_de, $fecha_hasta) //como colaborador en capitulos
    {
        $this->db->select('*');
        $this->db->from($tabla);
        $where = "fecha BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        $this->db->where("autor_principal =", 0);
        return $this->db->count_all_results();
    }

    function cuerpo_academico($tabla, $fecha_de, $fecha_hasta) //por cuerpo academico
    {
        $this->db->select('nombre_CA, count( * ) AS total, count( * ) *100 / (SELECT count( * ) FROM '.$tabla.' ) AS porcentaje');
        $this->db->from($tabla);
        $this->db->join('cuerpo',$tabla.'.cuerpo_academico = cuerpo.idCuerpo');
        $where = "fecha BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        $this->db->where("cuerpo_academico IS NOT NULL");
        $this->db->where("cuerpo_academico <>", '');
        $this->db->group_by('cuerpo_academico');
        $query = $this->db->get();
        return $query->result_array();
    }

    function produccion_departamento($tabla1,$tabla2,$id_tabla,$fecha_de,$fecha_hasta,$tipo,$total,$porcentaje) //producción por departamento
    {
        $select = 'nombre_depto, count( DISTINCT ('.$tabla1.'.'.$id_tabla.') ) AS '.$total.', count( DISTINCT ('.$tabla1.'.'.$id_tabla.') ) *100 / ( SELECT count( DISTINCT ('.$tabla1.'.'.$id_tabla.') ) FROM '.$tabla1.' ) AS '.$porcentaje.'';
        $this->db->select($select);
        $this->db->from($tabla1);
        $this->db->join($tabla2, $tabla2.'.'.$id_tabla.' = '.$tabla1.'.'.$id_tabla.'');
        $this->db->join('academico',$tabla1.'.noPersonal = academico.noPersonal');
        $this->db->join('departamento','academico.departamento = departamento.idDepartamento');
        $where = "fecha BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        $this->db->where($tabla2.'.tipo',$tipo);
        $this->db->group_by('nombre_depto');
        $query = $this->db->get();
        return $query->result_array();
    }

    function articulos_departamento($depto, $fecha_de, $fecha_hasta, $tipo)
    {
        $this->db->select('articulo_academico.idArticulo');
        $this->db->distinct();
        $this->db->from('articulo_academico');
        $this->db->join('articulo','articulo.idArticulo = articulo_academico.idArticulo');
        $this->db->join('academico','academico.noPersonal = articulo_academico.noPersonal');
        $this->db->join('departamento','academico.departamento = departamento.idDepartamento');
        $where = "articulo.fecha BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        $this->db->where('articulo.tipo',$tipo);
        $this->db->where('departamento.nombre_depto', $depto);
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
        $this->db->join('departamento','academico.departamento = departamento.idDepartamento');
        $where = "libro.fecha BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        $this->db->where('libro.tipo',$tipo);
        $this->db->where('departamento.nombre_depto', $depto);
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
        $this->db->join('departamento','academico.departamento = departamento.idDepartamento');
        $where = "capitulo.fecha BETWEEN '".$fecha_de."' AND '".$fecha_hasta."'";
        $this->db->where($where);
        $this->db->where('capitulo.tipo',$tipo);
        $this->db->where('departamento.nombre_depto', $depto);
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

     function contar_publicaciones_academico($noPersonal) //Articulos por academico
    {
        $this->db->select('estatus');
        $this->db->from('articulo');
        $this->db->join('articulo_academico', 'articulo.idArticulo = articulo_academico.idArticulo');
        $this->db->join('academico', 'academico.noPersonal = articulo_academico.noPersonal');
        $this->db->where('articulo_academico.noPersonal', $noPersonal);
        return $this->db->count_all_results();
    }

    function contar_libros_academico($campo,$tabla,$noPersonal) //Libros y Capitulos por academico
    {
        $this->db->select($campo);
        $this->db->from($tabla);
        $this->db->where('noPersonal', $noPersonal);
        return $this->db->count_all_results();
    }

    function lista_departamentos()
    {
        $this->db->select('nombre_depto');
        $this->db->from('departamento');
        $this->db->order_by('nombre_depto', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
     }
}
