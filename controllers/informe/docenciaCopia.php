<?php
Class Docencia extends CI_controller{
        
    function __construct()
    {
        parent::__construct();

        /* Standard Libraries */
        $this->load->database();
        $this->load->helper('form','url');
        $this->load->library('form_validation'); 
        /* ------------------ */                  
        $this->noPersonal = $this->session->userdata('noPersonal');
    }

    function index()
    {
        $tesis['tesis'][] = array(                                               
                                'nombre'  => null,
                                'tsu'     => 0,
                                'lic'     => 0,
                                'esp'     => 0,
                                'mae'     => 0, 
                                'doc'     => 0          
                                );
        $tesis['t_tsu'] = 0;
        $tesis['t_lic'] = 0;
        $tesis['t_esp'] = 0;            
        $tesis['t_mae'] = 0;
        $tesis['t_doc'] = 0;
        $tesis['intervencion'] = NULL;            
        $tesis['periodo'] = NULL;       
        $datos_plantilla['titulo'] = "Informe";                                 
        $datos_plantilla['contenido'] = $this->load->view('informe/tesis_view', $tesis, TRUE);
        $this->load->view('informe_view', $datos_plantilla);        
    }                  
        
    function resumen_tutorias()
    {              
        if (($this->session->userdata('logged_in') == TRUE) AND ($this->session->userdata('informe') == "Si") )
        {                                            
            $this->load->model('usuarios_model');
            $lista['listado'] = $this->usuarios_model->listar_academicos();
            $this->load->model('docencia_model');
            $tsu = 0;
            $lic = 0;
            $mae = 0;
            $doc = 0;           
            $t_tsu = 0;
            $t_lic = 0;
            $t_mae = 0;
            $t_doc = 0; 
            foreach ($lista['listado'] as $row)
            {                    
                $tsu = $this->docencia_model->contar_tutorias($row['noPersonal'], "TSU");
                $lic = $this->docencia_model->contar_tutorias($row['noPersonal'], "Licenciatura");
                $mae = $this->docencia_model->contar_tutorias($row['noPersonal'], "Maestría");
                $doc = $this->docencia_model->contar_tutorias($row['noPersonal'], "Doctorado");                                 
                                   
                $tutorias['tutorias'][] = array(
                                                'academico' => array(
                                                                        'nombre' => $row['nombre'],
                                                                        'tsu'    => $tsu,
                                                                        'lic'    => $lic,
                                                                        'mae'    => $mae,
                                                                        'doc'    => $doc  
                                                                    )
                                                );
                $t_tsu = $t_tsu + $tsu; //voy sumando los totales
                $t_lic = $t_lic + $lic;
                $t_mae = $t_mae + $mae;
                $t_doc = $t_doc + $doc;                                           
            }                             
            
            $tutorias['t_tsu'] = $t_tsu;
            $tutorias['t_lic'] = $t_lic;
            $tutorias['t_mae'] = $t_mae;
            $tutorias['t_doc'] = $t_doc;
            //print_r($tutorias);                                                                       
            $datos_plantilla['titulo'] = "Informe"; 
            $datos_plantilla['contenido'] = $this->load->view('informe/tutorias_view',$tutorias,TRUE);
            $this->load->view('informe_view', $datos_plantilla);
       }
    }

    function resumen_catedra()
    {              
        if (($this->session->userdata('logged_in') == TRUE) AND ($this->session->userdata('informe') == "Si") )
        {                                            
            $nivel = $this->input->post('nivel');
            $this->load->model('usuarios_model');
            $lista['listado'] = $this->usuarios_model->listar_academicos();
            $this->load->model('docencia_model');
            $afel = 0;
            $disc = 0;
            $opta = 0;
            $doc = 0;           
            $t_afel = 0;
            $t_disc = 0;
            $t_opta = 0;   

            foreach ($lista['listado'] as $row)
            {                    
                $afel = $this->docencia_model->contar_catedra($row['noPersonal'], "AFEL", "Activo", $nivel);
                $disc = $this->docencia_model->contar_catedra($row['noPersonal'], "Disciplinar", "Activo", $nivel);
                $opta = $this->docencia_model->contar_catedra($row['noPersonal'], "Optativa", "Activo", $nivel);                                               
                                   
                $catedra['catedra'][] = array(                                                
                                            'nombre'  => $row['nombre'],
                                            'noPersonal' => $row['noPersonal'],
                                            'afel'    => $afel,
                                            'disc'    => $disc,
                                            'opta'    => $opta                                                                
                                            );
                $t_afel = $t_afel + $afel; //voy sumando los totales
                $t_disc = $t_disc + $disc;
                $t_opta = $t_opta + $opta;
                                                          
            }                             
            
            $catedra['t_afel'] = $t_afel;
            $catedra['t_disc'] = $t_disc;
            $catedra['t_opta'] = $t_opta;
            $catedra['nivel']  = $nivel;                            
            //print_r($catedra);                                                                       
            $datos_plantilla['titulo'] = "Informe"; 
            $datos_plantilla['contenido'] = $this->load->view('informe/catedra_view',$catedra,TRUE);
            $this->load->view('informe_view', $datos_plantilla);
       }
    }

    function resumen_tesis()
    {              
        if (($this->session->userdata('logged_in') == TRUE) AND ($this->session->userdata('informe') == "Si") )
        {                                            
            $fecha_de = $this->input->post('fecha_de');
            $fecha_hasta = $this->input->post('fecha_hasta');
            $intervencion = $this->input->post('intervencion');

            $this->load->model('usuarios_model');
            $lista['listado'] = $this->usuarios_model->listar_academicos();
            $this->load->model('docencia_model');
            $tsu = 0;
            $lic = 0;
            $esp = 0;
            $mae = 0;
            $doc = 0;           
            $t_tsu = 0;
            $t_lic = 0;
            $t_esp = 0;   
            $t_mae = 0;   
            $t_doc = 0;   

            foreach ($lista['listado'] as $row)
            {                    
                $tsu = $this->docencia_model->contar_tesis($row['noPersonal'], $fecha_de, $fecha_hasta, $intervencion, "TSU");
                $lic = $this->docencia_model->contar_tesis($row['noPersonal'], $fecha_de, $fecha_hasta, $intervencion, "Licenciatura");
                $esp = $this->docencia_model->contar_tesis($row['noPersonal'], $fecha_de, $fecha_hasta, $intervencion, "Especialidad");
                $mae = $this->docencia_model->contar_tesis($row['noPersonal'], $fecha_de, $fecha_hasta, $intervencion, "Maestría");
                $doc = $this->docencia_model->contar_tesis($row['noPersonal'], $fecha_de, $fecha_hasta, $intervencion, "Doctorado");
                                   
                $tesis['tesis'][] = array(                                               
                                            'nombre'  => $row['nombre'],
                                            'tsu'     => $tsu,
                                            'lic'     => $lic,
                                            'esp'     => $esp,
                                            'mae'     => $mae, 
                                            'doc'     => $doc          
                                        );
                $t_tsu = $t_tsu + $tsu; //voy sumando los totales
                $t_lic = $t_lic + $lic;
                $t_esp = $t_esp + $esp;
                $t_mae = $t_mae + $mae;
                $t_doc = $t_doc + $doc;
                                                          
            }                             
            
            $tesis['t_tsu'] = $t_tsu;
            $tesis['t_lic'] = $t_lic;
            $tesis['t_esp'] = $t_esp;            
            $tesis['t_mae'] = $t_mae;
            $tesis['t_doc'] = $t_doc;
            $tesis['intervencion'] = $intervencion;            
            $tesis['periodo'] = implode("/", array_reverse( preg_split("/\D/", $fecha_de) ) )." - ".implode("/", array_reverse( preg_split("/\D/", $fecha_hasta) ) );
            //print_r($tesis);  
            $datos_plantilla['titulo'] = "Informe";                                 
            $datos_plantilla['contenido'] = $this->load->view('informe/tesis_view', $tesis, TRUE);
            $this->load->view('informe_view', $datos_plantilla);         
       }
    }

    function catedra_por_academico($noPersonal)
    {
        $this->load->model('docencia_model');
        $catedra['row'] = $this->docencia_model->catedra_por_academico($noPersonal);

        echo '<table width="100%" border="1">';
        echo '<thead>
                  <tr>
                    <th>nombre EE</th>
                    <th>Programa</th>
                    <th>Nivel</th>                   
                  </tr>
                </thead>
                <tbody>';
        foreach ($catedra['row'] as $row) 
        {
            echo "<tr>";
            echo "<td>".$row['nombre_catedra']."</td>";
            echo "<td>".$row['programa']."</td>";
            echo "<td>".$row['nivel']."</td>";
            echo "</tr>";
        }
        echo '</tbody>
              </table>';        
    }                
}
               
 /*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */