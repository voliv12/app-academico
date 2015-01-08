<div id="tabs" style="width:70%;text-align:center;margin-left:15%;margin-top:0%">
<form  role="form" action="informe/docencia/resumen_catedra" method="POST">
    Nivel: <select clas="form-control" name="nivel">
                    <option value="TSU">TSU</option>
                    <option value="Licenciatura">Licenciatura</option>
                    <option value="Maestría">Maestría</option>
                    <option value="Doctorado">Doctorado</option>                                
            </select>                 
            <button type="submit" class="btn btn-default">Buscar</button>     
</form>      
<h4>Total de EE activas impartidas por Académico</h4>
<h5><?php echo "Nivel ".$nivel; ?> </h5>
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Académico</th>
      <th>AFEL</th>      
      <th>Disciplinar</th>
      <th>Optativa</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $i = 1;
        foreach ($catedra as $catedra) 
        { 
    ?>
          <tr>      
            <td><?php echo $i; ?></td>
            <td><?php 
            $atts = array(
                        'width' => '800',
                        'height' => '500',
                        'scrollbars' => 'yes',
                        'status' => 'yes',
                        'resizable' => 'yes',
                        'screenx' => '400',
                        'screeny' => '150'                       
                        );
                        echo anchor_popup('informe/docencia/catedra_por_academico/'.$catedra['noPersonal'], $catedra['nombre'], $atts); ?></td>
            <!--td><a href ='docencia/catedra_por_academico/14875'><?php //echo $catedra['academico']['nombre']."</a>"; ?> </td-->
            <!--td><?php //echo $catedra['academico']['nombre']."</a>"; ?></td-->
            <td><?php echo $catedra['afel']; ?></td>
            <td><?php echo $catedra['disc']; ?></td>
            <td><?php echo $catedra['opta']; ?></td>                               
          </tr>
    <?php 
          $i++;
        } 
    ?>  
    <tr>
      <td></td>
      <td><b>Total</b></td>
      <td><b><?php echo $t_afel; ?></td>
      <td><b><?php echo $t_disc; ?></td>
      <td><b><?php echo $t_opta; ?></td>
    </tr>        
  </tbody>
</table>
</div>