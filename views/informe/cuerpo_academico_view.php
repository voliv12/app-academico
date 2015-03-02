<?php echo $form_fechas; ?>

<script>
    $(function() {
        $( "#tabs" ).tabs();
    });
</script>

<!------------------------INICIA GRAFICA PARA LOS ARTICULOS---------------------------------->
<script type="text/javascript">
$(function () {
        var colors = Highcharts.getOptions().colors,
            categories = [<?php
                            $lista_ca = "";
                            foreach ($ca as $cuerpo){ $lista_ca.= "'".$cuerpo['nombre_CA']."',";}
                            echo $lista_ca;
                            ?>],
            name = 'Publicaciones Cuerpo Académico',
            data = [<?php
                        $i = 0;
                        $porcentaje = "";
                        foreach ($ca as $total_p){ $porcentaje.= "{ y: ".round($total_p['porcentaje']).", color: colors[".$i."]},"; $i++; }
                         echo $porcentaje;
                        ?>];
        var chart = $('#articulos').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Participación en Artículos por Cuerpo Académico'
            },
            subtitle: {
                text: 'Periodo: <?php echo $desde." - ".$hasta; ?> '
            },
            xAxis: {
                categories: categories
            },
            yAxis: {
                title: {
                    text: 'Porcentaje total'
                }
            },
            plotOptions: {
                column: {
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: colors[0],
                        style: {
                            fontWeight: 'bold'
                        },
                        formatter: function() {
                            return this.y +'%';
                        }
                    }
                }
            },
            tooltip: {
                formatter: function() {
                    var point = this.point,
                        s = this.x +':<b>'+ this.y +'% </b><br/>';
                    return s;
                }
            },
            series: [{
                name: name,
                data: data,
                color: 'white'
            }],
            exporting: {
                enabled: true
            }
        })
        .highcharts(); // return chart
    });
</script>

<!------------------------INICIA GRAFICA PARA LIBROS---------------------------------->
<script type="text/javascript">
$(function () {
        var colors = Highcharts.getOptions().colors,
            categories = [<?php
                            $lista_ca = "";
                            foreach ($ca_l as $cuerpo){ $lista_ca.= "'".$cuerpo['nombre_CA']."',";}
                            echo $lista_ca;
                            ?>],
            name = 'Publicaciones Cuerpo Académico',
            data = [<?php
                        $i = 0;
                        $porcentaje = "";
                        foreach ($ca_l as $total_p){ $porcentaje.= "{ y: ".round($total_p['porcentaje']).", color: colors[".$i."]},"; $i++; }
                         echo $porcentaje;
                        ?>];
        var chart = $('#libros').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Participación en Libros por Cuerpo Académico'
            },
            subtitle: {
                text: 'Periodo: <?php echo $desde." - ".$hasta; ?> '
            },
            xAxis: {
                categories: categories
            },
            yAxis: {
                title: {
                    text: 'Porcentaje total'
                }
            },
            plotOptions: {
                column: {
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: colors[0],
                        style: {
                            fontWeight: 'bold'
                        },
                        formatter: function() {
                            return this.y +'%';
                        }
                    }
                }
            },
            tooltip: {
                formatter: function() {
                    var point = this.point,
                        s = this.x +':<b>'+ this.y +'% </b><br/>';
                    return s;
                }
            },
            series: [{
                name: name,
                data: data,
                color: 'white'
            }],
            exporting: {
                enabled: true
            }
        })
        .highcharts(); // return chart
    });
</script>

<!------------------------INICIA GRAFICA PARA CAPITULOS---------------------------------->
<script type="text/javascript">
$(function () {
        var colors = Highcharts.getOptions().colors,
            categories = [<?php
                            $lista_ca = "";
                            foreach ($ca_c as $cuerpo){ $lista_ca.= "'".$cuerpo['nombre_CA']."',";}
                            echo $lista_ca;
                            ?>],
            name = 'Publicaciones Cuerpo Académico',
            data = [<?php
                        $i = 0;
                        $porcentaje = "";
                        foreach ($ca_c as $total_p){ $porcentaje.= "{ y: ".round($total_p['porcentaje']).", color: colors[".$i."]},"; $i++; }
                         echo $porcentaje;
                        ?>];
        var chart = $('#capitulos').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Participación en Capítulos por Cuerpo Académico'
            },
            subtitle: {
                text: 'Periodo: <?php echo $desde." - ".$hasta; ?> '
            },
            xAxis: {
                categories: categories
            },
            yAxis: {
                title: {
                    text: 'Porcentaje total'
                }
            },
            plotOptions: {
                column: {
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: colors[0],
                        style: {
                            fontWeight: 'bold'
                        },
                        formatter: function() {
                            return this.y +'%';
                        }
                    }
                }
            },
            tooltip: {
                formatter: function() {
                    var point = this.point,
                        s = this.x +':<b>'+ this.y +'% </b><br/>';
                    return s;
                }
            },
            series: [{
                name: name,
                data: data,
                color: 'white'
            }],
            exporting: {
                enabled: true
            }
        })
        .highcharts(); // return chart
    });
</script>


<div id="tabs" style="width:80%;text-align:center;margin-left:10%;margin-top:0%">
    <ul>
        <li><a href="#tabs-1">Artículos de Cuerpo Académico</a></li>
        <li><a href="#tabs-2">Libros de Cuerpo Académico</a></li>
        <li><a href="#tabs-3">Capítulos de Cuerpo Académico</a></li>
    </ul>

    <div id="tabs-1">
        <div class="row">
            <div id="articulos" style="height:50%"></div>
        </div>
        <div style="width:70%;text-align:center;margin-left:15%;margin-top:1%">
            <table class="table table-hover">
              <tr>
                  <h4>Articulos por Cuerpo Académico<h4>
              </tr>
              <?php foreach ($ca as $cuerpo){
                echo "<tr>";
                echo "<td>".$cuerpo['nombre_CA']."</td>";
                echo "<td>".$cuerpo['total']."</td>";
                echo "</tr>";
              }?>
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
                  <h4>Libros por Cuerpo Académico<h4>
              </tr>
              <?php foreach ($ca_l as $cuerpo){
                echo "<tr>";
                echo "<td>".$cuerpo['nombre_CA']."</td>";
                echo "<td>".$cuerpo['total']."</td>";
                echo "</tr>";
              }?>
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
                  <h4>Capítulos por Cuerpo Académico<h4>
              </tr>
              <?php foreach ($ca_c as $cuerpo){
                echo "<tr>";
                echo "<td>".$cuerpo['nombre_CA']."</td>";
                echo "<td>".$cuerpo['total']."</td>";
                echo "</tr>";
              }?>
            </table>
        </div>
    </div>


</div>
</p><br/>