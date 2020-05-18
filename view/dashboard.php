<?php
    require_once './view/userboard.php';
?>
<html>
<head>
<title>User Login</title>
<meta name="viewport" content="width=device-width, user-scalable=no">
<link href="./view/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div>
        <div class="dashboard">
            <div class="member-dashboard">Welcome <b><?php echo $displayName; ?></b><?php echo " UID(" . $sessionUserID . ")"; echo " [" . $uEmail . "]"; ?> 
			    <br />Dashboard menu<br />
				
				<?php
				if ($adminCheck != NULL) {
					?>
				<a href="./userlist.php" class="logout-button">USERLIST</a><br>
				<?php } ?>
			    <a href="./camlist.php" class="logout-button">CAMLIST</a><br>
                Click to <a href="./logout.php" class="logout-button">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>