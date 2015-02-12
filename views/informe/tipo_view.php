<?php
foreach($css_files as $file): ?>
  <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
  <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
<style type='text/css'>

</style>

<?php echo $titulo_tabla; ?>
<div style="width:70%;text-align:right;margin-left:15%">
<b><?php echo $inv." (".$p_inv."%)"; ?></b> Académicos de Tiempo Completo</br>
<b><?php echo $inv_mt." (".$p_inv_mt."%)"; ; ?></b> Académicos de Medio Tiempo</br>
<b><?php echo $tecnico." (".$p_tecnico."%)"; ; ?></b> Técnicos Académicos</br>
</div>

<div style="width:80%;text-align:right;margin-left:10%">
   <?php echo $output; ?>
</div>


