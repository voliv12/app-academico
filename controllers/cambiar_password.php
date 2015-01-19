<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cambiar_password extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        /* Standard Libraries */
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('encrypt');
        $this->load->library('form_validation');
        /* ------------------ */
        $this->noPersonal = $this->session->userdata('noPersonal');
    }

    function index()
    {
        $this->form_validation->set_rules('password','Contraseña','trim|required|min_length[5]|matches[passconf]');
        $this->form_validation->set_rules('passconf','Confirmar contraseña','trim|required|min_length[5]');
        if ($this->form_validation->run() == FALSE)
            {
                $datos['mensaje'] = "Contraseña muy corta (mínimo 5 carácteres) ó las contraseñas que introdujo no coinciden.";
                $datos_plantilla['contenido'] = $this->load->view('success_login', $datos, true);
                $this->load->view('plantilla_view', $datos_plantilla);
            }else
                {
                    extract($_POST);
                    $nuevo_pass = array(
                                'password' => $this->encrypt->sha1($password)
                               );
                    $this->db->where('Academico_noPersonal', $this->noPersonal);
                    $this->db->update('perfil', $nuevo_pass);

                    $datos['mensaje'] = "La contraseña ha sido cambiada con éxito.";
                    $datos_plantilla['contenido'] = $this->load->view('success_cambio_pass', $datos, true);
                    $this->load->view('plantilla_view', $datos_plantilla);
                }
    }
}
