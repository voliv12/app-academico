
<div style="width:100%;text-align:center;margin-left:0%;margin-top:0%">  
<form  role="form" action="informe/docencia/resumen_tesis" method="POST">
    Desde: <input type="date" class="form-control" name="fecha_de" id="fecha_de" placeholder="De">         
    Hasta: <input type="date" class="form-control" name="fecha_hasta" id="fecha_hasta" placeholder="Hasta">  
    Intervención: <select clas="form-control" name="intervencion">
                    <option value="Director">Director</option>
                    <option value="Codiretor">Codirector</option>
                    <option value="Asesor">Asesor</option>
                    <option value="Jurado">Jurado</option>
                    <option value="Prejurado">Prejurado</option>                    
                  </select>                   
           <button type="submit" class="btn btn-default">Buscar</button>     
</form>      
<h4><?php echo "Total de Tesis como ".$intervencion; ?> </h4>
<h5><?php echo "Presentadas durante el Periodo: ".$periodo; ?> </h5>
</div>
<div id="tabs" style="width:70%;text-align:center;margin-left:15%;margin-top:0%">
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Académico</th>
      <th>TSU</th>      
      <th>Licenciatura</th>
      <th>Especialidad</th>      
      <th>Maestría</th>
      <th>Doctorado</th>
    </tr>
  </thead>
  <tbody>
    <?php 
        $i = 1;
        foreach ($tesis as $tesis) 
        { 
    ?>
          <tr>      
            <td><?php echo $i; ?></td>
            <td><?php echo $tesis['nombre'] ?></td>
            <td><?php echo $tesis['tsu'] ?></td>
            <td><?php echo $tesis['lic'] ?></td>
            <td><?php echo $tesis['esp'] ?></td>
            <td><?php echo $tesis['mae'] ?></td>
            <td><?php echo $tesis['doc'] ?></td>           
          </tr>
    <?php 
          $i++;
        } 
    ?>  
    <tr>
      <td></td>
      <td><b>Total</b></td>
      <td><b><?php echo $t_tsu; ?></td>
      <td><b><?php echo $t_lic; ?></td>
      <td><b><?php echo $t_esp; ?></td>
      <td><b><?php echo $t_mae; ?></td>   
      <td><b><?php echo $t_doc; ?></td>     
    </tr>        
  </tbody>
</table>
</div>