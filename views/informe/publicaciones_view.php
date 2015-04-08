<script type="text/javascript">
$(function () {
        var colors = Highcharts.getOptions().colors,
            categories = ['Artículos Nacionales', 'Artículos Internacionales', 'Libros Nacionales', 'Libros Internacionales', 'Capítulos Nacionales','Capítulos Internacionales'],
            name = 'Tipo de publicación',
            data = [{
                    y: <?php echo $p_art_nac; ?>,
                    color: colors[0]
                }, {
                    y: <?php echo $p_art_int; ?>,
                    color: colors[1]
                }, {
                    y: <?php echo $p_lib_nac; ?>,
                    color: colors[2]
                }, {
                    y: <?php echo $p_lib_int; ?>,
                    color: colors[3]
                }, {
                    y: <?php echo $p_cap_nac; ?>,
                    color: colors[4]
                },{
                    y: <?php echo $p_cap_int; ?>,
                    color: colors[5]
                }];

        var chart = $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total de Publicaciones por Dependencia '
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

<?php echo $form_fechas; ?>

<div id="container" style="width: 85%; height: 80%; margin: 0 auto"></div>

<div style="width:70%;text-align:center;margin-left:15%;margin-top:1%">
<table class="table table-hover">
  <tr>
      <h4>Producción por investigador: <?php echo $p_invest;?><h4>
  <tr>
    <td width="33" colspan="2"><b>Artículos</b></td>
    <td width="34" colspan="2"><b>Libros</b></td>
    <td width="33" colspan="3"><b>Capítulos de Libro</b></td>
  </tr>
  <tr>
    <td>Nacionales</td>
    <td>Internacionales</td>
    <td>Nacionales</td>
    <td>Internacionales</td>
    <td>Nacionales</td>
    <td>Internacionales</td>
    <td><b>Total</b></td>
  </tr>
  <tr>
    <td><?php echo $art_nac; ?></td>
    <td><?php echo $art_int; ?></td>
    <td><?php echo $lib_nac; ?></td>
    <td><?php echo $lib_int; ?></td>
    <td><?php echo $cap_nac; ?></td>
    <td><?php echo $cap_int; ?></td>
    <td><b><?php echo $art_nac + $art_int + $lib_nac + $lib_int + $cap_nac + $cap_int; ?></b></td>
  </tr>
</table>
</div>