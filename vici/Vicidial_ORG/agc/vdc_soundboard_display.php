<?php
# vdc_soundboard_display.php
# 
# Copyright (C) 2016  Matt Florell <vicidial@gmail.com>    LICENSE: AGPLv2
#
# This script is designed display the contents of an audio soundboard in the system
#
# CHANGELOG:
# 140708-1030 - First build of script
# 141126-0754 - Code updates and added progress timer within top STOP button
# 141216-2135 - Added language settings lookups and user/pass variable standardization
# 160428-1848 - Fix for user_authorization
# 161103-1656 - Added Agent Debug Logging
# 161111-1647 - Added HIDENUMBERS display option, Font size, button type and layout options
#

$version = '2.12-6';
$build = '161111-1647';

require_once("dbconnect_mysqli.php");
require_once("functions.php");

$bcrypt=1;

if (isset($_GET["DB"]))					{$DB=$_GET["DB"];}
	elseif (isset($_POST["DB"]))		{$DB=$_POST["DB"];}
if (isset($_GET["soundboard_id"]))			{$soundboard_id=$_GET["soundboard_id"];}
	elseif (isset($_POST["soundboard_id"]))	{$soundboard_id=$_POST["soundboard_id"];}
if (isset($_GET["avatar_id"]))			{$avatar_id=$_GET["avatar_id"];}
	elseif (isset($_POST["avatar_id"]))	{$avatar_id=$_POST["avatar_id"];}
if (isset($_GET["user"]))				{$user=$_GET["user"];}
	elseif (isset($_POST["user"]))		{$user=$_POST["user"];}
if (isset($_GET["pass"]))				{$pass=$_GET["pass"];}
	elseif (isset($_POST["pass"]))		{$pass=$_POST["pass"];}
if (isset($_GET["server_ip"]))			{$server_ip=$_GET["server_ip"];}
	elseif (isset($_POST["server_ip"]))	{$server_ip=$_POST["server_ip"];}
if (isset($_GET["session_id"]))				{$session_id=$_GET["session_id"];}
	elseif (isset($_POST["session_id"]))	{$session_id=$_POST["session_id"];}
if (isset($_GET["session_name"]))			{$session_name=$_GET["session_name"];}
	elseif (isset($_POST["session_name"]))	{$session_name=$_POST["session_name"];}
if (isset($_GET["stage"]))				{$stage=$_GET["stage"];}
	elseif (isset($_POST["stage"]))		{$stage=$_POST["stage"];}
if (isset($_GET["submit_button"]))			{$submit_button=$_GET["submit_button"];}
	elseif (isset($_POST["submit_button"]))	{$submit_button=$_POST["submit_button"];}
if (isset($_GET["admin_submit"]))			{$admin_submit=$_GET["admin_submit"];}
	elseif (isset($_POST["admin_submit"]))	{$admin_submit=$_POST["admin_submit"];}
if (isset($_GET["bgcolor"]))			{$bgcolor=$_GET["bgcolor"];}
	elseif (isset($_POST["bgcolor"]))	{$bgcolor=$_POST["bgcolor"];}
if (isset($_GET["bcrypt"]))				{$bcrypt=$_GET["bcrypt"];}
	elseif (isset($_POST["bcrypt"]))	{$bcrypt=$_POST["bcrypt"];}


if ($bcrypt == 'OFF')
	{$bcrypt=0;}

header ("Content-type: text/html; charset=utf-8");
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0

$txt = '.txt';
$StarTtime = date("U");
$NOW_DATE = date("Y-m-d");
$NOW_TIME = date("Y-m-d H:i:s");
$CIDdate = date("mdHis");
$ENTRYdate = date("YmdHis");
$MT[0]='';
$agents='@agents';
$script_height = ($script_height - 20);
if (strlen($bgcolor) < 6) {$bgcolor='FFFFFF';}

$IFRAME=0;
$wav='.wav';
$gsm='.gsm';

$user = preg_replace("/\'|\"|\\\\|;| /","",$user);
$pass = preg_replace("/\'|\"|\\\\|;| /","",$pass);

#############################################
##### START SYSTEM_SETTINGS AND USER LANGUAGE LOOKUP #####
$VUselected_language = '';
$stmt="SELECT selected_language from vicidial_users where user='$user';";
if ($DB) {echo "|$stmt|\n";}
$rslt=mysql_to_mysqli($stmt, $link);
	if ($mel > 0) {mysql_error_logging($NOW_TIME,$link,$mel,$stmt,'00XXX',$user,$server_ip,$session_name,$one_mysql_log);}
$sl_ct = mysqli_num_rows($rslt);
if ($sl_ct > 0)
	{
	$row=mysqli_fetch_row($rslt);
	$VUselected_language =		$row[0];
	}

$stmt = "SELECT use_non_latin,timeclock_end_of_day,agentonly_callback_campaign_lock,active_modules,enable_languages,language_method,agent_soundboards FROM system_settings;";
$rslt=mysql_to_mysqli($stmt, $link);
if ($DB) {echo "$stmt\n";}
$qm_conf_ct = mysqli_num_rows($rslt);
if ($qm_conf_ct > 0)
	{
	$row=mysqli_fetch_row($rslt);
	$non_latin =							$row[0];
	$timeclock_end_of_day =					$row[1];
	$agentonly_callback_campaign_lock =		$row[2];
	$active_modules =						$row[3];
	$SSenable_languages =					$row[4];
	$SSlanguage_method =					$row[5];
	$SSagent_soundboards =					$row[6];
	}
##### END SETTINGS LOOKUP #####
###########################################

if ($non_latin < 1)
	{
	$user=preg_replace("/[^-_0-9a-zA-Z]/","",$user);
	$pass=preg_replace("/[^-_0-9a-zA-Z]/","",$pass);
	$soundboard_id=preg_replace("/[^-_0-9a-zA-Z]/","",$soundboard_id);
	$avatar_id=preg_replace("/[^-_0-9a-zA-Z]/","",$avatar_id);
	$session_name=preg_replace("/[^-_0-9a-zA-Z]/","",$session_name);
	}
else
	{
	$user=preg_replace("/\'|\"|\\\\|;| /","",$user);
	$pass=preg_replace("/\'|\"|\\\\|;| /","",$pass);
	$soundboard_id=preg_replace("/\'|\"|\\\\|;| /","",$soundboard_id);
	$avatar_id=preg_replace("/\'|\"|\\\\|;| /","",$avatar_id);
	$session_name=preg_replace("/[^-_0-9a-zA-Z]/","",$session_name);
	}


# default optional vars if not set
if (!isset($format))   {$format="text";}
	if ($format == 'debug')	{$DB=1;}
if (!isset($ACTION))   {$ACTION="refresh";}
if (!isset($query_date)) {$query_date = $NOW_DATE;}
if ( (strlen($soundboard_id) < 1) and (strlen($avatar_id) > 0) ) {$soundboard_id=$avatar_id;}

$auth=0;
$auth_message = user_authorization($user,$pass,'',0,$bcrypt,0,0);
if ($auth_message == 'GOOD')
	{$auth=1;}

$stmt="SELECT count(*) from vicidial_users where user='$user' and active='Y';";
if ($DB) {echo "|$stmt|\n";}
$rslt=mysql_to_mysqli($stmt, $link);
$row=mysqli_fetch_row($rslt);
$VUexists=$row[0];

$stmt="SELECT count(*) from vicidial_live_agents where user='$user';";
if ($DB) {echo "|$stmt|\n";}
$rslt=mysql_to_mysqli($stmt, $link);
$row=mysqli_fetch_row($rslt);
$LVAactive=$row[0];

$stmt="SELECT count(*) from web_client_sessions where session_name='$session_name';";
if ($DB) {echo "|$stmt|\n";}
$rslt=mysql_to_mysqli($stmt, $link);
$row=mysqli_fetch_row($rslt);
$WCSactive=$row[0];

if ( (!preg_match("/soundboard/i",$active_modules)) and ($SSagent_soundboards < 1) )
	{
	echo _QXZ("Soundboards disabled on your system")."\n";
	exit;
	}

if ( (strlen($user)<2) or (strlen($pass)<2) or ($auth==0) or ( ( ($LVAactive < 1) or ($WCSactive < 1) ) and ($VUexists < 1) ) )
	{
	echo _QXZ("Invalid Username/Password").": |$user|$pass|$auth_message|$LVAactive|$WCSactive|$VUexists|\n";
	exit;
	}
else
	{
	# do nothing for now
	}

$stmt="SELECT avatar_id,avatar_name,avatar_notes,avatar_api_user,avatar_api_pass,active,audio_functions,user_group,audio_display,soundboard_layout,columns_limit from vicidial_avatars where avatar_id='$soundboard_id' and active='Y';";
if ($DB) {echo "$stmt\n";}
$rslt=mysql_to_mysqli($stmt, $link);
$soundboard_ct = mysqli_num_rows($rslt);
if ($soundboard_ct > 0)
	{
	$row=mysqli_fetch_row($rslt);
	$soundboard_id =		$row[0];
	$avatar_name =		$row[1];
	$avatar_notes =		$row[2];
	$avatar_api_user =	$row[3];
	$avatar_api_set =	$row[4];
	$active =			$row[5];
	$audio_functions =	$row[6];
	$user_group =		$row[7];
	$audio_display =	$row[8];
	$soundboard_layout = $row[9];
	$columns_limit =	$row[10];
	}
else
	{
	echo _QXZ("error: soundboard not valid")."\n";
	exit;
	}


$stmt="SELECT vdc_agent_api_access,user_level from vicidial_users where user='$avatar_api_user' and active='Y' and vdc_agent_api_access='1';";
if ($DB) {echo "$stmt\n";}
$rslt=mysql_to_mysqli($stmt, $link);
$api_user_ct = mysqli_num_rows($rslt);
if ($api_user_ct > 0)
	{
	$row=mysqli_fetch_row($rslt);
	$api_access =		$row[0];
	$api_level =		$row[1];
	}
else
	{
	echo _QXZ("error: API user not valid")."\n";
	exit;
	}
$api_set_enc = base64_encode($avatar_api_set);

### BEGIN display soundboard content ###
echo "<html>\n";
echo "<head>\n";
echo "<!-- "._QXZ("VERSION").": $version     "._QXZ("BUILD").": $build    "._QXZ("USER").": $user -->\n";
echo "<title>"._QXZ("Agent Audio Soundboard Display Script")."</title>\n";
?>

<script language="Javascript">
var DB = '<?php echo $DB ?>';
var agent_user = '<?php echo $user ?>';
var api_user = '<?php echo $avatar_api_user ?>';
var api_sname = '<?php echo $session_name ?>';
var api_set = '<?php echo $api_set_enc ?>';
var api_level = '<?php echo $api_level ?>';
var last_played_id = '';
var last_over_id = '';
var regTOP = new RegExp("TOP---","g");
var next_color = '';
var last_action = '';
var countdown_active=0;
var countdown_length=0;
var countdown_length_new=0;
var countdown_length_px=0;
var countdown_counter=0;
var countdown_counter_new=0;
var countdown_bar=0;
var countdown_reset=1;
var refresh_interval=99;
var ten_count=0;
var soundboard_event_log='';
var SQLdate='';
get_date();

function countdown_run()
	{
	if (countdown_reset > 0)
		{
		countdown_counter=countdown_counter_new;
		countdown_length=countdown_length_new;
		countdown_reset=0;
		}
	
	if ( (countdown_active > 0) && (countdown_counter > -1) )
		{
		var bar_length = 300;
		countdown_length_px = parseInt( (bar_length / (countdown_length * 10) ) * ( (countdown_counter * 10) - ten_count) );
		if (countdown_length_px < 0)
			{countdown_length_px=0;}
		var countdown_length_px_alt = (bar_length - countdown_length_px);
		document.getElementById('stop_progress').innerHTML = "<table width=300 height=5 border=0 cellpadding=0 cellspacing=0 bgcolor=white><tr><td width=" + countdown_length_px_alt + " bgcolor=white> </td><td width=" + countdown_length_px + " bgcolor=black></td></tr></table>";

		ten_count++;
		if (ten_count > 9)
			{
			ten_count=0;
			countdown_counter = (countdown_counter - 1);
			if (countdown_counter < 0)
				{
				get_date();
			//	soundboard_event_log = soundboard_event_log + "" + SQLdate + "-----SB_done_playing---|";
				document.getElementById("countdown_audio").innerHTML = '';
				document.getElementById("last_action_auto").innerHTML = 'audio done playing';
				document.getElementById('stop_progress').innerHTML = '';
				countdown_active=0;
				countdown_length=0;
				countdown_length_px=0;
				countdown_counter=0;
				countdown_bar=0;
				}
			else
				{
				document.getElementById("countdown_audio").innerHTML = countdown_counter;
				}
			}
		document.getElementById("last_action_auto").innerHTML = countdown_counter + "|" + countdown_length_px;
		}
	}

function over_cell(temp_cell)
	{
	if (temp_cell.length > 0)
		{
		document.getElementById("debugsoundboardspan").innerHTML = temp_cell;
		if (last_over_id != '')
			{
			next_color = '#e5e5e5';
			if (last_over_id.match(regTOP))
				{next_color = '#d6d6d6';}
			if (last_over_id == last_played_id)
				{next_color = '#99FF99';}
			document.getElementById(last_over_id).bgColor = next_color;
			}
		last_over_id = temp_cell;
		document.getElementById(temp_cell).bgColor = '#FFFF99';
		}
	}

function out_cell(temp_cell)
	{
	document.getElementById("debugsoundboardspan").innerHTML = temp_cell;
	if (last_over_id != '')
		{
		next_color = '#e5e5e5';
		if (last_over_id.match(regTOP))
			{next_color = '#d6d6d6';}
		if (temp_cell == last_played_id)
			{next_color = '#99FF99';}
		document.getElementById(last_over_id).bgColor = next_color;
		}
	last_over_id = temp_cell;
	next_color = '#e5e5e5';
	if (last_over_id.match(regTOP))
		{next_color = '#d6d6d6';}
	if (temp_cell == last_played_id)
		{next_color = '#99FF99';}
	document.getElementById(temp_cell).bgColor = next_color;
	}

function clean_var(s) 
	{
	var e={},i,b=0,c,x,l=0,a,r='',w=String.fromCharCode,L=s.length;
	var A="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
	for(i=0;i<64;i++){e[A.charAt(i)]=i;}
	for(x=0;x<L;x++)
		{
		c=e[s.charAt(x)];b=(b<<6)+c;l+=6;
		while(l>=8){((a=(b>>>(l-=8))&0xff)||(x<(L-2)))&&(r+=w(a));}
		}
//	document.getElementById("debugsoundboardspan").innerHTML = '|' + s + '|' + r + '|';
	return r;
	}

function get_date()
	{
	var t = new Date();
	var year= t.getYear()
	var month= t.getMonth()
		month++;
	var daym= t.getDate()
	var hours = t.getHours();
	var min = t.getMinutes();
	var sec = t.getSeconds();
	if (year < 1000) {year+=1900}
	if (month< 10) {month= "0" + month}
	if (daym< 10) {daym= "0" + daym}
	if (hours < 10) {hours = "0" + hours;}
	if (min < 10) {min = "0" + min;}
	if (sec < 10) {sec = "0" + sec;}
	SQLdate = year + "-" + month + "-" + daym + " " + hours + ":" + min + ":" + sec;
	}

function stop_audio()
	{
	get_date();
	soundboard_event_log = soundboard_event_log + "" + SQLdate + "-----SB_stop_audio---" + countdown_counter + " seconds|";
	document.getElementById("debugsoundboardspan").innerHTML = 'stop audio';
	last_action = 'stop audio';
	document.getElementById('last_action_span').innerHTML = last_action;

	var xmlhttp=false;
	/*@cc_on @*/
	/*@if (@_jscript_version >= 5)
	// JScript gives us Conditional compilation, we can cope with old IE versions.
	// and security blocked creation of the objects.
	 try {
	  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	 } catch (e) {
	  try {
	   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	  } catch (E) {
	   xmlhttp = false;
	  }
	 }
	@end @*/
	if (!xmlhttp && typeof XMLHttpRequest!='undefined')
		{
		xmlhttp = new XMLHttpRequest();
		}
	if (xmlhttp) 
		{
		http://server/agc/api.php?source=test&user=6666&pass=1234&agent_user=1000&function=audio_playback&value=ss-noservice&stage=PLAY&dial_override=Y

		PLAY_query = "source=soundboard&stage=STOP&function=audio_playback&user=" + api_user + "&pass=" + clean_var(api_set) + "&agent_user=" + agent_user + "&agent_debug=" + soundboard_event_log;
		document.getElementById("debugsoundboardAJAXspanIN").innerHTML = PLAY_query;
		xmlhttp.open('POST', 'api.php'); 
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlhttp.send(PLAY_query); 
		xmlhttp.onreadystatechange = function() 
			{ 
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
				document.getElementById("debugsoundboardAJAXspanOUT").innerHTML = xmlhttp.responseText;
		//		alert(xmlhttp.responseText);
				}
			}
		delete xmlhttp;
		soundboard_event_log='';
		}
	countdown_active=0;
	countdown_length=0;
	countdown_length_px=0;
	countdown_counter=0;
	countdown_bar=0;
	document.getElementById("countdown_audio").innerHTML = '';
	document.getElementById('stop_progress').innerHTML = '';
	}

function click_cell(temp_cell)
	{
	document.getElementById("debugsoundboardspan").innerHTML = temp_cell;
	if (last_played_id != '')
		{
		next_color = '#e5e5e5';
		if (last_played_id.match(regTOP))
			{next_color = '#d6d6d6';}
		document.getElementById(last_played_id).bgColor = next_color;
		}
	last_played_id = temp_cell;
	document.getElementById(temp_cell).bgColor = '#99FF99';
	last_action = 'play audio';
	document.getElementById('last_action_span').innerHTML = last_action;

	var temp_cell_array = temp_cell.split("---");
	var temp_audio_file = temp_cell_array[1];
	countdown_active=1;
	if (temp_cell_array[0] == 'TOP')
		{countdown_counter_new=temp_cell_array[5];}
	else
		{countdown_counter_new=temp_cell_array[7];}
	countdown_counter_new++;
	document.getElementById("countdown_audio").innerHTML = countdown_counter_new;
	countdown_length_new=countdown_counter_new;
	countdown_reset=1;
	get_date();
	soundboard_event_log = soundboard_event_log + "" + SQLdate + "-----SB_click_cell---" + temp_audio_file + "--" + countdown_counter_new + " seconds--" + temp_cell_array[0] + "--" + temp_cell_array[2] + "--" + temp_cell_array[3] + "--" + temp_cell_array[4] + "|";

	var xmlhttp=false;
	/*@cc_on @*/
	/*@if (@_jscript_version >= 5)
	// JScript gives us Conditional compilation, we can cope with old IE versions.
	// and security blocked creation of the objects.
	 try {
	  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	 } catch (e) {
	  try {
	   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	  } catch (E) {
	   xmlhttp = false;
	  }
	 }
	@end @*/
	if (!xmlhttp && typeof XMLHttpRequest!='undefined')
		{
		xmlhttp = new XMLHttpRequest();
		}
	if (xmlhttp) 
		{
		// http://server/agc/api.php?source=test&user=6666&pass=1234&agent_user=1000&function=audio_playback&value=ss-noservice&stage=PLAY&dial_override=Y

		PLAY_query = "source=soundboard&stage=PLAY&dial_override=Y&function=audio_playback&user=" + api_user + "&pass=" + clean_var(api_set) + "&agent_user=" + agent_user + "&value=" + temp_audio_file + "&agent_debug=" + soundboard_event_log;
		document.getElementById("debugsoundboardAJAXspanIN").innerHTML = PLAY_query;
		xmlhttp.open('POST', 'api.php'); 
		xmlhttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
		xmlhttp.send(PLAY_query); 
		xmlhttp.onreadystatechange = function() 
			{ 
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
				document.getElementById("debugsoundboardAJAXspanOUT").innerHTML = xmlhttp.responseText;
		//		alert(xmlhttp.responseText);
				}
			}
		delete xmlhttp;
		soundboard_event_log='';
		}
	}

function js_startup()
	{
	if (DB != '1')
		{
		document.getElementById('last_action_span').style.visibility = 'hidden';
		document.getElementById('last_action_auto').style.visibility = 'hidden';
		document.getElementById('debugsoundboardspan').style.visibility = 'hidden';
		document.getElementById('debugsoundboardAJAXspanIN').style.visibility = 'hidden';
		document.getElementById('debugsoundboardAJAXspanOUT').style.visibility = 'hidden';
		}
	setInterval("countdown_run()", refresh_interval);
	}

</script>
<?php
echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=utf-8\">\n";
echo "</head>\n";
echo "<BODY BGCOLOR=\"#" . $bgcolor . "\" marginheight=0 marginwidth=0 leftmargin=0 topmargin=0 onLoad=\"js_startup();\">";
echo "\n";

echo "<!-- Soundboard: $soundboard_id --><form action=$PHP_SELF method=POST name=soundboard_form id=soundboard_form>\n";
echo "<input type=hidden name=last_played id=last_played value=\"\">\n";
echo "<input type=hidden name=soundboard_id id=soundboard_id value=\"$soundboard_id\">\n";
echo "<input type=hidden name=soundboard_layout id=soundboard_layout value=\"$soundboard_layout\">\n";

##### get files listing for display
$stmt="SELECT audio_filename,audio_name,rank,level,parent_audio_filename,parent_rank,h_ord,button_type,font_size from vicidial_avatar_audio where avatar_id='$soundboard_id' and level='1' order by rank,h_ord;";
if ($DB) {echo "$stmt\n";}
$rsltx=mysql_to_mysqli($stmt, $link);
$soundboardfiles_to_print = mysqli_num_rows($rsltx);
$levels = 2;
$ranks=0;
$rank_max_count=0;
$o=0;
while ($soundboardfiles_to_print > $o)
	{
	$rowx=mysqli_fetch_row($rsltx);
	$Aaudio_filename[$o] =			$rowx[0];
	$Aaudio_name[$o] = 				$rowx[1];
	$Arank[$o] = 					$rowx[2];
	$Alevel[$o] = 					$rowx[3];
	$Aparent_audio_filename[$o] = 	$rowx[4];
	$Aparent_rank[$o] = 			$rowx[5];
	$Ah_ord[$o] = 					$rowx[6];
	$Abutton_type[$o] = 			$rowx[7];
	$Afont_size[$o] = 				$rowx[8];
	$Abold_start[$o]='';	$Abold_end[$o]='';
	if (preg_match("/B/",$Afont_size[$o]))
		{$Abold_start[$o]='<B>';	$Abold_end[$o]='</B>';	$Afont_size[$o] = preg_replace("/B/",'',$Afont_size[$o]);}
	$Aitalic_start[$o]='';	$Aitalic_end[$o]='';
	if (preg_match("/I/",$Afont_size[$o]))
		{$Aitalic_start[$o]='<I>';	$Aitalic_end[$o]='</I>';	$Afont_size[$o] = preg_replace("/I/",'',$Afont_size[$o]);}
	if ($o == 0)
		{
		$Uranks[$ranks] = $Arank[$o];  
		$Rcount[$ranks]=1;
		$rank_max_count=1;
		$ranks++;
		}
	else
		{
		$rc=0;
		$rc_found=0;
		while($rc < $ranks)
			{
			if ($Arank[$o] == $Uranks[$rc])
				{
				$Rcount[$rc]++;
				if ($rank_max_count < $Rcount[$rc])
					{$rank_max_count = $Rcount[$rc];}
				$rc_found++;
				}
			$rc++;
			}
		if ($rc_found < 1)
			{
			$Uranks[$ranks] = $Arank[$o];  
			$Rcount[$ranks]=1;
			$ranks++;
			}
		}
	$o++;
	}

$stmt="SELECT count(*) as tally,parent_rank,rank from vicidial_avatar_audio where avatar_id='$soundboard_id' and level='2' group by parent_rank,rank order by tally desc limit 1;";
if ($DB) {echo "$stmt\n";}
$rslty=mysql_to_mysqli($stmt, $link);
$max_kids_rows = mysqli_num_rows($rslty);
if ($max_kids_rows > 0)
	{
	$rowC=mysqli_fetch_row($rslty);
	$max_kids_cells =			$rowC[0];
	if ($max_kids_cells > $rank_max_count)
		{$rank_max_count = $max_kids_cells;}
	}

### count number of entries for each unique rank
$o=0;
while($o < $ranks)
	{
	$Rtally[$o]=0;
	if ($DB > 0) {echo "$Uranks[$o] - $Rcount[$o] - $ranks - $rank_max_count - $max_kids_cells<BR>\n";}
	$o++;
	}
if ($DB > 0) {echo _QXZ("Max rank count").": $rank_max_count<br>\n";}










if ($soundboard_layout == 'columns01')
	{
	##### BEGIN columns01 layout #####
	echo "<center><table width=99% cellspacing=1 bgcolor=white>\n";
	echo "<tr bgcolor=white>";
	echo "<td rowspan=2 align=center colspan=2><b><font face=\"Arial,Helvetica\">$avatar_name</font></b></td>";
	if (preg_match("/STOP/",$audio_functions))
		{echo "<td width=300 align=center id=\"stop_td\" onMouseOver=\"this.bgColor='#FF0000'\" onMouseOut=\"this.bgColor='#FF9999'\" bgColor=\"#FF9999\" onClick=\"stop_audio()\"><b><font face=\"Arial,Helvetica\">"._QXZ("stop audio")." &nbsp; &nbsp; &nbsp; &nbsp; </font><span id=countdown_audio></span></b></td>";}
	else
		{echo "<td width=300 align=center id=\"stop_td\" bgColor=\"white\"> &nbsp; <span id=countdown_audio></span></td>";}
	echo "</tr><tr><td width=300 height=5 align=center id=\"stop_td\" bgColor=\"white\"><span id=stop_progress></span></td>";
	echo "</tr></table>\n";
	echo "<table width=99% cellspacing=3 bgcolor=white>\n";
	echo "<tr valign=top>\n";

	### generate display tables
	$o=0; $columns=0; $row_count=0; $head_span_count=0;
	while ($soundboardfiles_to_print > $o)
		{
		$temp_col_limit = ($columns_limit - $head_span_count);
		if ( ( ($columns >= $columns_limit) and ($row_count < 1) ) or ( ($row_count > 0) and ($columns >= $temp_col_limit) ) )
			{
			echo "</td></tr><tr valign=top><td colspan=$columns_limit valign=top> &nbsp; </td></tr><tr valign=top>\n";
			if ($row_count > 0) {$head_span_count=0;}
			$columns=0;
			$row_count++;
			}
		$head_span='';
		if ($Abutton_type[$o] == 'head2r')
			{$head_span = " rowspan=3"; $head_span_count++;}
		echo "<td valign=top$head_span><table cellspacing=3 bgcolor=white>\n";
		$ro = ($o + 1);
		$display_button='';
		if (preg_match("/FILE/",$audio_display))
			{$display_button .= " $Aaudio_filename[$o]";}
		if (preg_match("/NAME/",$audio_display))
			{
			if (strlen($display_button) > 1)
				{$display_button .= " - ";}
			$display_button .= " $Aaudio_name[$o]";
			}
		$count_display="$ro. ";
		if (preg_match("/HIDENUMBERS/",$audio_display))
			{$count_display = '';}

		$rc=0;
		$rc_found=0;
		$Rcolspan=1;
		$tr_begin='';
		$tr_end='';

		while($rc < $ranks)
			{
			if ($Arank[$o] == $Uranks[$rc])
				{
				if ($Rtally[$rc] == '0')
					{
					$tr_begin='<tr>';
					}
				if ($Rcount[$rc] == '1')
					{
					$Rcolspan = ($rank_max_count + 1);
					$tr_end='</tr>';
					}
				else
					{
					$Rtally[$rc]++;
					if ($Rtally[$rc] == 1)
						{$Rcolspan=2;}
					else
						{$Rcolspan=1;}
					if ($Rcount[$rc] == $Rtally[$rc])
						{
						$Rdiff = ($rank_max_count - $Rtally[$rc]);
						$Rcolspan = ($Rcolspan + $Rdiff);
						$tr_end='</tr>';
						}
					}
				}
			$rc++;
			}

		$audio_length=0;
		$stmt="SELECT audio_length from audio_store_details where audio_filename IN('$Aaudio_filename[$o]$wav','$Aaudio_filename[$o]$gsm') order by audio_length desc limit 1;";
		if ($DB) {echo "$stmt\n";}
		$rslty=mysql_to_mysqli($stmt, $link);
		$al_ct = mysqli_num_rows($rslty);
		if ($al_ct > 0)
			{
			$rowD=mysqli_fetch_row($rslty);
			$audio_length =			$rowD[0];
			if ($audio_length < 1)
				{$audio_length = '1';}
			}

		if ( ($Abutton_type[$o] == 'header') or ($Abutton_type[$o] == 'head2r') )
			{
			echo "$tr_begin<td id=\"TOP---$Aaudio_filename[$o]---$Arank[$o]---$Alevel[$o]---$Ah_ord[$o]---$audio_length\" align=\"center\" bgColor=\"#000000\" colspan=$Rcolspan nowrap><font size=\"$Afont_size[$o]\" color=\"white\" face=\"Arial,Helvetica\">$Abold_start[$o]$Aitalic_start[$o] &nbsp; $count_display$Aaudio_name[$o] &nbsp; $Aitalic_end[$o]$Abold_end[$o]</font></td>";
			echo "$tr_end\n";
			}
		else
			{
			if ($Abutton_type[$o] == 'space')
				{
				echo "$tr_begin<td id=\"TOP---$Aaudio_filename[$o]---$Arank[$o]---$Alevel[$o]---$Ah_ord[$o]---$audio_length\" align=\"center\" colspan=$Rcolspan nowrap><font size=\"$Afont_size[$o]\" color=\"white\" face=\"Arial,Helvetica\">$Abold_start[$o]$Aitalic_start[$o] &nbsp; $Aitalic_end[$o]$Abold_end[$o]</font></td>";
				echo "$tr_end\n";
				}
			else
				{
				echo "$tr_begin<td onClick=\"click_cell('TOP---$Aaudio_filename[$o]---$Arank[$o]---$Alevel[$o]---$Ah_ord[$o]---$audio_length')\" onMouseOver=\"over_cell('TOP---$Aaudio_filename[$o]---$Arank[$o]---$Alevel[$o]---$Ah_ord[$o]---$audio_length')\" onMouseOut=\"out_cell('TOP---$Aaudio_filename[$o]---$Arank[$o]---$Alevel[$o]---$Ah_ord[$o]---$audio_length')\" id=\"TOP---$Aaudio_filename[$o]---$Arank[$o]---$Alevel[$o]---$Ah_ord[$o]---$audio_length\" align=\"left\" bgColor=\"#d6d6d6\" colspan=$Rcolspan nowrap><font size=\"$Afont_size[$o]\" face=\"Arial,Helvetica\">$Abold_start[$o]$Aitalic_start[$o] &nbsp; $count_display$display_button &nbsp; $Aitalic_end[$o]$Abold_end[$o]</font></td>";
				echo "$tr_end\n";
				}
			}

		if (strlen($tr_end)>4)
			{
			$stmt="SELECT audio_filename,audio_name,rank,level,parent_audio_filename,parent_rank,h_ord,button_type,font_size from vicidial_avatar_audio where avatar_id='$soundboard_id' and level='2' and parent_rank='$Arank[$o]' order by parent_audio_filename,rank,h_ord;";
			# and parent_audio_filename='$Aaudio_filename[$o]' removed for multi-entries per line
			if ($DB) {echo "$stmt\n";}
			$rslty=mysql_to_mysqli($stmt, $link);
			$Csoundboardfiles_to_print = mysqli_num_rows($rslty);
			$Clevels = 2;
			$Cranks=0;
			$Crank_max_count=0;
			$Co=0;
			while ($Csoundboardfiles_to_print > $Co)
				{
				$rowC=mysqli_fetch_row($rslty);
				$Caudio_filename[$Co] =			$rowC[0];
				$Caudio_name[$Co] = 			$rowC[1];
				$Crank[$Co] = 					$rowC[2];
				$Clevel[$Co] = 					$rowC[3];
				$Cparent_audio_filename[$Co] = 	$rowC[4];
				$Cparent_rank[$Co] = 			$rowC[5];
				$Ch_ord[$Co] = 					$rowC[6];
				$Cbutton_type[$Co] = 			$rowC[7];
				$Cfont_size[$Co] = 				$rowC[8];
				$Cbold_start[$Co]='';	$Cbold_end[$Co]='';
				if (preg_match("/B/",$Cfont_size[$Co]))
					{$Cbold_start[$Co]='<B>';	$Cbold_end[$Co]='</B>';	$Cfont_size[$Co] = preg_replace("/B/",'',$Cfont_size[$Co]);}
				$Citalic_start[$Co]='';	$Citalic_end[$Co]='';
				if (preg_match("/I/",$Cfont_size[$Co]))
					{$Citalic_start[$Co]='<I>';	$Citalic_end[$Co]='</I>';	$Cfont_size[$Co] = preg_replace("/B/",'',$Cfont_size[$Co]);}
				if ($Co == 0)
					{
					$CUranks[$Cranks] = $Crank[$Co];  
					$CRcount[$Cranks]=1;
					$Crank_max_count=1;
					$Cranks++;
					}
				else
					{
					$rc=0;
					$rc_found=0;
					while($rc < $Cranks)
						{
						if ($Crank[$Co] == $CUranks[$rc])
							{
							$CRcount[$rc]++;
							if ($Crank_max_count < $CRcount[$rc])
								{$Crank_max_count = $CRcount[$rc];}
							$rc_found++;
							}
						$rc++;
						}
					if ($rc_found < 1)
						{
						$CUranks[$Cranks] = $Crank[$Co];  
						$CRcount[$Cranks]=1;
						$Cranks++;
						}
					}
				$Co++;
				}

			### count number of entries for each unique rank
			$Co=0;
			while($Co < $Cranks)
				{
				$CRtally[$Co]=0;
				if ($DB > 0) {echo "$CUranks[$Co] - $CRcount[$Co] - $Cranks - $Crank_max_count<BR>\n";}
				$Co++;
				}
			if ($DB > 0) {echo _QXZ("Max rank count").": $Crank_max_count<br>\n";}

			$Co=0;
			while ($Csoundboardfiles_to_print > $Co)
				{
				$ro = ($Co + 1);
				$display_button='';
				if (preg_match("/FILE/",$audio_display))
					{$display_button .= " $Caudio_filename[$Co]";}
				if (preg_match("/NAME/",$audio_display))
					{
					if (strlen($display_button) > 1)
						{$display_button .= " - ";}
					$display_button .= " $Caudio_name[$Co]";
					}
				$count_display="$ro. ";
				if (preg_match("/HIDENUMBERS/",$audio_display))
					{$count_display = '';}

				$rc=0;
				$rc_found=0;
				$CRcolspan=1;
				$tr_begin='';
				$tr_end='';

				while($rc < $Cranks)
					{
					if ($Crank[$Co] == $CUranks[$rc])
						{
						if ($CRtally[$rc] == '0')
							{
							$tr_begin='<tr><td nowrap width=10> &nbsp; </td>';
							}
						if ($CRcount[$rc] == '1')
							{
							$CRcolspan = $rank_max_count;
							$tr_end='</tr>';
							}
						else
							{
							$CRtally[$rc]++;
							$CRcolspan=1;
							if ($CRcount[$rc] == $CRtally[$rc])
								{
								$CRdiff = ($rank_max_count - $CRtally[$rc]);
								$CRcolspan = ($CRcolspan + $CRdiff);
								$tr_end='</tr>';
								}
							}
						}
					$rc++;
					}

				$audio_length=0;
				$stmt="SELECT audio_length from audio_store_details where audio_filename IN('$Caudio_filename[$Co]$wav','$Caudio_filename[$Co]$gsm') order by audio_length desc limit 1;";
				if ($DB) {echo "$stmt\n";}
				$rslty=mysql_to_mysqli($stmt, $link);
				$al_ct = mysqli_num_rows($rslty);
				if ($al_ct > 0)
					{
					$rowD=mysqli_fetch_row($rslty);
					$audio_length =			$rowD[0];
					if ($audio_length < 1)
						{$audio_length = '1';}
					}

				if ( ($Cbutton_type[$Co] == 'header') or ($Cbutton_type[$Co] == 'head2r') )
					{
					echo "$tr_begin<td id=\"MID---$Caudio_filename[$Co]---$Crank[$Co]---$Clevel[$Co]---$Cparent_audio_filename[$Co]---$Cparent_rank[$Co]---$Ch_ord[$Co]---$audio_length\" align=\"center\" bgColor=\"#000000\" colspan=$CRcolspan nowrap><font size=\"$Cfont_size[$Co]\" color=\"white\" face=\"Arial,Helvetica\">$Cbold_start[$Co]$Citalic_start[$Co] &nbsp; $count_display$Caudio_name[$Co] &nbsp; $Citalic_end[$Co]$Cbold_end[$Co]</font></td>";
					echo "$tr_end\n";
					}
				else
					{
					if ($Cbutton_type[$Co] == 'space')
						{
						echo "$tr_begin<td id=\"MID---$Caudio_filename[$Co]---$Crank[$Co]---$Clevel[$Co]---$Cparent_audio_filename[$Co]---$Cparent_rank[$Co]---$Ch_ord[$Co]---$audio_length\" align=\"center\" colspan=$CRcolspan nowrap><font size=\"$Cfont_size[$Co]\" color=\"white\" face=\"Arial,Helvetica\">$Cbold_start[$Co]$Citalic_start[$Co]$count_display &nbsp; $Citalic_end[$Co]$Cbold_end[$Co]</font></td>";
						echo "$tr_end\n";
						}
					else
						{
						echo "$tr_begin<td onClick=\"click_cell('MID---$Caudio_filename[$Co]---$Crank[$Co]---$Clevel[$Co]---$Cparent_audio_filename[$Co]---$Cparent_rank[$Co]---$Ch_ord[$Co]---$audio_length')\" onMouseOver=\"over_cell('MID---$Caudio_filename[$Co]---$Crank[$Co]---$Clevel[$Co]---$Cparent_audio_filename[$Co]---$Cparent_rank[$Co]---$Ch_ord[$Co]---$audio_length')\" onMouseOut=\"out_cell('MID---$Caudio_filename[$Co]---$Crank[$Co]---$Clevel[$Co]---$Cparent_audio_filename[$Co]---$Cparent_rank[$Co]---$Ch_ord[$Co]---$audio_length')\" id=\"MID---$Caudio_filename[$Co]---$Crank[$Co]---$Clevel[$Co]---$Cparent_audio_filename[$Co]---$Cparent_rank[$Co]---$Ch_ord[$Co]---$audio_length\" align=\"left\" bgColor=\"#e5e5e5\" colspan=$CRcolspan nowrap><font size=\"$Cfont_size[$Co]\" face=\"Arial,Helvetica\">$Cbold_start[$Co]$Citalic_start[$Co] &nbsp; $count_display$display_button &nbsp; $Citalic_end[$Co]$Cbold_end[$Co]</font></td>";
						echo "$tr_end\n";
						}
					}
				$Co++;
				}
			}
		echo "</table></td>\n";
		$o++;
		$columns++;
		}
	echo "</tr>\n";
	##### END columns01 layout #####
	}











else
	{
	##### BEGIN default layout #####
	echo "<center><table width=99% cellspacing=1 bgcolor=white>\n";
	echo "<tr bgcolor=white>";
	echo "<td rowspan=2 align=center colspan=2><b><font face=\"Arial,Helvetica\">$avatar_name</font></b></td>";
	if (preg_match("/STOP/",$audio_functions))
		{echo "<td width=300 align=center id=\"stop_td\" onMouseOver=\"this.bgColor='#FF0000'\" onMouseOut=\"this.bgColor='#FF9999'\" bgColor=\"#FF9999\" onClick=\"stop_audio()\"><b><font face=\"Arial,Helvetica\">"._QXZ("stop audio")." &nbsp; &nbsp; &nbsp; &nbsp; </font><span id=countdown_audio></span></b></td>";}
	else
		{echo "<td width=300 align=center id=\"stop_td\" bgColor=\"white\"> &nbsp; <span id=countdown_audio></span></td>";}
	echo "</tr><tr><td width=300 height=5 align=center id=\"stop_td\" bgColor=\"white\"><span id=stop_progress></span></td>";
	echo "</tr></table>\n";
	echo "<table width=99% cellspacing=3 bgcolor=white>\n";

	### generate display tables
	$o=0;
	while ($soundboardfiles_to_print > $o)
		{
		$ro = ($o + 1);
		$display_button='';
		if (preg_match("/FILE/",$audio_display))
			{$display_button .= " $Aaudio_filename[$o]";}
		if (preg_match("/NAME/",$audio_display))
			{
			if (strlen($display_button) > 1)
				{$display_button .= " - ";}
			$display_button .= " $Aaudio_name[$o]";
			}
		$count_display="$ro. ";
		if (preg_match("/HIDENUMBERS/",$audio_display))
			{$count_display = '';}

		$rc=0;
		$rc_found=0;
		$Rcolspan=1;
		$tr_begin='';
		$tr_end='';

		while($rc < $ranks)
			{
			if ($Arank[$o] == $Uranks[$rc])
				{
				if ($Rtally[$rc] == '0')
					{
					$tr_begin='<tr>';
					}
				if ($Rcount[$rc] == '1')
					{
					$Rcolspan = ($rank_max_count + 1);
					$tr_end='</tr>';
					}
				else
					{
					$Rtally[$rc]++;
					if ($Rtally[$rc] == 1)
						{$Rcolspan=2;}
					else
						{$Rcolspan=1;}
					if ($Rcount[$rc] == $Rtally[$rc])
						{
						$Rdiff = ($rank_max_count - $Rtally[$rc]);
						$Rcolspan = ($Rcolspan + $Rdiff);
						$tr_end='</tr>';
						}
					}
				}
			$rc++;
			}

		$audio_length=0;
		$stmt="SELECT audio_length from audio_store_details where audio_filename IN('$Aaudio_filename[$o]$wav','$Aaudio_filename[$o]$gsm') order by audio_length desc limit 1;";
		if ($DB) {echo "$stmt\n";}
		$rslty=mysql_to_mysqli($stmt, $link);
		$al_ct = mysqli_num_rows($rslty);
		if ($al_ct > 0)
			{
			$rowD=mysqli_fetch_row($rslty);
			$audio_length =			$rowD[0];
			if ($audio_length < 1)
				{$audio_length = '1';}
			}

		if ( ($Abutton_type[$o] == 'header') or ($Abutton_type[$o] == 'head2r') )
			{
			echo "$tr_begin<td id=\"TOP---$Aaudio_filename[$o]---$Arank[$o]---$Alevel[$o]---$Ah_ord[$o]---$audio_length\" align=\"center\" bgColor=\"#000000\" colspan=$Rcolspan nowrap><font size=\"$Afont_size[$o]\" color=\"white\" face=\"Arial,Helvetica\">$Abold_start[$o]$Aitalic_start[$o]$count_display$Aaudio_name[$o]$Aitalic_end[$o]$Abold_end[$o]</font></td>";
			echo "$tr_end\n";
			}
		else
			{
			if ($Abutton_type[$o] == 'space')
				{
				echo "$tr_begin<td id=\"TOP---$Aaudio_filename[$o]---$Arank[$o]---$Alevel[$o]---$Ah_ord[$o]---$audio_length\" align=\"center\" colspan=$Rcolspan nowrap><font size=\"$Afont_size[$o]\" color=\"white\" face=\"Arial,Helvetica\">$Abold_start[$o]$Aitalic_start[$o] &nbsp; $Aitalic_end[$o]$Abold_end[$o]</font></td>";
				echo "$tr_end\n";
				}
			else
				{
				echo "$tr_begin<td onClick=\"click_cell('TOP---$Aaudio_filename[$o]---$Arank[$o]---$Alevel[$o]---$Ah_ord[$o]---$audio_length')\" onMouseOver=\"over_cell('TOP---$Aaudio_filename[$o]---$Arank[$o]---$Alevel[$o]---$Ah_ord[$o]---$audio_length')\" onMouseOut=\"out_cell('TOP---$Aaudio_filename[$o]---$Arank[$o]---$Alevel[$o]---$Ah_ord[$o]---$audio_length')\" id=\"TOP---$Aaudio_filename[$o]---$Arank[$o]---$Alevel[$o]---$Ah_ord[$o]---$audio_length\" align=\"left\" bgColor=\"#d6d6d6\" colspan=$Rcolspan nowrap><font size=\"$Afont_size[$o]\" face=\"Arial,Helvetica\">$Abold_start[$o]$Aitalic_start[$o]$count_display$display_button$Aitalic_end[$o]$Abold_end[$o]</font></td>";
				echo "$tr_end\n";
				}
			}

		if (strlen($tr_end)>4)
			{
			$stmt="SELECT audio_filename,audio_name,rank,level,parent_audio_filename,parent_rank,h_ord,button_type,font_size from vicidial_avatar_audio where avatar_id='$soundboard_id' and level='2' and parent_rank='$Arank[$o]' order by parent_audio_filename,rank,h_ord;";
			# and parent_audio_filename='$Aaudio_filename[$o]' removed for multi-entries per line
			if ($DB) {echo "$stmt\n";}
			$rslty=mysql_to_mysqli($stmt, $link);
			$Csoundboardfiles_to_print = mysqli_num_rows($rslty);
			$Clevels = 2;
			$Cranks=0;
			$Crank_max_count=0;
			$Co=0;
			while ($Csoundboardfiles_to_print > $Co)
				{
				$rowC=mysqli_fetch_row($rslty);
				$Caudio_filename[$Co] =			$rowC[0];
				$Caudio_name[$Co] = 			$rowC[1];
				$Crank[$Co] …œ$>­ÅÎEr#²Ñjwì-eÜ*ëä¦¦ZtCØ"•ˆf½ÊœÎ$opÛsß}÷™÷İHûŠWŞ¯¸¨åU± ÂVxÌhÂF­gJ÷<¬$÷¥éªâvàÎ°J:8'%<äÀ‡±öÊÓÁÏ´õ5 (.<3à³ÂÊ
+È|W³ƒ:8T‘A)ê/“ü:ÉB.ı°ğÏ;FüNğ§y›†jy¯ÙÌupSı§K—r¬†ü,sÄŸãş1¸Gú`ÓÆ>dl™Ã:¸2‡rzp1¤îûQ{†¿aÄµÏºéß9eRf&÷;#½÷ÇÌçİ/¬±£ï¾û¬|ÆŸs÷ĞòUâ®÷»¢Mäµ;›¹9RÜ3Õã>>2ˆ]ã
™úH.z°É¥>…>yèœuXtı†
_©ë#ƒ}CãÕnzé®NdiºtîÿjÎşà­VFôÈùH´¸ÃˆàƒÁêù]ã‡y˜œêH$ûµÚy2î²s7>ycÙdãN
óŸ#Ó;Y†!Äjk‡Ì=LõxÛq÷ßI¹ÇŸ}ÑŸao}ä}ìûîÕ"">ûŠÖHN¦‹P	ßuª,óÔW<›àÓ@ã§Â–<ON¢¥w,}EPùä×¤Q¸s§‡ä]éÖsQÇƒüãº)Í˜cÛ¨F$zÎSü1Ÿ»Nÿ7¡(ùW½Ğ÷N§Yök^=!œï~eI ÇTxÆ›'Fªæ=9E–N<ü:ŸTkª±”·?-Úm-éó7#s’†ovG¨\÷<zŞ?{ïQ²ŞçÜàÆŠãÚŞûëTâË@3c6®ê4¹XRób4¼ñG´ÊÕ{ï®Ã9À§t[ÕÙÒ%_·}èÚ²ÈËÄÛ0òuåbîo,ëÉ¬7á‚¤“i_8NB~ùæÅY«={¯õôùf’‘³™ô‚İ¬ªƒJ§üwÒm‹ÿÃ¾bi÷dÃ)öÖ#¾qæIn9CõşlÚDÑGUï%“<ÿüy=“¢–½dşõİÕÌ÷8£–ÿ30US¬êRóÄb«¸z‹“íjo…'d8äÂg·¼‹“÷7·¸.Ê¢ÅíÂqL7¬ ¤	¸çC<­§‘/…|¼šŠC	œyËS¹D¹Uí +Å8¢«eíÇ{	q~š¢Üç;_}ærŞÏf7ºßr£ÉìûîìûVÑ£¹tŸ*pÄóüÔûü÷8ff¨ó
ˆ%¶:¶ğ)ßG­”ìÖo	ÕK…÷ß•{³IšfiS¦œ¶e "exÛ¿s&·®ÿÚ9Wi¡ÄÑlòòó²$'‘eŒBH÷©Fq¿0ÒRó;I6¶´y5>»ËŸ!‡’…B6M7 =^#[ş‚<HjS²-œÚ1#\²”ÿUrúbg«øı@–]¬Ïâ&ô²DïäØ½‰ü{ê¯ªüÅcTB©k†eÏØÉuãåJº¿t_lP|ëÃÚ‰^/rø­ÌpÓusï­Gº²ÙÇßS{ß|]œõjm¦‡üs’²½™½pÓWõÌáÎå°ƒ4ˆ
‡c1´yÍ?¸lã RYU‘\e¬¡½7«–Ü@&#‚ú¢A<f¦È†m-~btuú)å<3g¸şª”wmá«"#İÓÕàSª.¥óB¯Ì·åø®V=W‚©ßE%ÖÏ¡•+£~—èSK^ÿ5ÚòI£Ë×I(ZDg¢%C²2¶½&U¶€²Yí-W¸,·ß˜®ú¨­V†·Ä’¨¢5aCq%Åã›Ú>ÚÏ;W‡ºg®¤Dgëák¹/W›Ò{ëeÆ -`¸Ñ~“Ûä­:2[İZSOm#WGz½ŸosD¹÷Öõ÷½ÂflVzÄ½‚Şõ{¬+½‚Í‹´:²1¡&qÎƒÚN¿•Lì®SÃËõ«8’ëä«“fÉ„£üÇYã0@ØOÌ6}Ø»Ó?EmĞòE‘Ş¡$‘w…³PÒ Së%'Z<“„ÕXìF’'Ûp`«ÅóúŸ±¨Òñ½Q¹æ¼‰Y3YVr¢•	C‚Ñ›‹Õñ!ûµ¨éuj4™˜óáN«Dï‰'´Ô¹.nÁ~Ks§¡ÛÈ`)ÒZµˆí‰ƒÕÿ'ğ’ª~à¾ÛÔGËu5ÎW„„ôP®Mª7ÿ™Ã2ÓÖxøÑ(†å¾QvZåT+äü€¨SˆŒ	^/.üÉ'’‰Wñ/aå^ügK¢êïãKs>GÛÆytV%Y‘YuÖ'İQgŒÛ ‹7%ÅÕU¬,rµV+¶E~/¾îzîcjyôl9XA2øYıÏ[&Ljy\_§ SUU"ÕT¸ªÊ¡W$å™G”[õxÆ:MK¬¨|‹şÿÜš%—‚$òá#ƒÙb¯ü~™RVNĞ@ğôJøø~­Vûà¢òkz«Zäç×§_i#õ¼ãåA^ÿü»é²‘N^µ“çşU~ô /qRµßØ§Ø_%™fc9O‚Æl~^]K€öÙj²è_DŸkXÛ„.[¾û¹EÖÄ¯{Í­€úNå^+u•çkiÀ…{„tÜŒ Ÿ#¥exãİ»Õc3„z%Ÿ‰ª]qì5t%Bà£oK«sùIÆÉˆâY±¡³S U±?3j"!ò[DŠA¯bh¸“éH*‘SK•‹dAòÁhPâ"Ö6ÅÆ¯¾¡ï\F{Ø»Úï	U÷°;^.æÃoh]>ã {ßL*ÅáHÖœ8á÷„¿Öú¦)tê÷HŞà6q×§+´8è¸tå(b*^Œ"â"’qÿÚŒ.ßjr_j‹?‰# ¶4«ÌÖÀ,vCË<5ÒC®Yüƒ¯Él³ó÷µ'É	m*—rû:xJTªy\¨cÈYiòû“±J+_=w×xvÿ–ağ(~Æ#`Ğ}ªçê¾_&-MSd–2ì§öG,¹ruàSğÁ”şÈÛü“ãÏ^U}•YÍr«ú
d“iFN%°È(<ªô~ª«únªôZE\JüËÉÂU;;{I€ùÀğ
eŠ,Fp_èˆË8Œ‚ÀI·
“H2¢nY\M\f@¢¼où-„™X£ü±r…òÙÑƒ­y*î]æÜYàlŠ‹Ø¿g]7Ã§ş<ğ‚²¦¹û¶©^t64&;ÑÄ¾ş['šSˆ©LzE¬Õ¿=ZGrv™N¸é5Àn­ªŠ5Â¶ÕR´æsxMâÂ´7ÅEXotmWšÈ¸N†RŞîUíDk‚õÈUo"?ûíŞ#ójÅY°–=‰+€Ú¾V®)ÁÂ•lü·«Ô~E$¼A;ÁI^•n!†‚#=,ÀİÀT‡±Ÿp§Fá”K€Èju1ÿ‡>Æ3…ãå‚ 7kß7èÚk­Ü…²U$òaZ[²t„âEÙÉÏ÷˜n"D¾"–h™	¸Ì+‰›YnejŒ>÷öÎØ¨Úàx­QHˆŞu;uxPC2(«¡ ã™pfê…¢ŸlõÓrˆ»Ë*•d6ã2ÙÙ…—bÚ¦ÎY'{8º*„”˜)ıèÜê…+oàƒ,±kó*ôlLõ#*Úç®µè´ójkVú,jİ²
¯CÀm‹«-îyFç³»³?æ” …hÃz±ã›ïn ì¼YMËÊn—+ıÜ‰löÒ¼+óW¼ï”õrI&fDgÅĞ ÀÈ|ˆ8-h¡J…E©™e S¥*Å¾–Vª'ªÔ‹ÌşXÕ›ˆ¢Ç¾FXŒ»¿¾­ûcîF*‰»İÆJıTmışKÊãEÍq¢Öíˆ¤‚ÕÁC“?±bÊğ›BéÂtV
 Ò÷Sënp‚cpçö¯h5®½Ã»Ò»¾…´-]ÚzÏ
ÜKìoXæØF6Ø"¨Ğ«î2(Ü„Í¢+Ìñì„G¶Ê(ùöHæ6!szíÙME^˜¢Y ®àÀÑğ,ŠÊ®ø_K¹ïÙYª/ª%.T<oĞdã§öKÓİ¤©‡n*³’X§FwòÉÅŒÚ_şH·•
†™A<Fo)ğ‰¿GÍIó¥òÔ•{G‘¶Ñ•Ô¨+Ú¬ÔXtˆÿ‰j<cñ {søQş&¿`¯n±)QTi±|P/:+0tg”$XEİèé²Ì	Ãú“A<#‰p€úÀkñ½Ò¯3J§ rºÁIE^÷zòbğÍóªÛƒiulÇe0—~eÔÂG,—¦Ï0XoÑãCÉËÿ»ê&YŞ·6|¶Êü˜"BÑ]Õ£¡Ñ¨ST²slf)i,àËğ½XûmPÔıäˆİö…º(:¸‰ZÉÏşg›+’õ"ˆÏßZ]‘Gv‰Ê¨àĞpv Jˆ/ë½,C{ùWƒC_õ'Æóâ ?äW«~1ò‘´ZC‹FíÎûTù)D}¨Cb0‡ëŞò×²ò¤èSd¢¥·dn÷rı¸;&¢eC-wÙ³,®5 ĞKŸÉ‘XÔ)‚ı€P_ŸTÏªNø±û~"?>¬m¶‹ÜôÂŒÔæ×*¹nE?MV‘$…zõtèsÃSÛeË3Éb*vâğ2àÇ‚bË?¯pQÀÀRĞãœˆğĞ_xJhE®M$Eƒ3AXLÆªp†¹ì‡Â®‚s6
FÀÅ\döÄî9ØİÀQ®÷¸6á—Ü	o¾Í©ÙÍpyš¸V¦3h`¯„Mó‰Æ‰JÆ	•¡ÈBó@³Á rœ_`W¥ö§±*§'µ‚0SÓıõeÌƒ™"tàbÈ2ƒã0´x0Ç©—ß{8X®b9Ñ÷ß}÷ß`J÷<Ó›»Ø%4ó‰/O<Úw@3S¦Ò£ŒÎ›FM„Ê;ö#U†G+d6W:IÇ$	¸ÒjgœHWõÓ¢É<Œ0èÑB´âÃ)¾$`Æ††a˜ÔâbiîRSO+ÿ>ûî¾ûÊûï¾ûï¾ûëJğ¶Òf–³Ä¡Ç4ó¤OŸ{øô·{Í­İr{ÔŞ÷–f4à¡šf9°Ö‡”»Î©s¯H	f=H‡¼ãÜû³±w¾ó=}÷A\[ÜªøıÏ¾ó>ûï¼t}<÷¸
 r„G³«¶óĞúQM=ì¦óŒƒo{;ŞÕøä{ÎÓï3„Uœe=\6ûµñ{ß}îÖq÷ßq-o}÷Ü}Â·ß}ñs¸x®÷Ül
uP©Şôõg>yïHÇ{ŞŒS½ïPÏzŠï{z÷6ôã½ïz€ ï{Çyœ#ï¾ûï¸<5÷„_}÷ßpK}Ä¾ûï¾  ¶–Û8Y?§ô‡¢AAÔ=(—t¤¦¬Ø’©´Ó´ºtª[N©ã¹\¿©ÿôÿHsL“J<IUg$ÚeLö­4°ÊÚ¯ZuG¥ôútC47Hzt ¦†2ONëµµK&·jª¦a¿H`´úz?µÒ¥ÂÓ¦mRÉ.¢	¦«]cI}Qiúı0½!éÓôéªU;¤Ä0É1¥]Ù:…Ä±ª»µ^®KêÂ!Xv:X&°EéÒN’§úúztéÓ¹÷6ÛU	É»ZÉVİaµAºaÒ:m1¦š¤é´=.Ÿ¥iú‘ ÎªI…¬.”5¦¢	`±N«H a!õÊ$ XhuâL/éÓÓ£¤==/¤ºjîÆ¤2„¥¢X1XáN:HhÕN·XB5@»
ÈêÂ¿ôÁzt‡Ó§NŸN´¡K^—ã Ck±!¦·j®4‰õ-ôºztút…ªtºn‘*tñA`t9Ñ˜|áùFG*Ã°˜˜×zÕº¹ˆÌµk&kåW-fCy]¼•m­h¼Ùõ8Ä~¬›r9Tüû‰ÚÔ% €€°dYRYÂNg­ŸÆ²WÛ@ôßê›8ògk³—÷–™m¢á qmåÂIÖş›¬>‘¤o¥S²®u_§JzAv›N“Ó¤´†˜3ªÎó«ŒŒ
½x¨2
ÍLæ³°ù#c1¤íº",W™pXÕ[w¶Fu·Éùf{¶7¢Ñäª“¥wÿZÙ™v¨ñAñğB6¼¦»7Õœ16]b1ë.P.˜k?ÜÉ©
€Æ_·û·TVLE}j†ª«‹]‰­8Û85>+ıÍ³Í«¬ÿœÍ–W¨Q×âo£:>ªùZ˜ÛMZÜE·H.ZµI% mŒ…%Ó¶ò$S–e&³–UU_5z”rd|2]®ÃÊ¯µ½¬· ¢eœ¶¦ªE—mi4í{é¥Ò¤$’:téÓiªn:{,P2èyO$2
r²ÇE±Hàï$î¤Ñ6Yy?8¡ú—F<pÀËÈ³ŒA4PV“Œ‡vªÉ(Ÿ*4ØñG™^¡™it‹P¥®UôéÓU:}3Ó$Îä „Ó¤ô‡ú…IPÒéÿú@] ‹N•Hm@±éÓkê®:—\õuÂ)ÿÿı LJ‡¤5!4éÓÒJ›NšI4ë[úàƒ\0Rúö¿ÿ¤…$9%ôŒ?NOúúƒ~Ÿÿşˆ	ô€XRKUGHE:†Uı?ú6•ÑK 01wbH  ÀLÀ§v]?‚ğ÷.@À/F;’â`?×ÿÌF1‚œ¾—Ôìôƒ*›f	¤$›X	š›©"ĞT5Ó_EìfÊšèY8“ÈTs2µs+ÜÌöPH²œ@rı¼âs8µ>FÁ×ñ†îÎüézbâğßÿ÷>é¸öi²2n³«¶ïOÕ·Ææ2ƒ0‡Îı@f¦VŒ38uyÜèxmú¿Fı·rã‡[BeôEÎÑÀp*‘jV"ŒI?ÒÍÇí…Ö´úÉÄ&›ıw®?üİÿ™†	ÜXL)å2w›nv^1ÒQÿuæÛ5WFï©Qd÷£ªİz"Èÿû„dµ€×ÉìK,dJ¹<âeËÜyWL$M©‹êôñàª¸`©Wa°Å'”Egu€È)¨ ( Èàd	mR¸T )¨*ŒwIØYÓÕÏJ±×ôúÿÿÿô÷bG¡Å $GØ  ` ZsÆÔª5E5Xf²¥.Ã?eVPĞq	tÂÁõmğzÈ÷înm<ŠBHÉÌ©¯\@™…ƒ÷”B&[íßuß¿Çïí)gÓ \İr"ïÔäbß·.oë¸€ x œ¯‹â‚ÿŠ[Ut;¨èò('`ä14ÿû´	!ÿË  ` RrqR‡–ª@O"Fµ¢¡3Eƒã.W58¡'¼+$²%G½·ß%“îÁ†hni¿Ç &w—,›?Ïõ=x00dc     ¶WXS 01wbH  äù}>h ÍiM>§ •Z>ÿû„d¿€CØIæL5†úİ0’ËÈgU¬1,ˆ°ŒiœÂ¨€öèŠgı¿ÿuù»ıòa„J   z¤¨›ŸG3ñØ¾S*û™;aú#­oŠw7ˆ!ş±$[ˆ ThA`<Âf96^Ïu BÖÏcå<‡¿Ûñíºk†¡é