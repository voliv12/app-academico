<?php echo $form_fechas; ?>

<script>
    $(function() {
        $( "#tabs" ).tabs();
    });
</script>

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

<div id="tabs" style="width:80%;text-align:center;margin-left:10%;margin-top:0%">
    <ul>
        <li><a href="#tabs-1">Artículos</a></li>
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
</div>
</p><br/>