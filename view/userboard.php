<?php
namespace Phppot;

use \Phppot\Member;

if (! empty($_SESSION["userId"])) {
    require_once __DIR__ . './../class/Member.php';
    $member = new Member();
    $memberResult = $member->getMemberById($_SESSION["userId"]);
    if(!empty($memberResult[0]["display_name"])) {
        $displayName = ucwords($memberResult[0]["display_name"]);
		$uEmail = ucwords($memberResult[0]["email"]);
    } else {
        $displayName = $memberResult[0]["user_name"];
		$uEmail = $memberResult[0]["email"];
    }
}
?>
