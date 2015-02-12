<div class="alert alert-success"><h4>Grado del Personal Académico</h4></div>
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
                    name: 'Doctorado',
                    y: <?php echo $p_d; ?>,
                    sliced: true,
                    selected: true
                    },
                ['Maestría', <?php echo $p_m; ?>],
                ['Especialidad', <?php echo $p_e; ?>],
                ['Especialidad Médica', <?php echo $p_em; ?>],
                ['Licenciatura', <?php echo $p_l; ?>]
            ]
        }]
    });
});
</script>

<div id="container" style="width: 100%;"></div>

<div style="width:50%;text-align:center;margin-left:25%;margin-top:1%;">
<table class="table table-striped">
<tbody>
    <tr>
        <td>Doctorado:</td>
        <td><?php echo $d; ?></td>
        <td>Maestría:</td>
        <td><?php echo $m; ?></td>
        <td>Especialidad:</td>
        <td><?php echo $e; ?></td>
        <td>Especialidad Médica:</td>
        <td><?php echo $em; ?></td>
        <td>Licenciatura:</td>
        <td><?php echo $l; ?></td>
        </tr>
</tbody>
</table>
</div>