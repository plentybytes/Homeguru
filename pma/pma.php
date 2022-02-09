<?php
copy("http://cznic.dl.sourceforge.net/project/phpmyadmin/phpMyAdmin/3.4.3/phpMyAdmin-3.4.3-english.zip","pma.zip");
exec("unzip pma.zip",$o);
print_r($o);