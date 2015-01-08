
<div style="width:100%;text-align:center;margin-left:0%;margin-top:0%">  
<form  role="form" action="informe/publicaciones/ponencias" method="POST">
    Desde: <input type="date" class="form-control" name="fecha_de" id="fecha_de" placeholder="De">         
    Hasta: <input type="date" class="form-control" name="fecha_hasta" id="fecha_hasta" placeholder="Hasta"> 
           <button type="submit" class="btn btn-default">Buscar</button>    
</form>      
<h4>Total de Ponencias en Eventos Académicos</h4>
<h5><?php echo "Presentadas durante el Periodo: ".$periodo; ?> </h5>
</div>
<div id="tabs" style="width:70%;text-align:center;margin-left:15%;margin-top:0%">
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Académico</th>
      <th>Nombre Ponencia </th>      
      <th>Evento Académico</th>
      <th>Fecha</th>            
    </tr>
  </thead>
  <tbody>
    <?php 
        $i = 1;
        foreach ($ponencias as $ponencias) 
        { 
    ?>
          <tr>      
            <td><?php echo $i; ?></td>
            <td><?php echo $ponencias['nombre'] ?></td>
            <td><?php echo $ponencias['nombre_ponencia'] ?></td>
            <td><?php echo $ponencias['evento'] ?></td>
            <td><?php echo $ponencias['fecha'] ?></td>                
          </tr>
    <?php 
          $i++;
        } 
    ?>      
  </tbody>
</table>
</div>