<?php
Class Respaldo_bd extends CI_controller{

        function __construct()
        {
            parent::__construct();

            /* Standard Libraries */
            $this->load->database();
            $this->load->dbutil();
            $this->load->helper('download');
            /* ------------------ */
        }

        function index()
        {
             if ($this->session->userdata('logged_in') == TRUE)
            {
                $backup =& $this->dbutil->backup();
                $file = 'respaldoBD-IA-'.date("d-m-Y").'.zip';
                force_download($file, $backup);
            }else
            {
                redirect('login');
            }
        }
}
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */