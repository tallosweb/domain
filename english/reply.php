<!-- Warning this page Charset must be UTF-8-->
<!--Complete Demo Php version 6.0 using apikey-->
<?php
	
 error_reporting(0);
   require("config.php");
	require("usablewebLib.php");
	 require_once('papaki.php');
	
	ini_set("max_execution_time", 120);
	$search = new PapakiDomainNameSearch($_REQUEST["domainName"]);	
	$search->use_curl = true;
	$search->apikey = $Papaki_apikey;
	$search->requestURL = $papaki_Post_url;
 
	$search->exec_request_for(_TYPE_DS);

	//if(!($search->$responseXML ))
	

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Papaki.gr Domain Search Reply - Demostraction</title>
<style>
TH {
	FONT-SIZE: 13px; FONT-FAMILY: verdana, arial, helvetica, sans-serif
}
</style>
<script type="text/javascript" language="javascript">
	
function validate()
{
	var total = 0;
	var boxes;
	var id = "id_";
	var domainNames = "";
	for (var i_tem = 0; i_tem < document.form1.cnt.value; i_tem++)
	{
		if (eval("document.form1.box_"+i_tem+".checked"))
			{
				++total ;
				domainNames = "<li>" + eval("document.form1.box_"+i_tem+".value")+"</li>" + domainNames;
				//alert(eval("document.form1.box_"+i_tem+".value"));
			}	
	}		
	//for(var i=0; i < document.form1.checkboxDomains.length; i++){
		//if(document.form1.checkboxDomains[i].checked)
		//total = total + 1;
	//}
	document.form1.domainNames.value = domainNames;
	
	
	if (total == 0)
	{
		alert("Please select a domain name");
		return false;
	}
	else
		return true;	 

	
}	
</script>
</head>
<body>
<form name="form1" method="post" action="registration_form.php" onSubmit="return validate();">
<table width="250px"  border="0" cellspacing="0" cellpadding="0">



			
	<?PHP
	if (count($search->arrayAvDomains) != 0)
	{
		?>
			
			<tr>
   				 <th bgcolor="#CCCCCC" colspan="2">Available Domain Names</th>
 		 	</tr>
		<?PHP		
		for($i=0;$i < count($search->arrayAvDomains);$i++)
		{ 
			$id = "id_".$i;
			$name = "box_".$i;
			 ?>
  				<tr>
   					 <td width="27">
   					   <label>
   				    	 <input name="<?PHP echo $name ;?>" type="checkbox" id ="<?PHP echo $id; ?>" value="<?PHP echo $search->arrayAvDomains[$i]; ?>">
						 
		       		   </label>
 				   	
			 	  </td>
   				 	<td width="223"><?PHP echo $search->arrayAvDomains[$i]; ?></td>
  				</tr>
 		 	<?PHP  
  		}
		?>
		<input type="hidden" name="domainNames" value="">
		<input type="hidden" name="cnt" value="<?PHP echo $i; ?>">
		</table>
		<table>
			<tr><td height="65"><span id="lblMakeYourSelections">Select the domains you want to register and click <strong>Register</strong></span> 
			<BR>
				<input type="image" name="imgBtnRegister" id="imgBtnRegister" src="images/registerEN.gif" alt="" border="0" />
			</td></tr>
		</table>	
	<?PHP } 
  
 	
	if( count($search->arrayNotAvDomains) !=0) 
  	{    ?>
			<table>
  			<tr>
    			<th bgcolor="#CCCCCC" colspan="2">Not Available Domain Names</th>
  			</tr>
		<?PHP
	  	for ($i=0;$i < count($search->arrayNotAvDomains);$i++)
		{ 
		?>
  			<tr>
				<td width="27"></td>
    			<td width="223"><li><?PHP echo $search->arrayNotAvDomains[$i]; ?></li></td>
  			</tr>
			
  		<?PHP  
		}
	}	
	?>

</table>
</form>
</body>
</html>
