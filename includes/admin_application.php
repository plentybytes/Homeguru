<?php
if (!isSessionRegistered('admin')) {
    $redirect = false;
    $currentPage = basename($PHP_SELF);
    if (($currentPage == "login.php") && !isSessionRegistered("redirect_origin")) {
        $currentPage = "index.php";
        $_GET = array();
    }
    if ($currentPage != "login.php") {
        if (!isSessionRegistered("redirect_origin")) {
            $redirectOrigin = array("page" => $currentPage, "get" => $_GET);
            sessionRegister("redirect_origin", $redirectOrigin);
        }
        $redirect = true;
    }
    if ($redirect == true) {
        redirect(hrefLink(APP_ADMIN_DIR . "login.php"));
    }
    unset($redirect);
}
?>