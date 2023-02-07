<?php
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////LICENCA LIBERADA PARA USO DESDE QUE SE MANTENHA OS DIREITOS AUTORAIS////
//////DESENVOLVIDO POR: MESTRE HAKUNA ////////////////////////////////////////
//////CRIADO EM: 03/02/2023///////MODIFICADO EM: 03/02/2023///////////////////
//////DISCORD: MESTRE HAKUNA#9901/////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
?>
<div class="slim-header">
      <div class="container">
        <div class="slim-header-left">
          <h2 class="slim-logo"><a href="list.php">ARK WEB<span> Manager</span></a></h2>


        </div><!-- slim-header-left -->
        <div class="slim-header-right">
          <div class="dropdown dropdown-a">
            <a href="" class="header-notification" data-toggle="dropdown">
			<i class="fa fa-envelope-o"></i>
			<?php
			echo "<span class='indicator bg-warning'></span>";
			?>
            </a>
            <div class="dropdown-menu">
              <div class="dropdown-menu-header">
                <h6 class="dropdown-menu-title">ULTIMOS CADASTROS</h6>
                <div>
                  ...
                </div>
              </div>
              <div class="dropdown-activity-list" style='max-height:500px; overflow: scroll; overflow-x: hidden;'>
			<div class="activity-label">Hoje</div>
			<?php
			$sql_day_now = "SELECT * FROM $arkshopdb WHERE Year(data_criacao)='$ano_atual' AND MONTH(data_criacao)='$mes_atual' AND DAY(data_criacao) = '$dia_atual'";
			$result_day_now = mysqli_query($conn, $sql_day_now);
			while($row_day_now = mysqli_fetch_assoc($result_day_now)) {
			echo "
			<div class='activity-item'>
                  <div class='row no-gutters'>
                    <div class='col-2 tx-right'>".date('H:i', strtotime($row_day_now['data_criacao']))."</div>
                    <div class='col-2 tx-center'><span class='square-10 bg-success'></span></div>
                    <div class='col-8'><a href='https://steamcommunity.com/profiles/".$row_day_now['SteamId']."' target='_blank'>".$row_day_now['SteamId']."</a></div>
                  </div>
                </div>
			";
			}
			?>

			<div class="activity-label">Ontem</div>
			<?php
			$dia_anterior = $dia_atual - 1;
			$sql = "SELECT * FROM $arkshopdb WHERE Year(data_criacao)='$ano_atual' AND MONTH(data_criacao)='$mes_atual' AND DAY(data_criacao) = '$dia_anterior'";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_assoc($result)) {
			echo "
			<div class='activity-item'>
                  <div class='row no-gutters'>
                    <div class='col-2 tx-right'>".date('H:i', strtotime($row['data_criacao']))."</div>
                    <div class='col-2 tx-center'><span class='square-10 bg-success'></span></div>
                    <div class='col-8'><a href='https://steamcommunity.com/profiles/".$row['SteamId']."' target='_blank'>".$row['SteamId']."</a></div>
                  </div>
                </div>
			";
			}
			?>
              </div>
            </div>
          </div>

          <div class="dropdown dropdown-c">
			<a href="#" class="logged-user" data-toggle="dropdown">
			<i class="icon ion-person" style='color:#ffffff;'></i>
			<span style='color:#ffffff;'><?php echo $_SESSION['user']; ?></span>
			<i class="fa fa-angle-down"></i>
			</a>
            <div class="dropdown-menu dropdown-menu-right">
			<nav class="nav">
			<a href="logout.php" class="nav-link"><i class="icon ion-forward"></i> Sair</a>
			</nav>
            </div>
          </div>
        </div>
      </div>
    </div>