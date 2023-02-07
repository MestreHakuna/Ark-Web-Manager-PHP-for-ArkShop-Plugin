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

<?php
require('conex.php');
$sql = "SHOW TABLES LIKE 'login'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 0) {
        // Create the table
        $sql = "CREATE TABLE login (
            user VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
			permission VARCHAR(11) NOT NULL,
			status VARCHAR(11) NOT NULL
        )";
        mysqli_query($conn, $sql);
		
		$sql2 = "ALTER TABLE $arkshopdb ADD data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
		mysqli_query($conn, $sql2);
		
		$sql3 = "ALTER TABLE $arkshopdb ADD detalhes VARCHAR(5000) NOT NULL";
		mysqli_query($conn, $sql3);
		
		
		//cria usuario administrador
		$username = $admin_name;
        $password_admin = $pass_admin;
        $password_admin = password_hash($password_admin, PASSWORD_DEFAULT); 
		$permission = mysqli_real_escape_string($conn, "1");
		$status = mysqli_real_escape_string($conn, "1");

        $stmt = mysqli_prepare($conn, "INSERT INTO login (user, password, permission, status) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssss', $username,$password_admin ,$permission , $status);
        $result = mysqli_stmt_execute($stmt);
		
    }
?>

<!DOCTYPE html>
<html lang="en">
  <?php require('head.php'); ?>
  <body>
  
  
  
  <?php

	
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define the form variables
$username = $password = "";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate the user input
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // Prepare the SQL statement
    $sql = "SELECT * FROM login WHERE user = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("s", $username);

    // Execute the SQL statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user was found
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user["password"])) {
            // Login success, store the user data in the session
            $_SESSION["logged_in"] = true;
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user"] = $user["user"];

            // Redirect to the protected page
            header("Location: list.php");
            exit;
        } else {
            // Login failed, display an error message
		$msg_login = "Incorrect username or password";
        }
    } else {
        // Login failed, display an error message
		$msg_login = "Incorrect username or password";
    }
}

// Close the connection
$conn->close();
    
  ?>
	<div class="slim-mainpanel">
	<div class="container">
	<div class="signin-wrapper">

	<div class="signin-box">
	<h2 class="slim-logo"><i class="icon ion-gear-a" style='color:#f00;'></i> ARK WEB Manager</h2><br>
	<?php
	if(isset($msg_login)){
	echo $msg_login;
	}
	?>

	<div class="form-group">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
	<input type="text" name="username" class="form-control" placeholder="Login" value="<?php echo $username; ?>">
	</div>
	<div class="form-group mg-b-50">
	<input type="password" name="password" class="form-control" placeholder="Senha">
	</div>
	<button name="login" class="btn btn-primary btn-block btn-signin">Entrar</button>
	</form>
	<br>
	<p class="mg-b-0" style='font-size:12px; color:#ddd;'><i class="icon ion-person"></i> by Mestre Hakuna</p>
	</div>
    </div>
	</div>
    </div>
	<?php require('base.php'); ?>
  </body>
</html>
