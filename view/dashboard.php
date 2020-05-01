<?php
namespace Phppot;

use \Phppot\Member;

if (! empty($_SESSION["userId"])) {
    require_once __DIR__ . './../class/Member.php';
    $member = new Member();
    $memberResult = $member->getMemberById($_SESSION["userId"]);
	//Profile datas
    if(!empty($memberResult[0]["display_name"])) {
        $displayName = ucwords($memberResult[0]["display_name"]);
		$uEmail = ucwords($memberResult[0]["email"]);
    } else {
        $displayName = $memberResult[0]["user_name"];
		$uEmail = $memberResult[0]["email"];
    }
	// Admin check
	    if(!empty($memberResult[0]["opt_adm"])) {
        //$adminCheck = "Yes. An admin";
    } else {
        //$adminCheck = "Not admin";
    }
}
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
            <div class="member-dashboard">Welcome <b><?php echo $displayName; ?></b><?php echo " UID(" . $_SESSION["userId"] . ")"; echo " [" . $uEmail . "]"; ?> 
			    <br />Dashboard menu<br />
				<br />
			    <a href="./camlist.php" class="logout-button">CAMLIST</a><br>
                Click to <a href="./logout.php" class="logout-button">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>