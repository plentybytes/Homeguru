
	
	<script type="text/javascript">var domainUrl='http://www.magicbricks.com';var jsPath='/scripts/';</script>
<html>
	<head>
		<script language="javascript">function onlyNumericValue(){if(isNaN(document.forms['form1'].elements['area'].value))
{alert("Please enter numeric values In Area Fields .");document.forms['form1'].elements['area'].focus();return false;}
if(document.getElementById("area").value=='')
{alert("Please enter some numeric values In Area Fields .");document.getElementById("area").focus();return false;}
if(document.getElementById("fromUnit").value=='')
{alert("Please Select From Unit .");document.getElementById("fromUnit").focus();return false;}
if(document.getElementById("toUnit").value=='')
{alert("Please Select To Unit  .");document.getElementById("toUnit").focus();return false;}}</script>
	<link rel="stylesheet" type="text/css" href="http://www.magicbricks.com/css/home_style.css+forms_style.css.pagespeed.cc.PisT_useCL.css"></head>

	
	

	<body leftmargin="0" topmargin="10" marginwidth="0" marginheight="0" style=" width: 300px;">
		<form id="form1" action="convert1.php" method="post">
		<div class="mdl_panel flt_lft">
		    <div class="pad_btm1 cont_text2 ">
		        <h2 class="frm_hd">Area Calculator</h2>
		        <span class="cl"></span>
		        <div class="frm_container">
		          <p class="frm_cntrls">
		            <label>Area :</label>
		            <span class="frm_cnt">
		            	<input id="area" name="areaValue" class="smltxt" type="text" value="" maxlength="50"/>
		            	
		            </span><span class="cl"></span>
		          </p>
		          <p class="frm_cntrls">
		            <label>From Unit :</label>
		            <span class="frm_cnt">
		           	 	<select id="fromUnit" name="fromUnit" class="smltxt">
							<option value="">--- Unit---</option>
							<option value="12850">Sq-ft</option><option value="12851">Sq-yrd</option><option value="12852">Sq-m</option><option value="12853">Acre</option><option value="12854">Bigha</option><option value="12855">Hectare</option><option value="12856">Marla</option><option value="12857">Kanal</option><option value="12588">Biswa1</option><option value="12589">Biswa2</option><option value="12590">Ground</option><option value="12591">Aankadam</option><option value="12592">Rood</option><option value="12593">Chatak</option><option value="12594">Kottah</option><option value="12595">Marla</option><option value="12596">Cent</option><option value="12597">Perch</option><option value="12598">Guntha</option><option value="12599">Are</option>
						</select>
						
		            </span><span class="cl"></span>
		          </p>
		          <p class="frm_cntrls">
		            <label>To Unit :</label>
		            <span class="frm_cnt">
		            	<select id="toUnit" name="toUnit" class="smltxt">
							<option value="">--- Unit---</option>
							<option value="12850">Sq-ft</option><option value="12851">Sq-yrd</option><option value="12852">Sq-m</option><option value="12853">Acre</option><option value="12854">Bigha</option><option value="12855">Hectare</option><option value="12856">Marla</option><option value="12857">Kanal</option><option value="12588">Biswa1</option><option value="12589">Biswa2</option><option value="12590">Ground</option><option value="12591">Aankadam</option><option value="12592">Rood</option><option value="12593">Chatak</option><option value="12594">Kottah</option><option value="12595">Marla</option><option value="12596">Cent</option><option value="12597">Perch</option><option value="12598">Guntha</option><option value="12599">Are</option>
						</select>
						
		            </span><span class="cl"></span>
		          </p>
		          <p class="frm_cntrls">
		            <label>Result :</label>
		            <span class="frm_cnt">
		            	<input id="resultValue" name="resultValue" class="smltxt" type="text" value="" maxlength="29"/>
		            </span><span class="cl"></span>
		          </p>
		       </div>
			   <div class="frm_container">
					<p class="frm_cntrls">
						<label>&nbsp;</label>
						<input type="submit" id="cal" value="Calculate" onclick="return onlyNumericValue()" class="frm_btn2" style="width:110px"/>
					</p>
		       </div>
		    </div>
		</div>
		</form>
	</body>
</html>
