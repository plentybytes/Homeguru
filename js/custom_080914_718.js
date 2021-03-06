$(document).ready(function(){
			// validate signup form on keyup and submit
	$("#register").validate({
		rules: {
			user_email: {
				required: true,
				email: true,
				},
			
			re_user_email: {
				required :true,
				equalTo: "#user_email",
			},
			user_password:  {
				required :true,
				rangelength:[5,25],
			},
			re_password: {
				required :true,
				equalTo: "#user_password",
			},
			hear_about : "required",
			name: "required",
			check: "required",
			user_name: {
					required : true,
					//alphanumeric: true,
					rangelength:[6,20],
					
			},
			
		},
		messages: {
			user_name: "Enter username use(a-z,0-9,_) \n limit 6-20",
			user_email: "Enter a valid e-mail address.",
			re_user_email: "Re-enter your e-mail address.",
			user_password: "Enter your password length must be 5 character .",
			re_password: "Re-enter your password",
			hear_about: "Select enter your address .",
			name: "Please enter your name.",
			check: "Checked the checkbox.",
		}
	});	
	
	$("#contactUs").validate({
		rules: {
			visiter_email: {
				required: true,
				email: true,
				},
			
			visiter_name: "required",
			visiter_subject: "required",
			visiter_message : "required",
			
		},
		messages: {
			visiter_name: "Please Enter Your Name",
			visiter_email: "Please Enter Your Email Address.",
			visiter_subject: "Please Enter Subject.",
			visiter_message: "Enter Your Message.",
			
		}
	});	
	$("#agent_contact_form").validate({
		rules: {
			msg_body_email: {
				required: true,
				email: true,
				},
			
			msg_body_phone :  {
				required :true,
				number :true,
				
			},
			
			msg_body_name: "required",
			msg_body_about_me: "required",
			msg_body_postcode: "required",
			msg_send_confirmation: "required",
			
						
		},
		messages: {
			msg_body_name: "Please enter your name",
			msg_body_email: "Please enter your email address.",
			msg_body_phone: "Please enter phone number.",
			msg_body_postcode: "Please enter your postcode.",
			msg_send_confirmation: "Please Confirmation Your message by checked button.",
			
			
		}
	});	
	
	$("#upload_pic").validate({
		rules: {
			
			
			upload_file: "required",
				
		},
		messages: {
			upload_file: "Please select file.",
				
		}
	});	
	$("#login_attamt").validate({
		rules: {
			user_name: "required",
			login_password: "required",
			
			
		},
		messages: {
			user_name: "Enter a valid username or email address.",
			login_password: "Enter your Password.",
		}
	});
	$("#change_pwd").validate({
		rules: {
			old_pwd: "required",
			new_pwd:  {
				required :true,
				rangelength:[5,25],
			},
			re_new_pwd: {
				required :true,
				equalTo: "#new_pwd",
			},
			
		},
		messages: {
			new_pwd: "Enter new password length must be 5 character.",
			re_new_pwd: "Re-enter your password",
			old_pwd: "Enter your old password",
		}
	});
	$("#forgotPwd").validate({
		rules: {
			user_name: "required",
			
			
			
		},
		messages: {
			user_name: "Enter a valid username or email address.",
			
		}
	});
	$("#change_profile").validate({
		rules: {
			user_number: "required",
			
			
			
		},
		messages: {
			user_number: "Enter a valid phone number.",
			
		}
	});
	$("#recoverPwd").validate({
		rules: {
			new_password:  {
				required :true,
				rangelength:[5,25],
			},
			re_password: {
				required :true,
				equalTo: "#new_password",
			},
			
		},
		messages: {
			new_password: "Enter new password length must be 5 character.",
			re_password: "Re-enter your password",
		}
	});
		$("#step_one").validate({
		rules: {
			property_category_id: "required",
			
			//state_id: "required",
			//city_id: "required",
			property_total_price: "required",
			property_bathrooms: "required",
			property_bedrooms: "required",
			property_floor_number: "required",
			user_number: "required",
			
			property_description :  {
				required :true,
				rangelength:[200,20000],
			},
		
			
		},
		messages: {
			property_category_id: "Select property category .",
			state_id: "Select county",
		
			city_id: "Select city your password",
			property_total_price: "Write list Price.",
			property_bathrooms: "Select bathrooms",
			property_bedrooms: "Select bedrooms.",
			property_floor_number: "Select floor number ",
			property_description: "Write description minimum 200 words.",
		}
	});
	$("#step_three").validate({
		rules: {
			email: "required",
			contact_person: "required",
			"#landline" :  {
				required :true,
				number :true,
				rangelength:[8,20],
			},
			
			'#mobile_numberq' :  {
				required :true,
				number :true,
				rangelength:[8,20],
			},
		
			
		},
		messages: {
			email: "Write your Contact email.",
			contact_person: "Write contact person name ",
			'#mobile_numberq' : "Write Mobile number",
			"#landline" : "Write Landline Number.",
			
		}
	});
	$("#step_two").validate({
		rules: {
			property_furnishing: "required",
			
			property_ownership_type: "required",
		},
		messages: {
			property_furnishing: "Select property furnishing.",
			
			property_ownership_type: "Select property ownership.",
		}
	});
	$('div.icon').click(function(){
		$('input#search').focus();
	});

	// Live Search
	// On Search Submit and Get Results
	function search() {
		var query_value = $('input#search').val();
		$('b#search-string').html(query_value);
		if(query_value !== ''){
			$.ajax({
				type: "POST",
				url: "search.php",
				data: { query: query_value },
				cache: false,
				success: function(html){
					$("ul#results").html(html);
				}
			});
		}return false;    
	}

	$("input#search").live("keyup", function(e) {
		// Set Timeout
		clearTimeout($.data(this, 'timer'));

		// Set Search String
		var search_string = $(this).val();

		// Do Search
		if (search_string == '') {
			$("ul#results").fadeOut();
			$('h4#results-text').fadeOut();
		}else{
			$("ul#results").fadeIn();
			$('h4#results-text').fadeIn();
			$(this).data('timer', setTimeout(search, 100));
		};
	});

		
});


