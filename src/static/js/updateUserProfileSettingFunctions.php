<script type="text/javascript">
      

      function postUpdateSocialLinks(fields, key){
        var dataString = "";
          
        if (key != undefined) {
          dataString = "facebook_url=" + $('#'+fields[0]).val() + "&twitter_url=" + $('#'+fields[1]).val() + "&likedin_url=" + $('#'+fields[2]).val() + "&id=" + key;
        }
        else {
          dataString = "facebook_url=" + $('#'+fields[0]).val() + "&twitter_url=" + $('#'+fields[1]).val() + "&likedin_url=" + $('#'+fields[2]).val(); 
        }
        $.ajax({
          type: "POST",
          url: "<?= $baseUrl ?>" + "setting/updateSocialLinks",
          data: dataString,
          cache: false,
          success: function(result){
            success("Social Profile Linking",result);
          },
          error: function(result){
            error("Social Profile Linking",result);
          }

        });      
      }

      function validateUpdateSocialLink(key) {

        console.log("Inside Validate Social Links");
        
        fields = ["facebook_url","twitter_url","likedin_url"];

        if(key != undefined ){
           $.each(fields, function( index, value ) {

              fields[index] = value + "_" +key;

           });
        }

        if(genericEmptyFieldValidator(fields)){
          console.log("iam there");
          postUpdateSocialLinks(fields, key);

        }
        return false;
      }


      function postUpdateJobPreference(fields, key){
        var dataString = "";

        if (key != undefined) {
          dataString = "current_ctc=" + $('#'+fields[0]).val() + "&expected_ctc=" + $('#'+fields[1]).val() + "&notice_period=" + $('#'+fields[2]).val() + "&id=" + key;
        }
        else {
          dataString = "current_ctc=" + $('#'+fields[0]).val() + "&expected_ctc=" + $('#'+fields[1]).val() + "&notice_period=" + $('#'+fields[2]).val(); 
        }
        
        $.ajax({
          type: "POST",
          url: "<?= $baseUrl ?>" + "setting/updateJobPreference",
          data: dataString,
          cache: false,
          success: function(result){
            success("Job Preference",result);
          },
          error: function(result){
            error("Job Preference",result);
          }

        });
      }

      function validateUpdateJobPreference(key){

        console.log("Inside Validate Job Preference");
        
        fields = ["current_ctc","expected_ctc","notice_period"];

        if(genericEmptyFieldValidator(fields)) {
          var flag = true;
            $.each(fields, function( index, value ) {
              
              var fieldVal = $("#"+ value).val();
              if (!$.isNumeric(fieldVal)) {
                $("#"+ value).css("border", "1px solid OrangeRed");
                flag = false;
              }
            });

            if (flag) {
              postUpdateJobPreference(fields, key);
            }
            else {
              error("Job Preference Information", "The Information contains illegal characters");
              return false;
            }
        }
        return false;
      }

      function postUpdateProfile(fields){
        var dataString = "";

        var collaborateAsArray = [];
        collaborateAsArray = $('input[type=checkbox]:checked').map(function(_, el) {
          return $(el).val();
        }).get();        
        
        dataString = "first_name=" + $('#'+fields[0]).val() + "&last_name=" + $('#'+fields[1]).val() + "&phone=" + $('#'+fields[2]).val() + "&living_place=" + $('#'+fields[3]).val() + "&about_user=" + $('#'+fields[4]).val() + "&collaborateAs=" + collaborateAsArray;
        
        $.ajax({
          type: "POST",
          url: "<?= $baseUrl ?>" + "setting/updateUserInfo",
          data: dataString,
          cache: false,
          success: function(result){
            success("Profile Information",result);
          },
          error: function(result){
            error("Profile Information",result);
          }

        });      
      }



      function validateUpdateProfile(){

        console.log("Inside Validate user Profile");
        
        fields = ["first_name","last_name","phone","living_place", "about_user"];

        if(genericEmptyFieldValidator(fields)){
          
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
        return false;
      }

      function removeLocation(key){
        var dataString = "";
        
        dataString = "location_id="+key; 
        
        $.ajax({
          type: "POST",
          url: "<?= $baseUrl ?>" + "setting/removeLocation",
          data: dataString,
          cache: false,
          success: function(result){
            $('#location_'+key).remove();
            $('.tooltip.fade.top.in').remove();
            success("Preferred Job Location",result);
          },
          error: function(result){
            error("Preferred Job Location",result);
          }
        });
      }
      
      function postUpdateLocations(fields){
        var dataString = "";
        dataString = "locations="+fields;
        //alert (dataString); return false;
        
        $.ajax({
          type: "POST",
          url: "<?= $baseUrl ?>" + "setting/updateLocations",
          data: dataString,
          cache: false,
          success: function(result){
            success("Update Preferred Job Location",result);
          },
          error: function(result){
            error("Update Preferred Job Location",result);
          }

        });
      }
      function validateUpdateLocations(){

        console.log("Inside Validate user Preferred location");
        
        
        var locationsArray = []; 
        $('#demo-cs-multiselect1 :selected').each(function(i, selected){ 
          locationsArray[i] = $(selected).val(); 
        });
        if (typeof locationsArray !== 'undefined' && locationsArray.length > 0)
          postUpdateLocations(locationsArray);
        else {
          $('#demo-cs-multiselect1').css("border-color", "red");
          error("Preferred Job Location","Give atleast one location");
          return false;
        }
        return false;
      }

      function postUpdateSkills(fields1, fields2, fields3){
        var dataString = "";
        dataString = "skills="+fields1 + "&new_skills=" + fields2;
        //alert (dataString); return false;
        fields2 = fields2.split(',');
        //fields2 is a string, spplit converts it to an array with seperated by comma
        $.ajax({
          type: "POST",
          url: "<?= $baseUrl ?>" + "setting/updateSkills",
          data: dataString,
          cache: false,
          success: function(result){
            if (fields3 != undefined && fields3.length > 0) {
              $.each(fields3, function(key, value){
                $("#skills_display_div").append("<span class='btn btn-secondary btn-sm'>" + value + "<span>");
              });              
            }
            if (fields2 != undefined && fields2.length > 0) {
              $.each(fields2, function(key, value){
                $("#skills_display_div").append("<span class='btn btn-secondary btn-sm'>" + value + "<span>");
              });              
            }
            success("Update Skills",result);
          },
          error: function(result){
            error("Update Skills",result);
          }

        });
      }
      function validateUpdateSkills(){

        console.log("Inside Validate user Skills");
        
        var newSkillsArray = $('#new_skill').val();

        var skillsArray = []; 
        $('#demo-cs-multiselect :selected').each(function(i, selected){ 
          skillsArray[i] = $(selected).val(); 
        });

        var skillNamesArray = [];
        $('#demo-cs-multiselect :selected').each(function(i, selected){ 
          skillNamesArray[i] = $(selected).text(); 
        });
        
        if ((typeof skillsArray !== 'undefined' && skillsArray.length > 0) || (newSkillsArray != undefined && newSkillsArray.length > 0) )
          postUpdateSkills(skillsArray, newSkillsArray, skillNamesArray);
        else {
          $('#demo-cs-multiselect').css("border-color", "red");
          error("Skills","Select your skills");
          return false;
        }

        return false;
      }

      function removeSkill(key){
        var dataString = "";
        
        dataString = "skill_id="+key; 
        
        $.ajax({
          type: "POST",
          url: "<?= $baseUrl ?>" + "setting/removeSkill",
          data: dataString,
          cache: false,
          success: function(result){
            $('#skill_'+key).remove();
            $('.tooltip.fade.top.in').remove();
            success("Update Skill",result);
          },
          error: function(result){
            error("Update Skill",result);
          }

        });      
      }

      function postUpdateTechStrength(fields, key){
          var dataString = "";
          //console.log(clone);
          //return false;
          if (key != undefined) {
            dataString = "tech_strength=" + $('#'+fields[0]).val() + "&id=" + key ;
          } 
          else {
            dataString = "tech_strength=" + $('#'+fields[0]).val();
          }
  
          $.ajax({
                type: "POST",
                url: "<?= $baseUrl ?>" + "setting/updateTechStrength",
                data: dataString,
                cache: false,
                success: function(result){
                  var message = "";
                  if (key == undefined) {

                    appendCloneToDiv(fields,result, "#tech_strength_div", "#tech_strength_form");
                    message = "Added Successfully";
                  }
                  else {
                    message = "Update Successfully";
                  }
                  success("Activities and Achievement",message);
                  
                },
                 error: function(result){
                  console.log(result);
                  error("Activities and Achievement",result);
                }

          });

      }

      function validateUpdateTechStrength(key){

        console.log("Inside Validate Technical Strength",key);
        fields = ["tech_strength"];

        if(key != undefined ){
           $.each(fields, function( index, value ) {

              fields[index] = value + "_" +key;


           });
        }
        if(genericEmptyFieldValidator(fields)){

            postUpdateTechStrength(fields, key  );          

        }
        return false;
      }

      function postUpdateWorkExp(fields, key){
          var dataString = "";

          if (key != undefined) {
            dataString = "company_name=" + $('#'+fields[0]).val() + "&designation=" + $('#'+fields[1]).val() + "&from=" + $('#'+fields[2]).val() + "&to=" + $('#'+fields[3]).val() + "&id=" + key ;
          } 
          else {
            dataString = "company_name=" + $('#'+fields[0]).val() + "&designation=" + $('#'+fields[1]).val() + "&from=" + $('#'+fields[2]).val() + "&to=" + $('#'+fields[3]).val() ;
          }                        
          
          console.log(dataString);

          $.ajax({
            type: "POST",
            url: "<?= $baseUrl ?>" + "setting/updateWorkExp",
            data: dataString,
            cache: false,
            success: function(result){
              var message = "";
              if (key == undefined) {
                appendCloneToDiv(fields,result, "#work_exp_div", "#work_exp_form");
                message = "Added Successfully";
              }
              else {
                message = "Update Successfully";
              }
              success("Work Experience",message);
            },
            error: function(result){
              error("Work Experience", result);
            }
          });

      }

      function validateUpdateWorkExp(key){
        console.log("Inside Validate Work Experience");
        fields = ["company_name", "designation", "work_from", "work_to"];

        if(key != undefined ){
           $.each(fields, function( index, value ) {

              fields[index] = value + "_" +key;

           });
        }
        if (genericEmptyFieldValidator(fields)) {
            postUpdateWorkExp(fields, key);
        }
        return false;
      }


      function postUpdateEducation(fields, key){
          var dataString = "";

          if (key != undefined) {
            dataString = "institute=" + $('#'+fields[0]).val() + "&degree=" + $('#'+fields[1]).val() + "&branch=" + $('#'+fields[2]).val() + "&from=" + $('#'+fields[3]).val() + "&to=" + $('#'+fields[4]).val() + "&id=" + key ;
          } 
          else {
            dataString = "institute=" + $('#'+fields[0]).val() + "&degree=" + $('#'+fields[1]).val() + "&branch=" + $('#'+fields[2]).val() + "&from=" + $('#'+fields[3]).val() + "&to=" + $('#'+fields[4]).val() ;
          }

          $.ajax({
            type: "POST",
            url: "<?= $baseUrl ?>" + "setting/updateEducation",
            data: dataString,
            cache: false,
            success: function(result){
              var message = "";
              if (key == undefined) {
                appendCloneToDiv(fields,result, "#education_div", "#education_form");
                message = "Added Successfully";
              }
              else {
                message = "Update Successfully";
              }
              success("Education",message);
            },
            error: function(result){
              console.log(result);
              error("Education",result);
            }
          });

      }

      function validateUpdateEducation(key){
        
        console.log("Inside Validate Education");
        
        fields = ["institute", "degree", "branch", "edu_from", "edu_to"];

        if(key != undefined ){
            $.each(fields, function( index, value ) {

              fields[index] = value + "_" +key;

           });
        }

        if (genericEmptyFieldValidator(fields)) {
   
            postUpdateEducation(fields, key);
        }
        return false;

      }

      function postUpdatePassword(fields){
        //check new_password_1 and new_password_2 match or not
        var dataString = "";
            
        dataString = "old_password=" + $('#'+fields[0]).val() + "&new_password_1=" + $('#'+fields[1]).val() + "&new_password_2=" + $('#'+fields[2]).val();

        $.ajax({
          type: "POST",
          url: "<?= $baseUrl ?>" + "setting/updatePassword",
          data: dataString,
          cache: false,
          success: function(result){
            success("Reset Password",result);
          },
          error: function(result){
            console.log(result);
            error("Reset Password",result);
          }
        });
      }

      function validateUpdatePassword(){
        console.log("Inside Validate Password");
        fields = ["old_password", "new_password_1","new_password_2"];

        if (genericEmptyFieldValidator(fields)) {
            postUpdatePassword(fields);
        }
        return false;
      }

      function removeDiv(id) {
        $('#' + id).remove();
      }
      function postNewProject(fields, key){
        //fields = ["title","my_role","tech_skills","team_size","description"];
        var dataString = "";

        var members = $('#team_member_1').val() +","+ $('#team_member_2').val() +","+ $('#team_member_3').val() +","+ $('#team_member_4').val();
        dataString = "title=" + $('#'+fields[0]).val() + "&my_role=" + $('#'+fields[1]).val() + "&tech_skills=" + $('#'+fields[2]).val() + "&team_size=" + $('#'+fields[3]).val() + "&description=" + $('#'+fields[4]).val() + "&start=" + $('#start').val() + "&end=" + $('#end').val() + "&type=" + $('#type').val() + "&status=" + $('#status').val()  + "&members="+ members ;
        //console.log(dataString);
        
        $.ajax({
          type: "POST",
          url: "<?= $baseUrl ?>project/createProject",
          data: dataString,
          cache: false,
          success: function(result){
            var message = "";
              if (key == undefined) {
                appendCloneToDiv(fields,result, "#project_div", "#project_form");

                $('#switch_tab_project').append('<button type="button" class="next btn btn-primary" id="skip_tab_project" >Skip</button>');
                
                message = "Created Successfully";
              }
              else {
                message = "Update Successfully";
              }
              success("New Project",message);
            },
            error: function(result){
              error("New Project", result);
            }
        });
        //return false;
      }

      function validateCreateProject(key){
        fields = ["title","my_role","tech_skills","team_size","description"];
        
        if (genericEmptyFieldValidator(fields)) {
       
                postNewProject(fields, key);
        }

        return false;

      }

      </script>