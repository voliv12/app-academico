<?php echo $form_fechas; ?>

<script>
    $(function() {
        $( "#tabs" ).tabs();
    });
</script>

<!-- ----------------------INICIA GRAFICA PARA EL DEPTO DE BIOMEDICINA-------------------------------- -->
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
    
        var chart = $('#biomedicina').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total de Publicaciones Departamento de Biomedicina'
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

<!------------------------INICIA GRAFICA PARA EL AREA CLINICA---------------------------------->
<script type="text/javascript">
$(function () {                  
        var colors = Highcharts.getOptions().colors,
            categories = ['Artículos Nacionales', 'Artículos Internacionales', 'Libros Nacionales', 'Libros Internacionales', 'Capítulos Nacionales','Capítulos Internacionales'],            
            name = 'Tipo de publicación',
            data = [{
                    y: <?php echo $p_art_nac_cl; ?>,                    
                    color: colors[0]                   
                }, {
                    y: <?php echo $p_art_int_cl; ?>,
                    color: colors[1]                
                }, {
                    y: <?php echo $p_lib_nac_cl; ?>,
                    color: colors[2]                    
                }, {
                    y: <?php echo $p_lib_int_cl; ?>,
                    color: colors[3]                  
                }, {
                    y: <?php echo $p_cap_nac_cl; ?>,
                    color: colors[4]                   
                },{
                    y: <?php echo $p_cap_int_cl; ?>,
                    color: colors[5]
                }];            
    
        var chart = $('#clinica').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total de Publicaciones Departamento de Investigación Clínica'
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

<!------------------------INICIA GRAFICA PARA EL AREA DE SISTEMAS DE SALUD---------------------------------->
<script type="text/javascript">
$(function () {                  
        var colors = Highcharts.getOptions().colors,
            categories = ['Artículos Nacionales', 'Artículos Internacionales', 'Libros Nacionales', 'Libros Internacionales', 'Capítulos Nacionales','Capítulos Internacionales'],            
            name = 'Tipo de publicación',
            data = [{
                    y: <?php echo $p_art_nac_ss; ?>,                    
                    color: colors[0]                   
                }, {
                    y: <?php echo $p_art_int_ss; ?>,
                    color: colors[1]                
                }, {
                    y: <?php echo $p_lib_nac_ss; ?>,
                    color: colors[2]                    
                }, {
                    y: <?php echo $p_lib_int_ss; ?>,
                    color: colors[3]                  
                }, {
                    y: <?php echo $p_cap_nac_ss; ?>,
                    color: colors[4]                   
                },{
                    y: <?php echo $p_cap_int_ss; ?>,
                    color: colors[5]
                }];            
    
        var chart = $('#ssalud').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total de Publicaciones Departamento de Sistemas de Salud'
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

<!------------------------INICIA GRAFICA PARA EL DEPARTAMENTO DE ADICCIONES---------------------------------->
<script type="text/javascript">
$(function () {                  
        var colors = Highcharts.getOptions().colors,
            categories = ['Artículos Nacionales', 'Artículos Internacionales', 'Libros Nacionales', 'Libros Internacionales', 'Capítulos Nacionales','Capítulos Internacionales'],            
            name = 'Tipo de publicación',
            data = [{
                    y: <?php echo $p_art_nac_ad; ?>,                    
                    color: colors[0]                   
                }, {
                    y: <?php echo $p_art_int_ad; ?>,
                    color: colors[1]                
                }, {
                    y: <?php echo $p_lib_nac_ad; ?>,
                    color: colors[2]                    
                }, {
                    y: <?php echo $p_lib_int_ad; ?>,
                    color: colors[3]                  
                }, {
                    y: <?php echo $p_cap_nac_ad; ?>,
                    color: colors[4]                   
                },{
                    y: <?php echo $p_cap_int_ad; ?>,
                    color: colors[5]
                }];            
    
        var chart = $('#adicciones').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Total de Publicaciones Departamento de Adicciones'
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
                        color: colors[1],
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
    <li><a href="#tabs-1">Biomedicina</a></li>
    <li><a href="#tabs-2">Clínica</a></li>
    <li><a href="#tabs-3">Sistemas de Salud</a></li>
    <li><a href="#tabs-4">Adicciones</a></li>
</ul>

<div id="tabs-1">        
<div class="row">   
    <div id="biomedicina" style="height:50%"></div>
</div>
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
</div>    

<div id="tabs-2">        
<div class="row">   
    <div id="clinica" style="width:77%;height:59%"></div>
</div>
    <div style="width:70%;text-align:center;margin-left:15%;margin-top:1%">
    <table class="table table-hover">
      <tr>
          <h4>Producción por investigador: <?php echo $p_invest_cl;?><h4>
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
        <td><?php echo $art_nac_cl; ?></td>
        <td><?php echo $art_int_cl; ?></td>
        <td><?php echo $lib_nac_cl; ?></td>
        <td><?php echo $lib_int_cl; ?></td>
        <td><?php echo $cap_nac_cl; ?></td>
        <td><?php echo $cap_int_cl; ?></td>
        <td><b><?php echo $art_nac_cl + $art_int_cl + $lib_nac_cl + $lib_int_cl + $cap_nac_cl + $cap_int_cl; ?></b></td>
      </tr>
    </table>
    </div>    
</div>    

<div id="tabs-3">        
<div class="row">   
    <div id="ssalud" style="width:77%;height:59%"></div>
</div>
    <div style="width:70%;text-align:center;margin-left:15%;margin-top:1%">
    <table class="table table-hover">
      <tr>
          <h4>Producción por investigador: <?php echo $p_invest_ss;?><h4>
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
        <td><?php echo $art_nac_ss; ?></td>
        <td><?php echo $art_int_ss; ?></td>
        <td><?php echo $lib_nac_ss; ?></td>
        <td><?php echo $lib_int_ss; ?></td>
        <td><?php echo $cap_nac_ss; ?></td>
        <td><?php echo $cap_int_ss; ?></td>
        <td><b><?php echo $art_nac_ss + $art_int_ss + $lib_nac_ss + $lib_int_ss + $cap_nac_ss + $cap_int_ss; ?></b></td>
      </tr>
    </table>
    </div>    
</div>
 
<div id="tabs-4">        
<div class="row">   
    <div id="adicciones" style="width:77%;height:59%"></div>
</div>
    <div style="width:70%;text-align:center;margin-left:15%;margin-top:1%">
    <table class="table table-hover">
      <tr>
          <h4>Producción por investigador: <?php echo $p_invest_ad;?><h4>
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
        <td><?php echo $art_nac_ad; ?></td>
        <td><?php echo $art_int_ad; ?></td>
        <td><?php echo $lib_nac_ad; ?></td>
        <td><?php echo $lib_int_ad; ?></td>
        <td><?php echo $cap_nac_ad; ?></td>
        <td><?php echo $cap_int_ad; ?></td>
        <td><b><?php echo $art_nac_ad + $art_int_ad + $lib_nac_ad + $lib_int_ad + $cap_nac_ad + $cap_int_ad; ?></b></td>
      </tr>
    </table>
    </div>    
</div>

</div>
</p><br/>