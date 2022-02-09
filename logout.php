<?php include('includes/application.php');
sessionUnregister("user");
$messageStack->addMessageSession("Logout successfully.", "success");
						redirect(hrefLink("member-login.php"))
						?>
