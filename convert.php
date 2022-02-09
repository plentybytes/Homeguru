<html>
<head>
	<title>Unit Converter</title>

<script type='text/javascript'>
function acceptNumber(B,H){if(!H){H=0}var A=(B.which)?B.which:event.keyCode;var C="0";if(H=="0"){var G=["48","49","50","51","52","53","54","55","56","57","96","97","98","99","100","101","102","103","104","105","8","46","13","9","116","37","38","39","40"]}else{var G=["48","49","50","51","52","53","54","55","56","57","96","97","98","99","100","101","102","103","104","105","8","46","13","9","116","37","38","39","40","190","110"]}var F=G.length;for(var D=0;D<F;D++){if(G[D]==A){C="1"}}if(C=="1"){return true}else{return false}}
function RemoveSpecialChar(txtVal) {
            if (txtVal.value != '' && txtVal.value.match(/^[\w ]+$/) == null) 
            {
                txtVal.value = txtVal.value.replace(/[\W]/g, '');
            }
        }
function onlyNumericValue()
{
	if (isNaN(document.frm_calculator.area.value) ||  document.frm_calculator.area.value=="")
	{
		document.getElementById('div_error').innerHTML ="<img src='http://img.makaan.com/images/alert.gif' width='10' height='10' align='absmiddle' vspace='3' border=0>&nbsp;Please enter the area.";
		document.getElementById('div_result').innerHTML ='';
		document.frm_calculator.area.focus();
		return false;
	}
	else if(document.frm_calculator.from_unit.value == "")
	{
		document.getElementById('div_error').innerHTML ="<img src='http://img.makaan.com/images/alert.gif' width='10' height='10' align='absmiddle' vspace='3' border=0>&nbsp;Please select from unit.";
		document.getElementById('div_result').innerHTML ='';
		document.frm_calculator.from_unit.focus();
		return false;
	}
	else if(document.frm_calculator.to_unit.value == "")
	{
		document.getElementById('div_error').innerHTML ="<img src='http://img.makaan.com/images/alert.gif' width='10' height='10' align='absmiddle' vspace='3' border=0>&nbsp;Please select to unit.";
		document.getElementById('div_result').innerHTML ='';
		document.frm_calculator.to_unit.focus();
		return false;
	}
	else
	{
		document.getElementById('div_error').innerHTML ='';
		var url = 'http://www.makaan.com/ssi/ajax/ajax-content.php?process=calculate_area&area=' + document.frm_calculator.area.value + '&fromunit=' + document.frm_calculator.from_unit.value + '&tounit=' + document.frm_calculator.to_unit.value;
		makeajaxrequest(url,'div_result');
	}
return false;
}
</script>

<link href="css/user-style.css" rel="stylesheet" type="text/css"/>
<script src="js/ajax.js" type="text/javascript" language="javascript1.2"></script>
</head>
<body>
<table width="310" border="1" cellpadding="0" cellspacing="0"  class="staticorangetb" align='center' valign='middle'>
	<tr class="strip">
		<td >
			<table width="100%"  border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td width="70%" align="right"><h2 class='black'><b>Unit Converter</b></h2></td>
					<td width="30%" align="right">
					<img src="http://img.makaan.com/images/close-small.gif" border="0" onClick="javascript:window.close();" class="cursor">&nbsp;
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
	<td  valign="top"  align="left"  > 
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="statictext" >
		<tr><td class="lineheight">&nbsp;</td></tr>
		<tr><td class="texterrorbig" height="15" align="center"><div id="div_error"></div></td></tr>
		<tr><td width="100%" align="center" valign="top">
		<table width="90%" border="0" >
		<tr>
		<td>
			<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="text">
				<form name="frm_calculator" method="post" action="" onSubmit="javascript:return onlyNumericValue();clear_form1();" >
				<tr height="25" class='greyfill'>
					<td>&nbsp;Area</td>
					<td><input name="area" type="text" value="" id="area"  class="smalltextbox"  style="width:100px" maxlength="7" onkeydown="return acceptNumber(event,'0');" onkeyup="RemoveSpecialChar(this)" onblur="RemoveSpecialChar(this)" /></td>
				</tr>
				<tr height="25" >
					<td>&nbsp;From Unit</td>
					<td>
						<select name="from_unit" class="somemoresmalldropdown" onchange = "" ><option value = "">--Unit--</option><option value="1"  >Sq. Feet</option><option value="2"  >Sq. Meters</option><option value="3"  >Sq. Yards</option><option value="4"  >Ground</option><option value="5"  >Aankadam</option><option value="6"  >Rood</option><option value="7"  >Chataks</option><option value="8"  >Perch</option><option value="9"  >Guntha</option><option value="10"  >Ares</option><option value="11"  >Biswa</option><option value="12"  >Acres</option><option value="13"  >Bigha</option><option value="14"  >Kottah</option><option value="15"  >Hectares</option><option value="16"  >Marla</option><option value="17"  >Kanal</option><option value="18"  >Cent</option></select>					</td>
				</tr>
				<tr height="25" class='greyfill'>
					<td>&nbsp;To Unit</td>
					<td>
					<select name="to_unit" class="somemoresmalldropdown" onchange = "" ><option value = "">--Unit--</option><option value="1"  >Sq. Feet</option><option value="2"  >Sq. Meters</option><option value="3"  >Sq. Yards</option></select>					</td>
				</tr>
				<tr><td colspan='2'>&nbsp;</td></tr>
				<tr>
					<td></td>
					<td height="30"><input type="image" src="http://img.makaan.com/images/convert.gif" class="button" /></td>
				</tr>
				</form>
			</table>
		</td>
		</tr>
	</table>
	</td></tr>
	<tr><td class="headingtext orange"  height="25" align="center"><div id="div_result"></div></td></tr>
	<tr >
		<td style="height=10;" align="center" ></td>
	</tr>
</table></td>
</tr>
</table>
</body>
</html>

