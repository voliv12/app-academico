<script>
  $(function() {
    $( "#fecha_de" ).datepicker({
      changeMonth: true,
      changeYear: true,
      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
      dateFormat: "yy/mm/dd"
    });
    $( "#fecha_hasta" ).datepicker({
      changeMonth: true,
      changeYear: true,
      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
      dateFormat: "yy/mm/dd"
    });
  });
</script>

<div style="width:100%;text-align:center;margin-left:0%;margin-top:0%">
<form  role="form" action="<?php echo $action;?>" method="POST">

    Desde: <input type="text" id="fecha_de" name="fecha_de">
    Hasta: <input type="text" id="fecha_hasta" name="fecha_hasta">

        <button type="submit" class="btn btn-default">Buscar</button>
</form>
</div>