
// Form-Wizard.js
// ====================================================================
// This file should not be included in your project.
// This is just a sample how to initialize plugins or components.
//
// - ThemeOn.net -


$(document).ready(function() {

$(document).on('click', '#skip_tab_project', 'next'+'btn'+'btn-primary' ,function(){
				            console.log("inside cliked skip_tab_project");
						    $(this).data('clicked', true);
						    $(".next").click();
						});
	// FORM WIZARD
	// =================================================================
	// Require Bootstrap Wizard
	// http://vadimg.com/twitter-bootstrap-wizard-example/
	// =================================================================


	// MAIN FORM WIZARD
	// =================================================================
	$('#demo-main-wz').bootstrapWizard({

		tabClass		: 'wz-steps',
		nextSelector	: '.next',
		previousSelector	: '.previous',
		onTabClick: function(tab, navigation, index) {
			return false;
		},
		onInit : function(){
			
			$('#demo-main-wz').find('.finish').hide().prop('disabled', true);
		},
		onTabShow: function(tab, navigation, index) {
			
			var $total = navigation.find('li').length;
			var $current = index+1;
			var $percent = ($current/$total) * 100;
			var wdt = 100/$total;
			var lft = wdt*index;

			$('#demo-main-wz').find('.progress-bar').css({width:wdt+'%',left:lft+"%", 'position':'relative', 'transition':'all .5s'});


			// If it's the last tab then hide the last button and show the finish instead
			if($current >= $total) {
				$('#demo-main-wz').find('.next').hide();
				$('#demo-main-wz').find('.finish').show();
				$('#demo-main-wz').find('.finish').prop('disabled', false);
			} else {
				$('#demo-main-wz').find('.next').show();
				$('#demo-main-wz').find('.finish').hide().prop('disabled', true);
			}
		},
		onNext: function(){
			switch($('.tab-pane.active').attr('id')) {
					case "tab_profile":
						fields = ["first_name","last_name","phone","living_place", "about_user"];
						if(genericEmptyFieldValidator(fields)) {
					        
					        var phoneVal = $('#'+fields[2]).val();
					        
					        var stripped = phoneVal.replace(/[\(\)\.\-\ ]/g, '');    
							if (isNaN(parseInt(stripped))) {
								error("Contact No", "The mobile number contains illegal characters");
								$('#phone').css("border", "1px solid OrangeRed");
								return false;
							}
					        else if (phoneVal.length < 6) {
					          error("Contact No", "Make sure you included valid contact number");
					          $('#phone').css("border", "1px solid OrangeRed");
					          return false;
					        }
							postUpdateProfile(fields);
						}
						else
							return false;
						break;
					case "tab_tech_strength":
						fields = ["tech_strength"];
						
						$("#skip_tab_tech_strength").click(function(){
						    $(this).data('clicked', true);
						    console.log("inside clicked true, check");
						});
						if($('#skip_tab_tech_strength').data('clicked')) {
							console.log("inside clicked true");
							return true;
						}
						else {
							if(genericEmptyFieldValidator(fields))
					        	postUpdateTechStrength(fields);
							else 
								return false;
						}
						break;
			       	case "tab_work_exp":
				        fields = ["company_name", "designation", "work_from", "work_to"];
	
						$("#skip_tab_work_exp").click(function(){
						    $(this).data('clicked', true);
						});
						if($('#skip_tab_work_exp').data('clicked')) {
						   	return true;
						}
						else {
					        if(genericEmptyFieldValidator(fields))
					            postUpdateWorkExp(fields);
					        else 
								return false;
						}
				        break;							
				    case "tab_job_preference":
				        fields = ["current_ctc","expected_ctc","notice_period"];
				        console.log("i am there");
	
						$("#skip_tab_job_pref").click(function(){
						    $(this).data('clicked', true);
						});
						if($('#skip_tab_job_pref').data('clicked')) {
						   	return true;
						}
						else {
					        if(genericEmptyFieldValidator(fields)) {
								var flag = true;
					            $.each(fields, function( index, value ) {
				                
									var fieldVal = $("#"+ value).val();
									if (!$.isNumeric(fieldVal)) {
										$("#"+ value).css("border", "1px solid OrangeRed");
										flag = false;
									}
		  			            });

					            if (flag){
									postUpdateJobPreference(fields);
					            }
					            else {
					            	error("Job Preference Information", "The Information contains illegal characters");
					            	return false;
					            }
					        }
					        else
								return false;
						}
				        break;
				    case "tab_education":
				        fields = ["institute", "degree", "branch", "edu_from", "edu_to"];
	
						$("#skip_tab_education").click(function(){
						    $(this).data('clicked', true);
						});
						if($('#skip_tab_education').data('clicked')) {
						   	return true;
						}
						else {
					        if(genericEmptyFieldValidator(fields))
					           postUpdateEducation(fields);
					        else
								return false;
						}
				        break;
				    case "tab_projects":
				        fields = ["title","my_role","tech_skills","team_size","description"];
				        
				        
						if($('#skip_tab_project').data('clicked')) {
							console.log("inside clikeded true skip_tab_project");
						   	//return true;
						}
						else {
					        if(genericEmptyFieldValidator(fields))
					           postNewProject(fields);
					        else {
					        	error("Create Project", "Create Atleast one Project");
								return false;
							}
						}
				        break;
					case "tab_join_projects":
				    	return true;
				        break;
				   
				    default:
				    	return false;
				}

			return true;
		}

	});




	// CLASSIC FORM WIZARD
	// =================================================================
	$('#demo-cls-wz').bootstrapWizard({
		tabClass		: 'wz-classic',
		nextSelector	: '.next',
		previousSelector	: '.previous',
		onTabClick: function(tab, navigation, index) {
			return false;
		},
		onInit : function(){
			$('#demo-cls-wz').find('.finish').hide().prop('disabled', true);
		},
		onTabShow: function(tab, navigation, index) {
			var $total = navigation.find('li').length;
			var $current = index+1;
			var $percent = ($current/$total) * 100;
			var wdt = 100/$total;
			var lft = wdt*index;
			$('#demo-cls-wz').find('.progress-bar').css({width:$percent+'%'});

			// If it's the last tab then hide the last button and show the finish instead
			if($current >= $total) {
				$('#demo-cls-wz').find('.next').hide();
				$('#demo-cls-wz').find('.finish').show();
				$('#demo-cls-wz').find('.finish').prop('disabled', false);
			} else {
				$('#demo-cls-wz').find('.next').show();
				$('#demo-cls-wz').find('.finish').hide().prop('disabled', true);
			}
		}
	});




	// CIRCULAR FORM WIZARD
	// =================================================================
	$('#demo-step-wz').bootstrapWizard({
		tabClass		: 'wz-steps',
		nextSelector	: '.next',
		previousSelector	: '.previous',
		onTabClick: function(tab, navigation, index) {
			return false;
		},
		onInit : function(){
			$('#demo-step-wz').find('.finish').hide().prop('disabled', true);
		},
		onTabShow: function(tab, navigation, index) {
			var $total = navigation.find('li').length;
			var $current = index+1;
			var $percent = (index/$total) * 100;
			var wdt = 100/$total;
			var lft = wdt*index;
			var margin = (100/$total)/2;
			$('#demo-step-wz').find('.progress-bar').css({width:$percent+'%', 'margin': 0 + 'px ' + margin + '%'});


			// If it's the last tab then hide the last button and show the finish instead
			if($current >= $total) {
				$('#demo-step-wz').find('.next').hide();
				$('#demo-step-wz').find('.finish').show();
				$('#demo-step-wz').find('.finish').prop('disabled', false);
			} else {
				$('#demo-step-wz').find('.next').show();
				$('#demo-step-wz').find('.finish').hide().prop('disabled', true);
			}
		}
	});



	// CIRCULAR FORM WIZARD
	// =================================================================
	$('#demo-cir-wz').bootstrapWizard({
		tabClass		: 'wz-steps',
		nextSelector	: '.next',
		previousSelector	: '.previous',
		onTabClick: function(tab, navigation, index) {
		return false;
		},
		onInit : function(){
		$('#demo-cir-wz').find('.finish').hide().prop('disabled', true);
		},
		onTabShow: function(tab, navigation, index) {
		var $total = navigation.find('li').length;
		var $current = index+1;
		var $percent = (index/$total) * 100;
		var margin = (100/$total)/2;
		$('#demo-cir-wz').find('.progress-bar').css({width:$percent+'%', 'margin': 0 + 'px ' + margin + '%'});

		navigation.find('li:eq('+index+') a').trigger('focus');


		// If it's the last tab then hide the last button and show the finish instead
		if($current >= $total) {
			$('#demo-cir-wz').find('.next').hide();
			$('#demo-cir-wz').find('.finish').show();
			$('#demo-cir-wz').find('.finish').prop('disabled', false);
		} else {
			$('#demo-cir-wz').find('.next').show();
			$('#demo-cir-wz').find('.finish').hide().prop('disabled', true);
		}
		}
	})




	// FORM WIZARD WITH VALIDATION
	// =================================================================
	$('#demo-bv-wz').bootstrapWizard({
		tabClass		: 'wz-steps',
		nextSelector	: '.next',
		previousSelector	: '.previous',
		onTabClick: function(tab, navigation, index) {
			return false;
		},
		onInit : function(){
			$('#demo-bv-wz').find('.finish').hide().prop('disabled', true);
		},
		onTabShow: function(tab, navigation, index) {
			var $total = navigation.find('li').length;
			var $current = index+1;
			var $percent = (index/$total) * 100;
			var margin = (100/$total)/2;
			$('#demo-bv-wz').find('.progress-bar').css({width:$percent+'%', 'margin': 0 + 'px ' + margin + '%'});

			navigation.find('li:eq('+index+') a').trigger('focus');


			// If it's the last tab then hide the last button and show the finish instead
			if($current >= $total) {
				$('#demo-bv-wz').find('.next').hide();
				$('#demo-bv-wz').find('.finish').show();
				$('#demo-bv-wz').find('.finish').prop('disabled', false);
			} else {
				$('#demo-bv-wz').find('.next').show();
				$('#demo-bv-wz').find('.finish').hide().prop('disabled', true);
			}
		},
		onNext: function(){
			isValid = null;
			$('#demo-bv-wz-form').bootstrapValidator('validate');


			if(isValid === false)return false;
		}
	});




	// FORM VALIDATION
	// =================================================================
	// Require Bootstrap Validator
	// http://bootstrapvalidator.com/
	// =================================================================

	var isValid;
	$('#demo-bv-wz-form').bootstrapValidator({
		message: 'This value is not valid',
		feedbackIcons: {
		valid: 'fa fa-check-circle fa-lg text-success',
		invalid: 'fa fa-times-circle fa-lg',
		validating: 'fa fa-refresh'
		},
		fields: {
		username: {
			message: 'The username is not valid',
			validators: {
				notEmpty: {
					message: 'The username is required.'
				}
			}
		},
		email: {
			validators: {
				notEmpty: {
					message: 'The email address is required and can\'t be empty'
				},
				emailAddress: {
					message: 'The input is not a valid email address'
				}
			}
		},
		firstName: {
			validators: {
				notEmpty: {
					message: 'The first name is required and cannot be empty'
				},
				regexp: {
					regexp: /^[A-Z\s]+$/i,
					message: 'The first name can only consist of alphabetical characters and spaces'
				}
			}
		},
		lastName: {
			validators: {
				notEmpty: {
					message: 'The last name is required and cannot be empty'
				},
				regexp: {
					regexp: /^[A-Z\s]+$/i,
					message: 'The last name can only consist of alphabetical characters and spaces'
				}
			}
		},
		phoneNumber: {
			validators: {
				notEmpty: {
					message: 'The phone number is required and cannot be empty'
				},
				digits: {
					message: 'The value can contain only digits'
				}
			}
		},
		address: {
			validators: {
				notEmpty: {
					message: 'The address is required'
				}
			}
		}
		}
	}).on('success.field.bv', function(e, data) {
		// $(e.target)  --> The field element
		// data.bv      --> The BootstrapValidator instance
		// data.field   --> The field name
		// data.element --> The field element

		var $parent = data.element.parents('.form-group');

		// Remove the has-success class
		$parent.removeClass('has-success');


		// Hide the success icon
		//$parent.find('.form-control-feedback[data-bv-icon-for="' + data.field + '"]').hide();
	}).on('error.form.bv', function(e) {
		isValid = false;
	});



});
