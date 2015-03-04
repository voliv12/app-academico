<?php echo $form_fechas; ?>

<script>
    $(function() {
        $( "#tabs" ).tabs();
    });
</script>

<!-- ################## ARTICULOS ################ -->
<script type="text/javascript">

    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                defaultSeriesType: 'column'
            },
            title: {
                text: 'Participación en Artículos por Departamento'
            },
            subtitle: {
                text: 'Periodo: <?php echo $desde." - ".$hasta; ?> '
            },
            xAxis: {
                categories: [<?php
                    $deptos = "";
                    foreach ($art as $depto){ $deptos.= "'".$depto['nombre_depto']."',";}
                    echo $deptos;
                    ?>]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total de artículos'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -100,
                verticalAlign: 'top',
                y: 20,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                         this.series.name +': '+ this.y +'%<br/>'+
                         'Total: '+ this.point.stackTotal;
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        formatter: function() {
                            return this.y +'%';
                        }
                    }
                }
            },
            series: [{
                name: 'Nacional',
                data: [<?php
                    $deptos = "";
                    foreach ($art as $depto){ $deptos.= round($depto['porcentaje_n']).",";}
                    echo $deptos;
                    ?>]
            }, {
                name: 'Internacional',
                data: [<?php
                    $deptos = "";
                    foreach ($art as $depto){ $deptos.= round($depto['porcentaje_i']).",";}
                    echo $deptos;
                    ?>]
            }]
        });
    });

</script>

<!-- ################## LIBROS ################ -->
<script type="text/javascript">

    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'libros',
                defaultSeriesType: 'column'
            },
            title: {
                text: 'Participación en Libros por Departamento'
            },
            subtitle: {
                text: 'Periodo: <?php echo $desde." - ".$hasta; ?> '
            },
            xAxis: {
                categories: [<?php
                    $deptos = "";
                    foreach ($lib as $depto){ $deptos.= "'".$depto['nombre_depto']."',";}
                    echo $deptos;
                    ?>]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total de libros'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -100,
                verticalAlign: 'top',
                y: 20,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                         this.series.name +': '+ this.y +'%<br/>'+
                         'Total: '+ this.point.stackTotal;
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        formatter: function() {
                            return this.y +'%';
                        }
                    }
                }
            },
            series: [{
                name: 'Nacional',
                data: [<?php
                    $deptos = "";
                    foreach ($lib as $depto){ $deptos.= round($depto['porcentaje_n']).",";}
                    echo $deptos;
                    ?>]
            }, {
                name: 'Internacional',
                data: [<?php
                    $deptos = "";
                    foreach ($lib as $depto){ $deptos.= round($depto['porcentaje_i']).",";}
                    echo $deptos;
                    ?>]
            }]
        });
    });

</script>

<!-- ################## CAPITULOS ################ -->
<script type="text/javascript">

    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'capitulos',
                defaultSeriesType: 'column'
            },
            title: {
                text: 'Participación en Capítulos por Departamento'
            },
            subtitle: {
                text: 'Periodo: <?php echo $desde." - ".$hasta; ?> '
            },
            xAxis: {
                categories: [<?php
                    $deptos = "";
                    foreach ($cap as $depto){ $deptos.= "'".$depto['nombre_depto']."',";}
                    echo $deptos;
                    ?>]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total de capítulos'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -100,
                verticalAlign: 'top',
                y: 20,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                         this.series.name +': '+ this.y +'%<br/>'+
                         'Total: '+ this.point.stackTotal;
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        formatter: function() {
                            return this.y +'%';
                        }
                    }
                }
            },
            series: [{
                name: 'Nacional',
                data: [<?php
                    $deptos = "";
                    foreach ($cap as $depto){ $deptos.= round($depto['porcentaje_n']).",";}
                    echo $deptos;
                    ?>]
            }, {
                name: 'Internacional',
                data: [<?php
                    $deptos = "";
                    foreach ($cap as $depto){ $deptos.= round($depto['porcentaje_i']).",";}
                    echo $deptos;
                    ?>]
            }]
        });
    });

</script>

<div id="tabs" style="width:80%;text-align:center;margin-left:10%;margin-top:0%">
    <ul>
        <li><a href="#tabs-1">Artículos por departamento</a></li>
        <li><a href="#tabs-2">Libros por departamento</a></li>
        <li><a href="#tabs-3">Capítulos por departamento</a></li>
    </ul>

    <div id="tabs-1">
        <div class="row">
            <div id="container" style="height:50%"></div>
        </div>
        <div style="width:70%;text-align:center;margin-left:15%;margin-top:1%">
            <table class="table table-hover">
              <tr>
                  <h4>Número de Artículos por Departamento<h4>
              </tr>
              <tr>
                <td><b>Departamento</b></td>
                <td><b>Nacionales</b></td>
                <td><b>Internacionales</b></td>
              </tr>
              <?php
                    for($i=0; $i<count($art); $i++){
                        echo "<tr>";
                        echo "<td>".$art[$i]['nombre_depto']."</td>";
                        echo "<td>".$art[$i]['total_n']."</td>";
                        echo "<td>".$art[$i]['total_i']."</td>";
                        echo "</tr>";
                    }
              ?>
            </table>
        </div>
    </div>

    <div id="tabs-2">
        <div class="row">
            <div id="libros" style="width:77%;height:59%"></div>
        </div>
        <div style="width:70%;text-align:center;margin-left:15%;margin-top:1%">
            <table class="table table-hover">
              <tr>
                  <h4>Número de Libros por Departamento<h4>
              </tr>
              <tr>
                <td><b>Departamento</b></td>
                <td><b>Nacionales</b></td>
                <td><b>Internacionales</b></td>
              </tr>
              <?php
                    for($i=0; $i<count($lib); $i++){
                        echo "<tr>";
                        echo "<td>".$lib[$i]['nombre_depto']."</td>";
                        echo "<td>".$lib[$i]['total_n']."</td>";
                        echo "<td>".$lib[$i]['total_i']."</td>";
                        echo "</tr>";
                    }
              ?>
            </table>
        </div>
    </div>

    <div id="tabs-3">
        <div class="row">
            <div id="capitulos" style="width:77%;height:59%"></div>
        </div>
        <div style="width:70%;text-align:center;margin-left:15%;margin-top:1%">
            <table class="table table-hover">
              <tr>
                  <h4>Número de Capítulos por Departamento<h4>
              </tr>
              <tr>
                <td><b>Departamento</b></td>
                <td><b>Nacionales</b></td>
                <td><b>Internacionales</b></td>
              </tr>
              <?php
                    for($i=0; $i<count($cap); $i++){
                        echo "<tr>";
                        echo "<td>".$cap[$i]['nombre_depto']."</td>";
                        echo "<td>".$cap[$i]['total_n']."</td>";
                        echo "<td>".$cap[$i]['total_i']."</td>";
                        echo "</tr>";
                    }
              ?>
            </table>
        </div>
    </div>

</div>
</p><br/>