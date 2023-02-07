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
	
	<div class="slim-mainpanel">
	<div class="container">
	<br><br>
	<?php
	if(isset($_GET['rst_all_kits_conf'])){
	$sql_rst_kits = "UPDATE `$dbname`.`$arkshopdb` SET `Kits` = '{}' WHERE (`Id` > '0')";
	if (mysqli_query($conn, $sql_rst_kits)) {
    $rowsAffected = mysqli_affected_rows($conn);
    if ($rowsAffected == 1) {
        echo "A atualização foi feita com sucesso.";
    } else {
        echo "<a href='list.php'>INICIO</a>";
    }
} else {
    echo "Erro ao atualizar dados: " . mysqli_error($conn);
}

// Fechar a conexão
mysqli_close($conn);
	}
	?>
	
	<?php
	if(isset($_GET['rst_all_points_conf'])){
	$sql_rst_kits = "UPDATE `$dbname`.`$arkshopdb` SET `Points` = '0' WHERE (`Id` > '0');";
	if (mysqli_query($conn, $sql_rst_kits)) {
    $rowsAffected = mysqli_affected_rows($conn);
    if ($rowsAffected == 1) {
        echo "A atualização foi feita com sucesso.";
    } else {
        echo "<a href='list.php'>INICIO</a>";
    }
} else {
    echo "Erro ao atualizar dados: " . mysqli_error($conn);
}

// Fechar a conexão
mysqli_close($conn);
	}
	?>
	
	<?php
	if(isset($_GET['rst_all_acc_conf'])){
	// Executar o comando TRUNCATE na tabela
	$sql = "TRUNCATE `$dbname`.`$arkshopdb`";

	if (mysqli_query($conn, $sql)) {
    echo "Todas as contas criadas no banco de dados foram apagadas.<br><a href='list.php'>INICIO</a>";
	} else {
    echo "Erro ao truncate a tabela: " . mysqli_error($conn);
	}

	// Fechar a conexão
	mysqli_close($conn);
	}
	?>
	
	
	<?php
	if(isset($_GET['rst_all_kits'])){
	?>
	<div class="modal-dialog" role="document">
	<div class="modal-content">
	<div class="modal-body tx-center pd-y-20 pd-x-20">

	<i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
	<h4 class="tx-danger mg-b-20">RESETAR TODOS OS KITS</h4>
	<p class="mg-b-20 mg-x-20">Atenção: Essa ação não poderá ser desfeita.</p>
	<a href='<?php echo $_SERVER['PHP_SELF'];?>?rst_all_kits_conf'><button type="button" class="btn btn-danger pd-x-25" aria-label="Close">Continuar</button></a>
	<a href='list.php'><button type="button" class="btn btn-secondary pd-x-25" aria-label="Close">Cancelar</button></a>
	</div>
	</div>
	</div>
	<?php
	}
	?>
	
	<?php
	if(isset($_GET['rst_all_points'])){
	?>
	<div class="modal-dialog" role="document">
	<div class="modal-content">
	<div class="modal-body tx-center pd-y-20 pd-x-20">

	<i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
	<h4 class="tx-danger mg-b-20">RESETAR TODOS OS PONTOS</h4>
	<p class="mg-b-20 mg-x-20">Atenção: Essa ação não poderá ser desfeita.</p>
	<a href='<?php echo $_SERVER['PHP_SELF'];?>?rst_all_points_conf'><button type="button" class="btn btn-danger pd-x-25" aria-label="Close">Continuar</button></a>
	<a href='list.php'><button type="button" class="btn btn-secondary pd-x-25" aria-label="Close">Cancelar</button></a>
	</div>
	</div>
	</div>
	<?php
	}
	?>
	
	
	<?php
	if(isset($_GET['rst_all_acc'])){
	?>
	<div class="modal-dialog" role="document">
	<div class="modal-content">
	<div class="modal-body tx-center pd-y-20 pd-x-20">

	<i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
	<h4 class="tx-danger mg-b-20">LIMPAR TODAS AS CONTAS</h4>
	<p class="mg-b-20 mg-x-20">Atenção: Essa ação não poderá ser desfeita.</p>
	<a href='<?php echo $_SERVER['PHP_SELF'];?>?rst_all_acc_conf'><button type="button" class="btn btn-danger pd-x-25" aria-label="Close">Continuar</button></a>
	<a href='list.php'><button type="button" class="btn btn-secondary pd-x-25" aria-label="Close">Cancelar</button></a>
	</div>
	</div>
	</div>
	<?php
	}
	?>
	</div>
    </div>
	<?php require('base.php'); ?>
  </body>
</html>
