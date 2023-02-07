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
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@mestre_hakuna">
    <meta name="twitter:creator" content="@mestre_hakuna">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="ARK MANAGER | Mestre Hakuna">
    <meta name="twitter:description" content="ARK MANAGER Mestre Hakuna">
    <meta name="twitter:image" content="img/social.png">

    <!-- Facebook -->
    <meta property="og:url" content="#">
    <meta property="og:title" content="ARK MANAGER Mestre Hakuna">
    <meta property="og:description" content="ARK MANAGER Mestre Hakuna">

    <meta property="og:image" content="img/social.png">
    <meta property="og:image:secure_url" content="img/social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="ARK MANAGER | Mestre Hakuna">
    <meta name="author" content="Mestre Hakuna">

    <title>ARK MANAGER</title>

    <!-- vendor css -->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">

    <link rel="stylesheet" href="css/slim.css">


	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
	$(document).ready(function() {
    $('#search').on('input', function() {
        var search = $(this).val();
        if (search.length >= 3) {
          // Make an AJAX request
          $.ajax({
            type: "GET",
            url: "q.php",
            data: {keyword: search},
            success: function(response) {
              $('#result').html(response);
            }
          });
        } else {
          $('#result').html('');
        }
    });
	});
	</script>
  </head>