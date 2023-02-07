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
	
	<?php
	if(isset($_GET['id'])){
	$id = $_GET['id'];
	} else if (isset($_POST['id'])){
	$id = $_POST['id'];
	} else {
	header('Location: list.php');
	}
	
	if(isset($_GET['steamid'])){
	$steamid = $_GET['steamid'];
	} else if (isset($_POST['steamid'])){
	$steamid = $_POST['steamid'];
	} else {
	header('Location: list.php');
	}
	?>
	
	<?php
	if(isset($_GET['rst_kits'])){
	$sql_rst_kits = "UPDATE `$dbname`.`$arkshopdb` SET `Kits` = '{}' WHERE (`Id` = '$id')";
	if (mysqli_query($conn, $sql_rst_kits)) {
    $rowsAffected = mysqli_affected_rows($conn);
    if ($rowsAffected == 1) {
	echo "A atualização foi feita com sucesso.";
    } else {
	echo "";
    }
	} else {
    echo "Erro ao atualizar dados: " . mysqli_error($conn);
	}
	}
	
	if(isset($_POST['edt_perf'])){
	$kits = $_POST['kits'];
	$points = $_POST['points'];
	$detalhes = $_POST['detalhes'];

	$edt_perf_conf = "UPDATE `$dbname`.`$arkshopdb` SET detalhes = '$detalhes',Kits = '$kits', Points = '$points' WHERE Id = '$id' AND SteamId = '$steamid'";
	if (mysqli_query($conn, $edt_perf_conf)) {
    $rowsAffected_edt_perf = mysqli_affected_rows($conn);
    if ($rowsAffected_edt_perf == 1) {
	echo "A atualização foi feita com sucesso.";
    } else {
	echo "";
    }
	} else {
    echo "Erro ao atualizar dados: " . mysqli_error($conn);
	}
	}
	?>
	
	<div class="slim-mainpanel">
	<?php
	// Obtém as informações do perfil do jogador usando a API Steam
	$json = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$api_key_steam&steamids=$steamid");
	$data = json_decode($json, true);
	// Obtém a URL da imagem de perfil do jogador
	$data = json_decode($json, true);
	
	
	if(isset($data['response']['players'][0]['avatarfull'])){
	$avatarfull = $data['response']['players'][0]['avatarfull']; //URL da imagem de perfil completa do jogador
	} else {
	$avatarfull = "";
	}
	
	if(isset($data['response']['players'][0]['personaname'])){
	$personaname = $data['response']['players'][0]['personaname']; //nome do jogador na Steam
	} else {
	$personaname = "";
	}
	
	if(isset($data['response']['players'][0]['avatarmedium'])){
	$avatarmedium = $data['response']['players'][0]['avatarmedium']; //URL da imagem de perfil média do jogador
	} else {
	$avatarmedium = "";
	}
	
	if(isset($data['response']['players'][0]['personastate'])){
	$personastate = $data['response']['players'][0]['personastate']; //estado atual do jogador (offline, ocupado, ausente, etc.)
	} else {
	$personastate = "";
	}
	
	
	
	if(isset($data['response']['players'][0]['timecreated'])){
	$timecreated = $data['response']['players'][0]['timecreated']; //data e hora em que a conta do jogador foi criada
	$get_date_created= $timecreated;
	$date_created = date("d/m/Y", $get_date_created);
	$show_date_created = "<b>Conta criada em:</b> $date_created";
	} else {
	$show_date_created = "<b>Conta criada em:</b> Essa informação está oculta<br> ou não pertence a STEAM";			
	}
	
	//Busca todos os dados da conta no banco de dados
	$id_account = $id;
	$sql = "SELECT * FROM $arkshopdb Where Id = '$id_account ' LIMIT 1";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $total_points = $row["Points"];
		$kits = $row["Kits"];
		$detalhes = $row["detalhes"];
		$date_created_in_server = date('d/m/Y | H:i', strtotime($row['data_criacao']));
    }
} else {
    $total_points = "0";
	$kits = "0";
	$date_created_in_server = "0";
	$detalhes = "";
}
	
	?>
	<div class="container" style='min-height:1024px;'>
	<div class="slim-pageheader" >
          <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item"><a href="list.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $steamid; ?></li>
          </ol>
          <h6 class="slim-pagetitle">DETALHES DA CONTA</h6>
        </div>
	<div class="row row-sm">
	<div class="col-lg-8">
	<div class="card card-profile">
              <div class="card-body">
                <div class="media">
				<?php
				echo "<img src='$avatarfull'>";
				?>
				<div class="media-body">
				<h3 class="card-profile-name"><?php echo $personaname; ?></h3>
				<p class="card-profile-position">
	<?php 
	if($personastate == '0'){
	echo "<span style='color:#848589;'><i class='fa fa-close'></i> Offline</span>";
	} else if($personastate == '1') {
	echo "<span style='color:#003ec9; font-weight:bold;'><i class='fa fa-star'></i> Online</span>";
	} else if($personastate == '2') {
	echo "Ausente";
	} else if($personastate == '3') {
	echo "<span style='color:#00c963; font-weight:bold;'><i class='fa fa-star'></i> Online em jogo</span>";
	} else if($personastate == '4') {
	echo "Online mas Ausente";
	} else {
	echo "";
	}
	?>
				</p>
				<p>
				<?php 
				echo $show_date_created;
				?>
				</p>
				<p>
				<?php echo "<b>Conta criada no servidor em: </b>".$date_created_in_server; ?>
				</p>
				</div>
                </div>
				</div>
				<div class="card-footer">
                <a href="" class="card-profile-direct"></a>
                <div>
				<a href="perfil.php?rst_kits&steamid=<?php echo $steamid; ?>&id=<?php echo $id; ?>" style='color:#e71b1b;'><i class='fa fa-ban'></i> Reset Kits</a>
				<a href="edt_perf.php?steamid=<?php echo $steamid; ?>&id=<?php echo $id; ?>"><i class='icon ion-compose'></i> Editar Conta</a>
				</div>
				</div>
			 
			 <div class="card pd-20 mg-t-20">
			 
			 
              <label class="slim-card-title">Mais dados</label>
              <div class="post-group">
                <div class="post-item">
                  <span class="post-date">Kits</span>
                  <p class="post-title">
		<?php
		$text = $kits;

		$items = explode(",", $text);
		$count = count($items);

		for ($i = 0; $i < $count; $i++) {
		${'item' . ($i + 1)} = $items[$i];
		}

		for ($i = 1; $i <= $count; $i++) {
		echo "Item $i: ${'item' . $i} <br>";
		}
		?>
				  
				  </p>
                </div>
              </div>
            </div>
            </div>

			<br><br>
            </div>
			<div class="col-lg-4 mg-t-20 mg-lg-t-0">
			<div class="card card-connection">
              <div class="row row-xs">
                <div class="col-8 tx-primary"><b>PONTOS:</b> <?php echo $total_points; ?></div>
              </div>
              <hr>
            </div>
		<br>
		<div class="card card-connection">
		<div class="row row-xs">
		<h2>DETALHES</h2>
		</div>
		<hr>
		<?php 
		if(empty($detalhes)){
		echo "Nenhum detalhe para exibir.";
		} else {
		echo $detalhes; 
		}
		?>
		</div>
		</div>
		</div>
	</div>
    </div>
	<?php require('base.php'); ?>
  </body>
</html>
