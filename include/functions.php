<?php

function getCategoryTree($cat_id,$array){
      //$array = array();
      $array[]=$cat_id;
      $parent=getParent($cat_id);
      if($parent!=0){
          $array[]=$parent;
         return( getCategoryTree($parent,$array)); 
           
      }else{
          $tree='';
          
          if($array!=''){
          $array=array_unique($array);
          $array=array_reverse($array);
          foreach($array as $key=>$val){
              $tree= $tree.getMainCategory($val)." > ";
          }
          return( substr( $tree,0,-2));
          }else{
              return( 'Main Category');
              }
      }
            
}


function getUserNotificationCount($uid,$sender_id){
$sql=$GLOBALS['obj']->query("select count(id) as total from tbl_message  where reciver_id='".$uid."' and sender_id='".$sender_id."'  and read_status='0' order by id desc ");
$result=mysqli_fetch_assoc($sql);
return $result['total'];
} 


function getUserName($uid){
$sql=$GLOBALS['obj']->query("select * from tbl_admin where id='".$uid."'",-1);
$result=mysqli_fetch_assoc($sql);

if (!empty($result['full_name'])) {
    $name=stripslashes(ucfirst($result['full_name']));    
} 

return $name;
}


function getUserLastMessage($uid,$reciver_id){
  $sql=$GLOBALS['obj']->query("select * from tbl_message  where sender_id='".$uid."' and reciver_id='$reciver_id' order by id desc limit 0,1",$debug=-1);
  $num = mysqli_num_rows($sql);
  if($num > 0){
    $result=mysqli_fetch_assoc($sql);
  }else{
    $result = "";
  }
  return $result;
}


function getMainCategory($catid){
    $sql=$GLOBALS['obj']->query("select maincategory from  tbl_maincategory where id='$catid'");
    $result=mysqli_fetch_assoc($sql);
    return ($result['maincategory']);
}

function currency($cur_id) {
	if($cur_id==1){
		return "$";
	}else if($cur_id==2){
		return "&euro;";
	}else if($cur_id==3){
		return "&pound;";
	}else if($cur_id==4){
		return "A$";
	}else if($cur_id==5){
		return "C$";
	}else if($cur_id==6){
		return "Rs";
	}
}

function getTotalCredit($pro_id) {
    $sql = $GLOBALS['obj']->query("select sum(credit_amount) as tot_Cr from tbl_credit where pro_id='" . $pro_id . "' and type='Cr' and status=1");
    $result = mysqli_fetch_assoc($sql);
    $Psql = $GLOBALS['obj']->query("select sum(credit_amount) as tot_PCr from tbl_credit where pro_id='" . $pro_id . "' and type='Dr' and status=1");
    $Presult = mysqli_fetch_assoc($Psql);
    return stripslashes($result['tot_Cr'] - $Presult['tot_PCr']);
}

function getTotalAmount($pro_id, $field,$type) {
    $sql = $GLOBALS['obj']->query("select sum($field) as tot_amt from tbl_credit where pro_id='" . $pro_id . "' and type='".$type."' and status=1");
    $result = mysqli_fetch_assoc($sql);
    return stripslashes($result['tot_amt']);
}

function getTotalTax($pro_id, $field) {
    $sql = $GLOBALS['obj']->query("select sum($field) as tot_amt from tbl_invoice where pro_id='" . $pro_id . "' and status=1");
    $result = mysqli_fetch_assoc($sql);
    return stripslashes($result['tot_amt']);
}

function getCategoryArray($cat_id, $array) {
    $array[] = $cat_id;
    $parent = getParent($cat_id);
    if ($parent != 0) {
        $array[] = $parent;
        return( getCategoryArray($parent, $array));
    } else {

        $array = array_unique($array);
        $array = array_reverse($array);
        return($array);
    }
}

function getMainParent($cat_id) {
    $arr = getCategoryArray($cat_id, $array = '');
    return ($arr[0]);
}

function getParent($pid) {
    $sql = $GLOBALS['obj']->query("select parent_id from  tbl_maincategory where id='$pid'");
    $result = mysqli_fetch_assoc($sql);
    return ($result['parent_id']);
}

function getParentname($p_id) {
    $sql = $GLOBALS['obj']->query("select maincategory from  tbl_maincategory where id='$p_id'");
    $result = mysqli_fetch_assoc($sql);
    return ($result['maincategory']);
}

function getgrandParent($p_id) {
    $sql = $GLOBALS['obj']->query("select maincategory from  tbl_maincategory where id='$p_id'");
    $result = mysqli_fetch_assoc($sql);
    return ($result['maincategory']);
}

function dateDiff ($d1, $d2) {
  $days =  round((abs(strtotime($d1)-strtotime($d2))/86400));
  return round($days+1);
  // if($days>30){
  //   $datediff =  round($days/30)." Months";
  // }else if($days>6 && $days<30){
  //   $datediff =  round($days/7)." Weeks";
  // }else if($days>0 && $days<6){
  //   $datediff =  $days." Days";
  // }
  // return $datediff;
}


function timeDiff ($d1, $d2) {
  $start_date = new DateTime($d1); 
  $since_start = $start_date->diff(new DateTime($d2)); 
  $time =  $since_start->h.' Hours</br>'; 
  $time .= $since_start->i.' Minutes'; 
  return $time;
}

function timeDiff1 ($d1, $d2) {
  $start_date = new DateTime($d1); 
  $since_start = $start_date->diff(new DateTime($d2)); 
  $time =  $since_start->h; 

  return $time;
}

function gettimeDiff ($d1, $d2) {
  $difference = round(abs($d2 - $d1) / 60,2);
  return $difference;
}

function CalculateOrderTime($order_date) {
    $order_time = '';
    $diff = abs(time() - strtotime($order_date));
    $years = floor($diff / (365 * 60 * 60 * 24));
    $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
    $minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / (60));
    $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60));
    if ($years > 0) {
        $order_time.=$years . " Years ";
    }
    if ($months > 0) {
        $order_time.=$months . " Months ";
    }
    if ($days > 0) {
        $order_time.=$days . " Days ";
    }
    if ($hours > 0) {
        $order_time.=$hours . " Hours ";
    }
    if ($minutes > 0) {
        $order_time.=$minutes . " Min ";
    }
    if ($seconds > 0) {
        $order_time.=$seconds . " Sec ";
    }

    $order_time.="  Ago ";
    return($order_time);
}

function generateCouponCode() {
    $chars = "ABCDEFGHJKLMNOPQRSRTUVWXYZ123456789";
    srand((double) microtime() * 1000000);
    $i = 0;
    $randno = '';

    while ($i < 6) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $randno = $randno . $tmp;
        $i++;
    }
    return strtoupper($randno);
}

function getYouTubeVideo($url) {
    $a = explode('v=', $url);
    $b = explode('&', $a[1]);
    return ("http://www.youtube.com/embed/" . $b[0]);
}

function generateSlug($name){
    $newurl=str_replace(" - "," ",$name);
    $newurl=str_replace("&","",$newurl);
    $newurl=str_replace(","," ",$newurl);
    $myurl=str_replace("--","-",str_replace("%","",str_replace(" ","-",str_replace("-"," ",trim(str_replace("/"," ",str_replace(".","",$newurl)))))));
    return $myurl=strtolower($myurl);
}

function buildURL($url) {
    $newurl = str_replace(" - ", " ", $url);
    $myurl = str_replace("--", "-", str_replace("%", "", str_replace(" ", "-", str_replace("-", " ", trim(str_replace("/", " ", str_replace(",", "", str_replace(".", "", $newurl))))))));
    return stripslashes(strtolower($myurl));
}

function parseInput($val) {
    return mysqli_real_escape_string(stripslashes($val));
}

function encryptPassword($val) {
    return sha1($val);
}

function getAdminEmail() {
    $sql = $GLOBALS['obj']->query("select email from tbl_admin  where id=1");
    $result = mysqli_fetch_assoc($sql);
    return ($result['email']);
}

function getFieldWhere($filed, $tbl, $where, $id) {
    $sql = $GLOBALS['obj']->query("select $filed as field from $tbl  where $where='" . $id . "'");
    $result = mysqli_fetch_assoc($sql);
    return (stripslashes($result['field']));
}


function getUser($uid) {
    $sql = $GLOBALS['obj']->query("select uname from tbl_user  where id='" . $uid . "'");
    $result = mysqli_fetch_assoc($sql);
    return (stripslashes(ucfirst($result['uname'])));
}

function getContent($title) {
    $sql = $GLOBALS['obj']->query("select * from tbl_content where title='$title' ");
    $result = mysqli_fetch_assoc($sql);
    return (stripslashes($result['content']));
}

function getField($filed, $table, $id) {

    $sql = $GLOBALS['obj']->query("select $filed as field from $table where id='$id' ");
    $result = mysqli_fetch_assoc($sql);
    return (stripslashes($result['field']));
}

function clearCache() {
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
}

function redirect($url) {
    header("location:$url");
    exit();
}

function validateAdminSession() {
    if (trim($_SESSION["sess_admin_id"]) == "" && trim($_SESSION["sess_admin_logged"]) != "true") {
        $_SESSION["sess_msg"] = "Session is expire. Please login again to continue";
        redirect("login.php");
    }
}

function showSessionMsg() {
    if (trim($_SESSION["sess_msg"])) {
        echo $_SESSION["sess_msg"];
        $_SESSION["sess_msg"] = "";
    }
}

function validate_user() {
    if ($_SESSION['sess_uid'] == '') {
        ms_redirect("index.php?back=$_SERVER[REQUEST_URI]");
    }
}

function validate_admin() {
    if ($_SESSION['sess_admin_id'] == '') {
        ms_redirect("index.php?back=$_SERVER[REQUEST_URI]");
    }
}

function ms_redirect($file, $exit = true, $sess_msg = '') {
    header("Location: $file");
    exit();
}

function sort_arrows($column) {
    global $_SERVER;
    return '<A HREF="' . $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column, 'asc')) . '"><IMG SRC="images/white_up.gif" BORDER="0"></A> <A HREF="' . $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column, 'desc')) . '"><IMG SRC="images/white_down.gif" BORDER="0"></A>';
}

function sort_arrows1($column) {
    global $_SERVER;
    return '<A HREF="' . $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column, 'asc')) . '"><IMG SRC="admin/images/white_up.gif" BORDER="0"></A> <A HREF="' . $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column, 'desc')) . '"><IMG SRC="admin/images/white_down.gif" BORDER="0"></A>';
}

function sort_arrows_front($column, $heading) {
    global $_SERVER;
    return '<A HREF="' . $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column, 'asc')) . '"><img src="images/sort_up.gif" alt="Sort Up" border="0" title="Sort Up"></A>&nbsp;' . $heading . '&nbsp;<A HREF="' . $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column, 'desc')) . '"><img src="images/sort_down.gif" alt="Sort Down" border="0" title="Sort Down"></A>';
}

function sort_arrows_front1($column, $heading) {
    global $_SERVER;
    return '<A HREF="' . $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column, 'asc')) . '"><img src="admin/images/sort_up.gif" alt="Sort Up" border="0" title="Sort Up"></A>&nbsp;' . $heading . '&nbsp;<A HREF="' . $_SERVER['PHP_SELF'] . get_qry_str(array('order_by', 'order_by2'), array($column, 'desc')) . '"><img src="admin/images/sort_down.gif" alt="Sort Down" border="0" title="Sort Down"></A>';
}

function get_qry_str($over_write_key = array(), $over_write_value = array()) {
    global $_GET;
    $m = $_GET;
    if (is_array($over_write_key)) {
        $i = 0;
        foreach ($over_write_key as $key) {
            $m[$key] = $over_write_value[$i];
            $i++;
        }
    } else {
        $m[$over_write_key] = $over_write_value;
    }
    $qry_str = qry_str($m);
    return $qry_str;
}

function qry_str($arr, $skip = '') {
    $s = "?";
    $i = 0;
    foreach ($arr as $key => $value) {
        if ($key != $skip) {
            if (is_array($value)) {
                foreach ($value as $value2) {
                    if ($i == 0) {
                        $s .= "$key%5B%5D=$value2";
                        $i = 1;
                    } else {
                        $s .= "&$key%5B%5D=$value2";
                    }
                }
            } else {
                if ($i == 0) {
                    $s .= "$key=$value";
                    $i = 1;
                } else {
                    $s .= "&$key=$value";
                }
            }
        }
    }
    return $s;
}


function get_ip_address() {
// check for shared internet/ISP IP
if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
return $_SERVER['HTTP_CLIENT_IP'];
}

// check for IPs passing through proxies
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
// check if multiple ips exist in var
if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
$iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
foreach ($iplist as $ip) {
if (validate_ip($ip))
return $ip;
}
} else {
if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
return $_SERVER['HTTP_X_FORWARDED_FOR'];
}
}
if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
return $_SERVER['HTTP_X_FORWARDED'];
if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
return $_SERVER['HTTP_FORWARDED_FOR'];
if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
return $_SERVER['HTTP_FORWARDED'];

// return unreliable ip since all else failed
return $_SERVER['REMOTE_ADDR'];
}
/**
* Ensures an ip address is both a valid IP and does not fall within
* a private network range.
*/
function validate_ip($ip) {
if (strtolower($ip) === 'unknown')
return false;

// generate ipv4 network address
$ip = ip2long($ip);

// if the ip is set and not equivalent to 255.255.255.255
if ($ip !== false && $ip !== -1) {
// make sure to get unsigned long representation of ip
// due to discrepancies between 32 and 64 bit OSes and
// signed numbers (ints default to signed in PHP)
$ip = sprintf('%u', $ip);
// do private network range checking
if ($ip >= 0 && $ip <= 50331647) return false; if ($ip >= 167772160 && $ip <= 184549375) return false; if ($ip >= 2130706432 && $ip <= 2147483647) return false; if ($ip >= 2851995648 && $ip <= 2852061183) return false; if ($ip >= 2886729728 && $ip <= 2887778303) return false; if ($ip >= 3221225984 && $ip <= 3221226239) return false; if ($ip >= 3232235520 && $ip <= 3232301055) return false; if ($ip >= 4294967040) return false;
}
return true;
}


function getUserPresentDay($user_id,$month,$year){
    $sql = $GLOBALS['obj']->query("select id from tbl_login_time  where user_id='".$user_id."' and YEAR(login_date) = $year and MONTH(login_date)=$month group by date(login_date)",$debug=-1);
    $result = mysqli_num_rows($sql);
    return ($result);
}

function total_sun($month,$year)
{
    $sundays=0;
    $total_days=cal_days_in_month(CAL_GREGORIAN, $month, $year);
    for($i=1;$i<=$total_days;$i++)
    if(date('N',strtotime($year.'-'.$month.'-'.$i))==7)
    $sundays++;
    return $sundays;
}

function total_sunsat($month,$year)
{
   $str = $year."-".$month;
   $total_days=cal_days_in_month(CAL_GREGORIAN, $month, $year);
   $man = 0;
  for($i2=1; $i2<$total_days; $i2++)
  {
      $ddd = $str."-".$i2;
      $date = date('Y M D d', $time = strtotime($ddd) );
    if( strpos($date, 'Sat') || strpos($date, 'Sun') )
    {
      $man++;
    }
  }
    return $man;
}


function total_hours($user_id,$month,$year)
{
    $sql = $GLOBALS['obj']->query("select min(a.login_time) as login_time,max(a.login_time) as logout_time,a.user_id,a.login_date,a.ip,b.full_name,a.id FROM tbl_login_time as a INNER JOIN tbl_admin as b ON a.user_id=b.id where 1=1 and a.user_id='$user_id' and MONTH(a.login_date)=$month and YEAR(a.login_date)=$year  GROUP by a.user_id,date(a.login_date)",-1);
    $hour=0;
    while($result = mysqli_fetch_assoc($sql)){
        
        $hours = gettimeDiff(strtotime($result['logout_time']),strtotime($result['login_time']));
        $hour = $hour + $hours;
    }

    $hhours = intdiv($hour, 60).':'. ($hour % 60);
    return $hhours;
}



function totalMonthIncome($month,$year)
{
    $sql = $GLOBALS['obj']->query("select sum(amount) as amount,MONTH(a.exp_date)as month, YEAR(a.exp_date) as year FROM tbl_income as a where 1=1 and MONTH(a.exp_date)=$month and YEAR(a.exp_date)=$year",-1);
    $result = mysqli_fetch_assoc($sql);

    if ($result['amount']) {
       return (stripslashes($result['amount']));
    } else {
       return 0;
    }
    
}

function totalMonthExpence($month,$year)
{
    $sql = $GLOBALS['obj']->query("select sum(amount) as amount,MONTH(a.exp_date)as month, YEAR(a.exp_date) as year FROM tbl_expenses as a where 1=1 and MONTH(a.exp_date)=$month and YEAR(a.exp_date)=$year",-1);
    $result = mysqli_fetch_assoc($sql);

    $sql1 = $GLOBALS['obj']->query("select sum(net_salary) as net_salary FROM tbl_salary as a where 1=1 and month=$month and year=$year",-1);
    $result1 = mysqli_fetch_assoc($sql1);

    if ($result['amount']) {
       return (stripslashes($result['amount']) + stripslashes($result1['net_salary']));
    } else {
       return 0;
    }
}


function totalIncome($year)
{
    $sql = $GLOBALS['obj']->query("select sum(amount) as amount,MONTH(a.exp_date)as month, YEAR(a.exp_date) as year FROM tbl_income as a where 1=1 and YEAR(a.exp_date)=$year",-1);
    $result = mysqli_fetch_assoc($sql);

    if ($result['amount']) {
       return (stripslashes($result['amount']));
    } else {
       return 0;
    }
    
}

function totalExpence($year)
{
    $sql = $GLOBALS['obj']->query("select sum(amount) as amount,MONTH(a.exp_date)as month, YEAR(a.exp_date) as year FROM tbl_expenses as a where 1=1 and YEAR(a.exp_date)=$year",-1);
    $result = mysqli_fetch_assoc($sql);
    if ($result['amount']) {
       return (stripslashes($result['amount']));
    } else {
       return 0;
    }
}


function totalJobApply($jobid)
{
    $sql = $GLOBALS['obj']->query("select count(*) as total FROM tbl_job_application as a where 1=1 and job_id='$jobid'",-1);
    $result = mysqli_fetch_assoc($sql);
    if ($result['total']) {
       return (stripslashes($result['total']));
    } else {
       return 0;
    }
}


function totalJobView($jobid)
{
    $sql = $GLOBALS['obj']->query("select count(*) as total FROM tbl_job_view as a where 1=1 and job_id='$jobid'",-1);
    $result = mysqli_fetch_assoc($sql);
    if ($result['total']) {
       return (stripslashes($result['total']));
    } else {
       return 0;
    }
}


function totalJobs()
{
    if($_SESSION['user_type']=='admin'){
      $sql = $GLOBALS['obj']->query("select count(*) as total FROM tbl_jobs as a where 1=1",-1);
    }else if($_SESSION['user_type']=='sales'){
      $sql=$GLOBALS['obj']->query("select count(*) as total from tbl_jobs where sales_id='".$_SESSION['sess_admin_id']."'",$debug=-1);
    }else if($_SESSION['user_type']=='recruiter'){
      $sql=$GLOBALS['obj']->query("select count(*) as total from tbl_jobs where job_status not in (1) ",$debug=-1);
    }

    $result = mysqli_fetch_assoc($sql);
    if ($result['total']) {
       return (stripslashes($result['total']));
    } else {
       return 0;
    }
}

function totalEmployee()
{
    $sql = $GLOBALS['obj']->query("select count(*) as total FROM tbl_users as a where 1=1",-1);
    $result = mysqli_fetch_assoc($sql);
    if ($result['total']) {
       return (stripslashes($result['total'])-1);
    } else {
       return 0;
    }
}


function totalReferral()
{
    $sql = $GLOBALS['obj']->query("select count(*) as total FROM tbl_job_application as a where 1=1",-1);
    $result = mysqli_fetch_assoc($sql);
    if ($result['total']) {
       return (stripslashes($result['total']));
    } else {
       return 0;
    }
}

function totalClient()
{
    $sql = $GLOBALS['obj']->query("select count(*) as total FROM tbl_company as a where 1=1",-1);
    $result = mysqli_fetch_assoc($sql);
    if ($result['total']) {
       return (stripslashes($result['total']));
    } else {
       return 0;
    }
}
?>
