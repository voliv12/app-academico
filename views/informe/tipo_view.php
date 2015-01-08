<div style="width:70%;text-align:right;margin-left:15%">   
<b><?php echo $inv." (".$p_inv."%)"; ?></b> Investigadores de Tiempo Completo</br>
<b><?php echo $inv_mt." (".$p_inv_mt."%)"; ; ?></b> Investigadores de Medio Tiempo</br>
<b><?php echo $tecnico." (".$p_tecnico."%)"; ; ?></b> Técnicos Académicos</br>
</div>
<div style="width:70%;text-align:center;margin-left:15%;margin-top: 2%">
<table class="table table-striped">
<thead>
  <tr>
    <th>#</th>
    <th>Nombre del Académico</th>
    <th>Categoría</th> 
    <th>Departamento / Área</th> 
  </tr>
</thead>
<tbody>
   <?php
        $i = 0;
        foreach ($listado as $row){
            $i = $i + 1;
            echo "<tr>";
            echo "<td>".$i."</td>";
            echo "<td>".$row['nombre']."</td>";
            echo "<td>".$row['nombre_categoria']."</td>";
            echo "<td>".$row['departamento']."</td>";
            echo "</tr>";
        }    
   ?>           
</tbody>
</table>
</div>
 