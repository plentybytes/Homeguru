ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='images/plus.gif' class='statusicon' />", "<img src='images/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
$(document).ready(function(){	
						   
$("#Change").validate({
		rules: {
			old_pwd: "required",
			new_password: "required",
			verify_pwd: {
				required :true,
				equalTo: "#new_password",
			},
			user_personal_contact_number : {
					required : true,
					number : true,
					rangelength:[2,10],
			},
		},
		messages: {
			old_pwd: "Enter your old password.",
			new_password: "Enter your new password.",
			verify_pwd: "Re-enter your password.",
		}
	});

	$('#formNewProduction').validate({
		errorLabelContainer: $("div.error_container"),
		rules: {
				productions_name: "required",
				productions_description: "required"
		},
		messages: {
				productions_name: "Please enter production name.",
				productions_description: "Please enter production description."
		}
	});
	$('#formEditProduction').validate({
		errorLabelContainer: $("div.error_container"),
		rules: {
		    productions_name: "required",
				productions_description: "required"
		},
		messages: {
		    productions_name: "Please enter product name.",
				productions_description: "Please enter production description."
		}
	});
	$('#formConfiguration').validate({
		errorLabelContainer: $("div.configerror_container"),
		rules: {
		    configuration_value: "required"
		},
		messages: {
				configuration_value: "Please enter a value."
		}
	});
	$("#formAddEditClient").validate({
		errorLabelContainer: $("div.error_container"),
		rules: {
				clients_name: "required",
				clients_company_name: "required",
				clients_email_address: "required email",
				clients_password: "required",
				clients_phone: "required"
		},
		messages: {
				clients_name: "Please enter name.",
				clients_company_name: "Please enter company name.",
				clients_email_address: "Please enter a valid email address.",
				clients_password: "Please enter a password.",
				clients_phone: "Please enter phone number."
		}
	});
	$("#formEditArtsist").validate({
		errorLabelContainer: $("div.error_container"),
		rules: {
				artists_name: "required",
				artists_email: "required email",
				artists_password: "required"
		},
		messages: {
				artists_name: "Please enter name.",
				artists_email: "Please enter a valid email address.",
				artists_password: "Please enter a password."
		}
	});
	$("#formCMS").validate({
		errorLabelContainer: $("div.error_container"),
		rules: {
				cms_name: "required",
				cms_content: "required"
		},
		messages: {
				cms_name: "Please enter name.",
				cms_content: "Please enter content."
		}
	});
	$("#update_header_block").click(function(){
		$("#formCmsHeaderBlocks").submit();
	});
	$("#update_footer_block").click(function(){
		$("#formCmsFooterBlocks").submit();
	});
	$("a.add_options").click(function(){
		var fieldId=$(this).attr("id");
		var fieldTitle=$(this).attr("title");
		$('<input type="text" class="medium" name="'+fieldId+'[]" value="" />').fadeIn('slow').appendTo('#'+fieldTitle);
	});
});

function goBack(returnUrl){
	window.location=returnUrl;
}
function countSelectedList(){
  var n = $("input:checked").length;
  return n;
}
function viewSubcategories(catUrl){
	var countList=countSelectedList();
	if(countList==1){
		var pcatId=$("#formCategories input:checked").val();
		window.location=catUrl+"&pcatid="+pcatId;
	}else if(countList > 1){
		alert("Select a single category from the list to apply this actions.");
	}else{
		alert("First select a category from the list to apply actions.");
	}
}
function deleteCategories(catUrl){
	var countList=countSelectedList();
	if(countList==1 || countList > 1){
		var ok=confirm('Are you sure you want to D E L E T E?');
	}else{
		alert("First select a category from the list to apply actions.");
	}
}
function deleteProducts(catUrl){
	var countList=countSelectedList();
	if(countList==1 || countList > 1){
		var ok=confirm('Are you sure you want to D E L E T E?');
		if(ok){
			document.formProducts.action=catUrl;
			document.formProducts.submit();
		}else{
			return false;
		}
	}else{
		alert("First select a product from the list to apply actions.");
	}
}
function deleteHotels(catUrl){
	var countList=countSelectedList();
	if(countList==1 || countList > 1){
		var ok=confirm('Are you sure you want to D E L E T E?');
		if(ok){
			document.formProducts.action=catUrl;
			document.formProducts.submit();
		}else{
			return false;
		}
	}else{
		alert("First select a hotles from the list to apply actions.");
	}
}
$("#formPostComment").validate({
		errorLabelContainer: $("div.error_container"),
		rules: {
				name: "required",
				comment: "required",
				email: "required"
						},
		messages: {
				name: "Please enter Your name.",
				email: "Please enter a valid email address.",
				comment: "Please enter comment.",
				
		}
	});