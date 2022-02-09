<?php
require("../includes/application.php");
require("../includes/admin_application.php");
$action = (isset($_GET["action"]) ? $_GET["action"] : "");
if (isSessionRegistered("admin")) {
    $action = "logoff";
}

if (!isNull($action)) {
    switch ($action) {
        case "process":
            $username = dbPrepareInput($_POST['username']);
            $password = dbPrepareInput($_POST['password']);

            $checkQuery = dbQuery("SELECT user_id, firstname, lastname FROM admin_user WHERE username='" . dbInput($username) . "' AND password='" . dbInput($password) . "'");
            if (dbNumRows($checkQuery) == 1) {
                $rsAdminUser = dbFetchArray($checkQuery);
                $adminUser = array("id" => $rsAdminUser["user_id"], "firstname" => $rsAdminUser["firstname"], "lastname" => $rsAdminUser["lastname"]);
                sessionRegister("admin", $adminUser);
                if (isSessionRegistered("redirect_origin")) {
                    $redirectOrigin = $_SESSION["redirect_origin"];
                    $page = $redirectOrigin["page"];
                    $getString = "";
                    if (function_exists("http_build_query")) {
                        $getString = http_build_query($redirectOrigin["get"]);
                    }
                    sessionUnregister("redirect_origin");
                    redirect(hrefLink(APP_ADMIN_DIR . $page, $getString));
                } else {
                    redirect(hrefLink(APP_ADMIN_DIR . "index.php"));
                }
            }
            $messageStack->addMessage("Invalid administrator login attempt.", "error");
            break;
        case "logoff";
            sessionUnregister("admin");
            redirect(hrefLink(APP_ADMIN_DIR . "index.php"));
            break;
    }
}

require("header.php");
?>
    <h3>Admin Panel Login</h3>

    <form name="formLogin" id="formLogin"
          action="<?php echo hrefLink(APP_ADMIN_DIR . "login.php", "action=process"); ?>" method="post">
        <fieldset>
            <dl>
                <dt>
                    <label for="email">Username:</label>
                </dt>
                <dd>
                    <input type="text" name="username" id="username" class="medium"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label for="password">Password:</label>
                </dt>
                <dd>
                    <input type="password" name="password" id="password" class="medium"/>
                </dd>
            </dl>
            <dl>
                <dt>
                    <label></label>
                </dt>
                <dd>
                    <input type="checkbox" name="interests[]" id="interests" value=""/>
                    <label class="check_label">Remember me</label>
                </dd>
            </dl>
            <dl class="submit">
                <input type="submit" name="submit" id="submit" value="Enter"/>
            </dl>
        </fieldset>
    </form>
<?php
require("action/footer.php");
?>