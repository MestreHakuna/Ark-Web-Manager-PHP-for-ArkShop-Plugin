<?php
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////LICENCA LIBERADA PARA USO DESDE QUE SE MANTENHA OS DIREITOS AUTORAIS////
//////DESENVOLVIDO POR: MESTRE HAKUNA ////////////////////////////////////////
//////CRIADO EM: 03/02/2023///////MODIFICADO EM: 03/02/2023///////////////////
//////DISCORD: MESTRE HAKUNA#9901/////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
require_once 'verifica.php';
?>

<!DOCTYPE html>
<html lang="en">
  <?php require('head.php'); ?>
  <body>
    <?php include('topo.php'); ?>
	<?php include('nav.php'); ?>
	<br>
	<div class="slim-mainpanel" style='min-height:1024px;'>
	<div class="container">
	<div class="section-wrapper">
              <label class="section-title">Editar Conta</label>
              <p class="mg-b-20 mg-sm-b-40">Altere as informações com atenção, faça somente se souber o que está fazendo<br>
			  pois alterações no banco de dados se incorretas, podem causar crash no servidor, <br>procure exemplos nos kits prontos em outras contas como referência.
			  </p>
	<?php
	$id_account = $_GET['id'];
	$sql = "SELECT * FROM $arkshopdb Where Id = '$id_account ' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
	$total_points = $row["Points"];
	$kits = $row["Kits"];
	$detalhes = $row["detalhes"];
    }
	}
	?>
		<form action="perfil.php" name="edt_perf" method="POST">
		<input readonly type='hidden' value='<?php echo $_GET['id']; ?>' name='id' id='id'/>
		<input readonly type='hidden' value='<?php echo $_GET['steamid']; ?>' name='steamid' id='steamid'/>
		<div class="form-layout form-layout-4">
		<div class="row">
		<label class="col-sm-4 form-control-label">Pontos: <span class="tx-danger">*</span></label>
		<div class="col-sm-8 mg-t-10 mg-sm-t-0">
		<input type="text" name='points' class="form-control" value='<?php echo $total_points; ?>' placeholder="1000">
		</div>
		</div>
		<br>
		<div class="row">
		<label class="col-sm-4 form-control-label">Detalhes: <span class="tx-danger">*</span></label>
		<div class="col-sm-8 mg-t-10 mg-sm-t-0">
		<input type="text" name='detalhes' class="form-control" value='<?php echo $detalhes; ?>'placeholder="Texto variado, detalhes que deseja...">
		</div>
		</div>
		<div class="row mg-t-20">
		<label class="col-sm-4 form-control-label">Kits: <span class="tx-danger">*</span></label>
		<div class="col-sm-8 mg-t-10 mg-sm-t-0">
		<textarea rows="2" name='kits' class="form-control" value='<?php echo $kits; ?>' placeholder='{"vip1":{"Amount":2}, "vip2":{"Amount":1}}' style="height: 106px;"></textarea>
		</div>
		</div>
		<div class="form-layout-footer mg-t-30">
		<button class="btn btn-primary bd-0" name="edt_perf" >CONFIRMAR</button>

		</form>
		<a href='perfil.php?id=<?php echo $_GET['id']; ?>&steamid=<?php echo $_GET['steamid']; ?>'><span class="btn btn-secondary bd-0">Cancelar</span></a>
		</div>
		</div>
		</div>
	
	</div>
    </div>
	<?php require('base.php'); ?>
  </body>
</html>
