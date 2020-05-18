<?php
namespace Phppot;

use \Phppot\Member;

if (! empty($_SESSION["userId"])) {
    require_once __DIR__ . './../class/Member.php';
    $member = new Member();
	
	//Variable actual User ID
	$sessionUserID = $_SESSION['userId'];
    
	// Member datas from ID
	$memberResult = $member->getMemberById($_SESSION["userId"]);
	
	// All Member Array
	$AllMemberResult = $member->getAllMember();
	
	//User ID Variable from SESSION user ID
	$sessionUserID = $_SESSION['userId'];
	
	//Query Profile datas
    if(!empty($memberResult[0]["display_name"])) {
		//Display name and email need in Camreader, Camlist views
        $displayName = ucwords($memberResult[0]["display_name"]);
		$uEmail = ucwords($memberResult[0]["email"]);
    } else {
        $displayName = $memberResult[0]["user_name"];
		$uEmail = $memberResult[0]["email"];
    }
	
	// Admin check
	    if(!empty($memberResult[0]["opt_adm"])) {
        $adminCheck = 1;
    } else {
        $adminCheck = NULL;
    }
}
?>
