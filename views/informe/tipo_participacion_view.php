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
            categories = ['Autor principal', 'Autor de correspondencia','Colaborador'],
            name = 'Tipo participación',
            data = [{
                    y: <?php echo $p_art_ap; ?>,
                    color: colors[0]
                }, {
                    y: <?php echo $p_art_ac; ?>,
                    color: colors[1]
                },{
                    y: <?php echo $p_art_co; ?>,
                    color: colors[2]
                }];

        var chart = $('#articulos').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total de Artículos por Tipo de participación'
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

<!------------------------INICIA GRAFICA PARA LOS CAPITULOS---------------------------------->
<script type="text/javascript">
$(function () {
        var colors = Highcharts.getOptions().colors,
            categories = ['Autor principal', 'Autor de correspondencia','Colaborador'],
            name = 'Tipo participación',
            data = [{
                    y: <?php echo $p_cap_ap; ?>,
                    color: colors[0]
                }, {
                    y: <?php echo $p_cap_co; ?>,
                    color: colors[1]
                }];

        var chart = $('#capitulos').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total de Capítulos por Tipo de participación'
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
        <li><a href="#tabs-1">Participación en Artículos</a></li>
        <li><a href="#tabs-2">Participación en Capítulos</a></li>
    </ul>

    <div id="tabs-1">
        <div class="row">
            <div id="articulos" style="height:50%"></div>
        </div>
        <div style="width:70%;text-align:center;margin-left:15%;margin-top:1%">
            <table class="table table-hover">
              <tr>
                  <h4>Tipo de participación<h4>
              </tr>
              <tr>
                <td>Autor principal</td>
                <td>Autor correspondencia</td>
                <td>Colaborador</td>
                <td><b>Total de artículos</b></td>
              </tr>
              <tr>
                <td><?php echo $art_ap; ?></td>
                <td><?php echo $art_ac; ?></td>
                <td><?php echo $art_co; ?></td>
                <td><b><?php echo $total_art; ?></b></td>
              </tr>
            </table>
        </div>
    </div>


<div id="tabs-2">
<div class="row">
    <div id="capitulos" style="width:77%;height:59%"></div>
</div>
    <div style="width:70%;text-align:center;margin-left:15%;margin-top:1%">
    <table class="table table-hover">
      <tr>
          <h4>Capítulos<h4>
      </tr>
      <tr>
       <td>Autor principal</td>
        <td>Colaborador</td>
        <td><b>Total de capítulos</b></td>
      </tr>
      <tr>
        <td><?php echo $cap_ap; ?></td>
        <td><?php echo $cap_co; ?></td>
        <td><b><?php echo $total_cap; ?></b></td>
      </tr>
    </table>
    </div>
</div>



</div>
</p><br/>