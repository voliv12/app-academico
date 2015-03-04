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
            categories = ['Nacionales', 'Internacionales'],
            name = 'Tipo',
            data = [{
                    y: <?php echo $p_art_nac; ?>,
                    color: colors[0]
                }, {
                    y: <?php echo $p_art_int; ?>,
                    color: colors[1]
                }];

        var chart = $('#articulos').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total de Artículos por Tipo de publicación'
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

<!------------------------INICIA GRAFICA PARA LOS LIBROS---------------------------------->
<script type="text/javascript">
$(function () {
        var colors = Highcharts.getOptions().colors,
            categories = ['Nacionales', 'Internacionales'],
            name = 'Tipo',
            data = [{
                    y: <?php echo $p_lib_nac; ?>,
                    color: colors[2]
                }, {
                    y: <?php echo $p_lib_int; ?>,
                    color: colors[3]
                }];

        var chart = $('#libros').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total de Libros por Tipo de publicación'
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
            categories = ['Nacionales','Internacionales'],
            name = 'Tipo',
            data = [{
                    y: <?php echo $p_cap_nac; ?>,
                    color: colors[4]
                },{
                    y: <?php echo $p_cap_int; ?>,
                    color: colors[5]
                }];

        var chart = $('#capitulos').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total de Capítulos de Libro por Tipo de publicación'
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
    <li><a href="#tabs-1">Artículos</a></li>
    <li><a href="#tabs-2">Libros</a></li>
    <li><a href="#tabs-3">Capítulos de Libro</a></li>
</ul>

<div id="tabs-1">
<div class="row">
    <div id="articulos" style="height:50%"></div>
</div>
    <div style="width:70%;text-align:center;margin-left:15%;margin-top:1%">
    <table class="table table-hover">
      <tr>
          <h4>Artículos<h4>
      </tr>
      <tr>
        <td>Nacionales</td>
        <td>Internacionales</td>
        <td><b>Total</b></td>
      </tr>
      <tr>
        <td><?php echo $art_nac; ?></td>
        <td><?php echo $art_int; ?></td>
        <td><b><?php echo $art_nac + $art_int; ?></b></td>
      </tr>
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
          <h4>Libros<h4>
      </tr>
      <tr>
        <td>Nacionales</td>
        <td>Internacionales</td>
        <td><b>Total</b></td>
      </tr>
      <tr>
        <td><?php echo $lib_nac; ?></td>
        <td><?php echo $lib_int; ?></td>
        <td><b><?php echo $lib_nac + $lib_int; ?></b></td>
      </tr>
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
          <h4>Capítulos de Libro<h4>
      </tr>
      <tr>
        <td>Nacionales</td>
        <td>Internacionales</td>
        <td><b>Total</b></td>
      </tr>
      <tr>
        <td><?php echo $cap_nac; ?></td>
        <td><?php echo $cap_int; ?></td>
        <td><b><?php echo $cap_nac + $cap_int; ?></b></td>
      </tr>
    </table>
    </div>
</div>

</div>
</p><br/>