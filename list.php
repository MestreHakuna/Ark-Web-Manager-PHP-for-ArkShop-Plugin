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
	<div id="result" style='border:1px solid #ddd; background-color:#ffffff; padding:10px;'></div>
	<?php
// Items per page
$items_per_page = $limit_itens_list;

// Check for page number
if (isset($_GET['page'])) {
    $page_number = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    if (!is_numeric($page_number)) {
        die('Invalid page number!');
    }
} else {
    $page_number = 1;
}

// Get total items
$sql = "SELECT COUNT(*) FROM $arkshopdb ORDER by data_criacao ASC";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_row($result);
$total_items = $row[0];

// Get total pages
$total_pages = ceil($total_items / $items_per_page);

// Calculate offset
$offset = ($page_number - 1) * $items_per_page;

// Get users
$sql = "SELECT * FROM $arkshopdb ORDER by points DESC LIMIT $offset, $items_per_page ";
$result = mysqli_query($conn, $sql);

echo '<table border="1" style="font-size:12px; background-color:#ffffff; color:#000000; width:100%;">';
echo '<tr style="width:300px;">';
echo '<th style="width:300px;">STEAM ID</th>';
echo '<th style="width:300px;">PERFIL STEAM</th>';
echo '<th style="width:80px;">PONTOS</th>';
echo '<th style="width:300px;">Kits</th>';
echo '<th style="width:50px;">Cadastro/Servidor</th>';
echo '</tr>';

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td style='padding:5px; width:300px;'><a href='https://steamcommunity.com/profiles/".$row['SteamId']." ' style='font-size:15px;' target='_blank'>".$row['SteamId']."</a> | <a href='perfil.php?steamid=".$row['SteamId']."&id=".$row['Id']."'><span style='font-size:12px; color:#000000; height:12px; width:100px; border:1px solid #dddddd;'>Perfil</span></a></td>";
        echo "<td style='padding:5px; width:300px;'><i class='icon ion-person'></i> ";
	
	
	$steamid = $row['SteamId']; // Substitua pelo ID da Steam do jogador
	// Obtém as informações do perfil do jogador usando a API Steam - Configure no arquivo conex.php
	$get_steamid_bd = $row['SteamId'];
	$json = file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$api_key_steam&steamids=$get_steamid_bd");
	$data = json_decode($json, true);


	if(isset($data['response']['players'][0]['avatar'])){
	$avatar32x32px= $data['response']['players'][0]['avatar']; //URL da imagem de perfil completa do jogador
	} else {
	echo " | ERRo | ";
	}

	if(isset($data['response']['players'][0]['personaname'])){
	$personaname = $data['response']['players'][0]['personaname']; //nome do jogador na Steam
	} else {
	echo "ERRo | ";
	}

	if(isset($data['response']['players'][0]['personastate'])){
	$personastate = $data['response']['players'][0]['personastate']; //estado atual do jogador (offline, ocupado, ausente, etc.)
	} else {
	echo "ERRo | ";
	}
	
	
	//status do jogador na steam
	if(isset($data['response']['players'][0]['personaname'])){
	echo $personaname." | ";
	} else {
	echo " ERRo | ";
	}
	if(isset($data['response']['players'][0]['personastate'])){
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
	} else {
	echo " ERRo";
	}
		echo "</td>";
        echo "<td>".$row["Points"]."</td>";
		
		
		echo '<td>';
		
		$text = $row["Kits"];

		$items = explode(",", $text);
		$count = count($items);

		for ($i = 0; $i < $count; $i++) {
		${'item' . ($i + 1)} = $items[$i];
		}

		for ($i = 1; $i <= $count; $i++) {
		echo "Item $i: ${'item' . $i} <br>";
		}

		
		
		echo '</td>';
		echo "<td style='padding:5px; width:300px;'>".date('d/m/Y <br> H:i', strtotime($row['data_criacao']))."</td>";
        echo '</tr>';
    }
} else {
    echo '<tr>';
    echo '<td colspan="2">0 results</td>';
    echo '</tr>';
}

echo '</table><br>';


echo '<div class="pagination">';
for ($i = 1; $i <= $total_pages; $i++) {
    echo ' <a href="?page='.$i.'" style="padding-left:3px; font-size:10px; ">'.$i.'</a> | ';
}
echo '</div>';

mysqli_close($conn);

?>
	</div>
    </div>
	<?php require('base.php'); ?>
  </body>
</html>
