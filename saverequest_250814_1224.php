<?php
//include('db.php'); 
//include('config/config.php');
include('includes/application.php');
//$date=date("d/m/Y", time());
//$stud_name= rand();
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$tel =  $_REQUEST['tel'];
$message = $_REQUEST['message'];

echo $name;
exit;
//print_r( $publication);
//exit;
//$image4=$_REQUEST['image4'];

//$status ="inactive";

//echo "test";


/*$sql="INSERT INTO `details` (`id`, `subcatid`, `title`, `photos`,`detail`,`price`,`iam`,`selleremail`,`ph`,`sellercity`,`selleradd`,`make`,`model`,`type`,`year`,`milege`,`vin`,`condition`,`estatecity`,`estateadd`, `furnished `,`bedrooms`,`bathrooms`,`pets`,`brokerfee`,`squaremeter`,`company`,`position`,`exp`,`sal`,`jobtitle`) VALUES (NULL, '$subcatid',  '$title', '$photos','$detail','$price','$iam','$selleremail','$ph','$sellercity','$selleradd','$make','$model','$type','$year','$milege','$vin','$condition','$estatecity', '$estateadd','$furnished','$bedrooms','$bathrooms','$pets','$brokerfee','$squaremeter','$company','$position','$exp','$sal','$jobtitle')";*/


/*echo $sql="INSERT INTO `student` (`id`, `subcatid`, `title`, `photos`, `detail`, `price`, `iam`, `selleremail`, `ph`, `sellercity`, `selleradd`, `make`, `model`, `type`, `year`, `milege`, `vin`, `cond`, `estatecity`, `estateadd`, `furnished`, `bedrooms`, `bathrooms`, `pets`, `brokerfee`, `squaremeter`, `company`, `position`, `exp`, `sal`, `jobtitle`) VALUES (NULL, '0', '$title', '$newname', '$detail', '$price', '', '$selleremail', '$ph', '$sellercity', '$selleradd', '', '', '$type', '', '', '', '', '', '', '', '', '', '', '', '', '$company', '$position', '$exp', '$sal', '$jobtitle')";*/

if(!empty($fn) && !empty($ln) && !empty($image2) && !empty($specialization) && !empty($field) && !empty($gen) && !empty($account) && !empty($pass) && !empty($nationality) && !empty($state) && !empty($res) && !empty($cv))
{


    $sql="INSERT INTO `student` (`id`,`fn`,`ln`,`on`, `stud_name`, `specialization`,`field`, `degree_type`, `institution`, `class`, `gpa`, `year`,`degree2`, `institution1`, `year1`, `prof_qualification`, `dob`,`age`, `gen`, `account`, `pass`, `ph`, `address`, `country`, `state`,`nationality`, `organization`, `job_title`, `startdate`, `enddate`, `image1`, `image2`, `image3`, `image4`, `image5`, `cv`, `cover`, `projects`, `publication`,`membership`, `association`,`yearexp`,`monthexp`,`vedio`,`blog`,`twitt`,`facebk`,`pinteres`,`gpls`,`ytube`,`website`) VALUES (NULL,'$fn','$ln','$on', '$stud_name', '$specialization',
'".serialize($field)."', '$degree_type', '$institution', '$class', '$gpa', '$year','".serialize($degree2)."', '$inst1', '0', '".serialize($prof_qualification)."', '$dob','$years', '$gen', '$account', '$pass', '$ph', '$address', '$res', '$state','$nationality', '$organization', '$job_title', '$startdate', '$enddate', '$image1', '$image2', '$image3', '$image4', '$image5', '$cv', '$cover', '".serialize($projects)."', '".serialize($publication)."', '".serialize($membership)."','".serialize($association)."','$yearexp','$cover1','$vedio','$blog','$twitt','$facebk','$pinteres','$gpls','$ytube','$website')";
    $res_insert=mysqli_query($sql);
}

/////////////////////////////////////////////////////end/////////////////////////////////////////////////////////
if($cv1==0)
{


    if($res_insert)
    {
        //echo "hello";exit;
        $sql3="SELECT * FROM `student` order by id DESC LIMIT 1";
        $rs3 =$conn->Execute($sql3);
        $uid=$rs3->fields['id'];

        $inc1=0;
        foreach($institution1 as $arr1){
            if($arr1!='')
            {
                $sql9="INSERT INTO `degree`(`id`,`uid`,`type`,`inst`,`class`,`gpa`,`year`) VALUES (NULL,$uid,'$degree2[$inc1]','$arr1','$class1[$inc1]','$gpa1[$inc1]','$year1[$inc1]')";
                $res9=mysqli_query($sql9);
                $inc1++;
            }
        }
        $inc= 0;
        foreach($organization as $arr){
            //echo $arr.'<br />';
            $sql2="INSERT INTO `experience`(`id`,`uid`,`company`,`jobtitle`,`startmonth`,`startyear`,`endmonth`,`endyear`) VALUES (NULL,$uid,'$arr','$job_title[$inc]','$expmonth[$inc]','$expyear[$inc]','$expmonth1[$inc]','$expyear1[$inc]')";
            $res2=mysqli_query($sql2);
            $inc++;
        }
//


        if($res2)
        {
            //echo "successfully Registered";
            $contactmail= "admin@roborebe.com";
            $message= "Please click the link below to activate your candidate account
 http://".$_SERVER['HTTP_HOST']."/job.php?active=$stud_name";
            $subject="Activate your Roborebe Account";
            $to=$account;
            //Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            //$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";

            // More headers
            $headers .= 'From:"' .$name.'"<"'.$contactmail.'">' . "\r\n";
            //$headers .= 'Cc: myboss@example.com' . "\r\n";

            $send_mail=mail($to,$subject,$message,$headers);
            if(!$send_mail)
            {
                echo "Failed To Send Mail";
            }
            else{
                ?>
                <script>
                    window.location.href='candlogin.php?page_cand=bemember';
                </script>
                <?php
                //$_SESSION['msg']="Thanks for contact with us..";
                //header("location:".$_SERVER['HTTP_REFERER']);
            }
            ?>
            <script>
                //window.location.href='job.php';
            </script>
        <?php


        }
        else
        {
            echo "failed";
        }


    }
    else
    {
        echo "failed";
    }
}
else
{
    ?>
    <script>
        window.location.href='register.php?error=email';
    </script>
<?php
}

?>