<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Grado del personal Académico'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Total',
            data: [
                    {
                    name: '<?php echo $doctorado; ?>',
                    y: <?php echo $p_d; ?>,
                    sliced: true,
                    selected: true
                    },
                <?php                     
                    //echo $doctorado;                
                    echo $maestria;                    
                    echo $esp_medica;
                    echo $licenciatura;
                ?>                
            ]
        }]
    });
});
</script>

<div id="container" style="width: 100%;"></div>

<div style="width:40%;text-align:center;margin-left:30%;margin-top:1%;">
<table class="table table-striped">
<tbody>
    <tr>
        <td>Doctorado:</td>
        <td><?php echo $d; ?></td>
        <td>Maestría:</td>
        <td><?php echo $m; ?></td>  
        <td>Especialidad Médica:</td>
        <td><?php echo $em; ?></td>
        <td>Licenciatura:</td>
        <td><?php echo $l; ?></td>
        </tr>    
</tbody>
</table>                    
</div>

<div style="width:70%;text-align:center;margin-left:15%;margin-top:2%;">
<table class="table table-striped">
<thead>
  <tr>
    <th>#</th>
    <th>Nombre del Académico</th>
    <th>Grado</th>    
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
            echo "<td>".$row['grado']."</td>";
            
            echo "</tr>";
        }    
   ?>           
</tbody>
</table>
</div>