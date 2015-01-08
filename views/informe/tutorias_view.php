<div id="tabs" style="width:70%;text-align:center;margin-left:15%;margin-top:0%">
<h4>Total de Tutorías en proceso por Académico</h4>
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>Académico</th>
      <th>TSU</th>      
      <th>Licenciatura</th>
      <th>Maestría</th>
      <th>Doctorado</th>      
    </tr>
  </thead>
  <tbody>
    <?php 
        $i = 1;
        foreach ($tutorias as $tutorias) 
        { 
    ?>
          <tr>      
            <td><?php echo $i; ?></td>
            <td><?php echo $tutorias['academico']['nombre'] ?></td>
            <td><?php echo $tutorias['academico']['tsu'] ?></td>
            <td><?php echo $tutorias['academico']['lic'] ?></td>
            <td><?php echo $tutorias['academico']['mae'] ?></td>
            <td><?php echo $tutorias['academico']['doc'] ?></td>
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
      <td><b><?php echo $t_mae; ?></td>
      <td><b><?php echo $t_doc; ?></b></td>      
    </tr>        
  </tbody>
</table>
</div>