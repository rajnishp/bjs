<!-- Plugins -->
        <script src="<?= $this-> baseUrl ?>static/js/bootstrap.min.js"></script>
        <script src="<?= $this-> baseUrl ?>static/js/plugins.js"></script>
        <script src="<?= $this-> baseUrl ?>static/js/twitter/jquery.tweet.min.js"></script>
        <script src="<?= $this-> baseUrl ?>static/js/jquery.themepunch.tools.min.js"></script>
        <script src="<?= $this-> baseUrl ?>static/js/jquery.themepunch.revolution.min.js"></script>
        <script src="<?= $this-> baseUrl ?>static/js/jquery.mb.YTPlayer.js"></script>
        
        <script src="<?= $this-> baseUrl ?>static/js/main.js"></script>
            
        <!-- Google map javascript api v3 -->
        <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

        <script>
            /*----------------------------------------------------*/
            //* Google javascript api v3  -- map */
            /*----------------------------------------------------*/
            (function () {
                "use strict";

                if (document.getElementById("map") && typeof google === "object") {
                    var locations = [
                        ['<div class="map-info-box"><ul class="contact-info-list"><li><span><i class="fa fa-home fa-fw"></i></span> Mimar Sinan Mh., Konak/İzmir, Türkiye</li><li><span><i class="fa fa-phone fa-fw"></i></span> +90 0 (232) 324 11 83</li></ul></div>', 38.396652, 27.090560, 9],
                        ['<div class="map-info-box"><ul class="contact-info-list"><li><span><i class="fa fa-home fa-fw"></i></span> Kültür Mh., Konak/İzmir, Türkiye</li><li><span><i class="fa fa-phone fa-fw"></i></span> +90 0 (538) 324 11 84</li></ul></div>', 38.432742, 27.159140, 8]
                    ];

                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 13,
                        center: new google.maps.LatLng(28.4646699, 77.08448010000006),
                        scrollwheel: false,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        styles: [{"stylers":[{"hue":"#ff1a00"},{"invert_lightness":true},{"saturation":-100},{"lightness":33},{"gamma":0.5}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#2D333C"}]}]
                    });

                    var infowindow = new google.maps.InfoWindow();


                    var marker, i;

                    for (i = 0; i < locations.length; i++) {  
                      marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map,
                        animation: google.maps.Animation.DROP,
                        icon: 'images/pin.png',
                      });

                      google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                          infowindow.setContent(locations[i][0]);
                          infowindow.open(map, marker);
                        }
                      })(marker, i));
                    }
                }

            }());

            $(function() {
                // Slider Revolution for Home Section
                jQuery('#revslider').revolution({
                    delay:9000,
                    startwidth: 1140,
                    startheight: 600,
                    onHoverStop:"true",
                    hideThumbs:0,
                    lazyLoad:"on",
                    navigationType:"none",
                    navigationHAlign:"center",
                    navigationVAlign:"bottom",
                    navigationHOffset:0,
                    navigationVOffset:20,
                    soloArrowLeftHalign:"left",
                    soloArrowLeftValign:"center",
                    soloArrowLeftHOffset:0,
                    soloArrowLeftVOffset:0,
                    soloArrowRightHalign:"right",
                    soloArrowRightValign:"center",
                    soloArrowRightHOffset:0,
                    soloArrowRightVOffset:0,
                    touchenabled:"on",
                    stopAtSlide:-1,
                    stopAfterLoops:-1,
                    dottedOverlay:"twoxtwo",
                    spinned:"spinner5",
                    shadow:0,
                    hideTimerBar: "on",
                    fullWidth:"off",
                    fullScreen:"on",
                    navigationStyle:"preview3"
                  });
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function () {

                $("#modal_result_show").hide();
        
            });
        </script>

<script type="text/javascript">
    
    function showclass() {
        $(".salary_check").show();
    }
    function hideclass() {
        $(".salary_check").hide();
    }

    function genericEmptyFieldValidator(fields){
        returnBool = true;
        $.each(fields, function( index, value ) {
          console.log(value);
          if($('#'+value).val() == "" || $('#'+value).val() == null){
            $('#'+value).keypress(function() {
                genericEmptyFieldValidator([value]);
            });

            $('#'+value).css("border-color", "red");
            
            returnBool = false;
          }else{
            $('#'+value).css("border-color", "blue");
          }
        });

        return returnBool;
    }

    function postServiceRequest(fields, hire_type, value) {

        document.getElementById("submit_request").disabled = true;
        
        $('span[id^="post_request_status"]').empty();

        var dataString = "";
        $('#client_name').html( $('#'+fields[0]).val().capitalizeFirstLetter() );
        dataString = "name=" + $('#'+fields[0]).val() + "&email=" + $('#'+fields[1]).val() + "&mobile=" + $('#'+fields[2]).val() + 
                    "&needed=" + $('#'+fields[3]).val() + "&timing=" + $('#'+fields[4]).val() + "&timing2=" + $('#'+fields[5]).val() + 
                    "&salary=" + $('#'+fields[6]).val() + "&salary2=" + $('#'+fields[7]).val() + "&remarks=" + $('#'+fields[8]).val() + 
                    "&address=" + $('#'+fields[9]).val() + "&type=" + hire_type;
        if(value != 0){
            if(salary == 0 || salary2 == 0 || parseInt(salary2) < parseInt(salary)){
                $('#salary').css("border", "1px solid OrangeRed");
                $('#salary2').css("border", "1px solid OrangeRed");
                $('#salary_status').html("<font style= 'color: red;'>*Enter valid Salary. </font>");
                return false;
            }
        }
        else {}
        $.ajax({
             xhr: function(){
                    var xhr = new window.XMLHttpRequest();
                    //Upload progress
                    xhr.upload.addEventListener("progress", function(evt){
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        //Do something with upload progress
                        console.log(percentComplete);
                      }
                    }, false);
                    //Download progress
                    xhr.addEventListener("progress", function(evt){
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        //Do something with download progress
                        console.log(percentComplete);
                      }
                    }, false);
                    return xhr;
                },
            type: "POST",
            url: "<?= $this-> baseUrl ?>" + "home/serviceRequest",
            data: dataString,
            cache: false,
            success: function(result){
                document.getElementById("submit_request").disabled = false;
                $("#name").val("");
                $("#mobile").val("");
                $("#email").val("");
                $("#timing").val("");
                $("#needed").val("");
                $("#timing2").val("");
                $("#salary").val("");
                $("#salary2").val("");
                $("#address").val("");
                $("#remarks").val("");
                console.log("inside success");
                $("#modal_body_form").hide();
                $("#modal_result_show").show();
                setTimeout(function () {
                    $("#modal_body_form").show();
                    $("#modal_result_show").hide();
                    $("#close_modal").click();
                }, 10000);
            },
            error: function(result){
              console.log("inside error");
              console.log(result);
              $("#post_request_status").append(result);
                setTimeout(function () {
                  $('span[id^="post_request_status"]').empty();
                }, 10000);
            }
        });
        return false;
    }
    
    var hire_type = "";
    $('.shortcut').click(function(event) {
        hire_type = $(this).attr('id') ;
    });

    $('#close_modal').click(function(event) {
        $("#modal_body_form").show();
        $("#modal_result_show").hide();
    });

    function isValidDate(subject){
      if (subject.match(/^(?:(19|20)[0-9]{2})[\- \/.](0[1-9]|1[012])[\- \/.](0[1-9]|[12][0-9]|3[01])$/)){
        return true;
      }
      else{
        return false;
      }
    }

    function validateTime(time){
      var a=true;
      var time_arr=time.split(":");
      if(time_arr.length!=2)  a=false;
      else {
        if(isNaN(time_arr[0]) || isNaN(time_arr[1])){                
          a=false;
        }
        if(time_arr[0]<24 && time_arr[1]<60) {}
        else a =false;         
      }
      return a;
    }

    function validateServiceRequest(){

        $('span[id^="mobile_status"]').empty();
        var value = $("input[name=rate]:checked").val();
        if(value == 0) fields = ["name","email","mobile","needed","timing","timing2","remarks","address"];
        else fields = ["name","email","mobile","needed","timing","timing2","salary","salary2","remarks","address"];

        if (genericEmptyFieldValidator(fields)) {

            var phoneVal = $('#mobile').val();
            var emailVal = $('#email').val();
            var date = $('#needed').val();
            var timing = $('#timing').val();
            var timing2 = $('#timing2').val();
            var salary = $('#salary').val();
            var salary2 = $('#salary2').val();
                  
            var stripped = phoneVal.replace(/[\(\)\.\-\ ]/g, '');    
            if (isNaN(parseInt(stripped))) {
                //error("Contact No", "The mobile number contains illegal characters");
                $('#mobile').css("border", "1px solid OrangeRed");
                $('#mobile_status').html("<font style= 'color: red;'>*Enter valid mobile number. </font>");
                return false;
            }
            else if (phoneVal.length != 10) {
                //error("Contact No", "Make sure you included valid contact number");
                $('#mobile').css("border", "1px solid OrangeRed");
                $('#mobile_status').html("<font style= 'color: red;'>*Enter 10 digit  mobile number. </font>");
                return false;
            }
            else if(!(IsEmail(emailVal))) {
                $('#email').css("border", "1px solid OrangeRed");
                $('#email_status').html("<font style= 'color: red;'>*Enter valid Email-ID. </font>");
                return false;
            }
            else if(!(isValidDate(date))) {
                $('#needed').css("border", "1px solid OrangeRed");
                $('#needed_status').html("<font style= 'color: red;'>*Enter valid Date. </font>");
                return false;
            }
            else if(!(validateTime(timing))) {
                $('#timing').css("border", "1px solid OrangeRed");
                $('#timing_status').html("<font style= 'color: red;'>*Enter valid Time. </font>");
                return false;
            }
            else if(!(validateTime(timing2))) {
                $('#timing2').css("border", "1px solid OrangeRed");
                $('#timing_status').html("<font style= 'color: red;'>*Enter valid Time. </font>");
                return false;
            }
            else if(timing == 0 || timing2 == 0 || parseInt(timing2) < parseInt(timing)){
                $('#timing').css("border", "1px solid OrangeRed");
                $('#timing2').css("border", "1px solid OrangeRed");
                $('#timing_status').html("<font style= 'color: red;'>*Enter valid Time. </font>");
                return false;
            }
            postServiceRequest(fields, hire_type, value);
        
        }
        return false;
    }

    function postGetInTouch(fields) {

        var dataString = "";
        $('#get_in_touch_contact_name').html( $('#'+fields[0]).val().capitalizeFirstLetter() );
        dataString = "contactname=" + $('#'+fields[0]).val() + "&contactemail=" + $('#'+fields[1]).val() + "&contactsubject=" + $('#'+fields[2]).val() + "&contactmessage=" + $('#'+fields[3]).val();

        $.ajax({
            type: "POST",
            url: "<?= $this-> baseUrl ?>" + "home/getInTouch",
            data: dataString,
            cache: false,
            success: function(result){
                $("#contactname").val("");
                $("#contactemail").val("");
                $("#contactmessage").val("");
                $("#contactsubject").val("");

                console.log("inside success");
                $("#reset_form").click();
                $("#modal_get_in_touch_success").modal('show');


            },
            error: function(result){

            }
        });
        return false;
    }

    function IsEmail(email) {
      var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      return regex.test(email);
    }

    function validateGetInTouch(){
        
        fields = ["contactname", "contactemail", "contactsubject", "contactmessage"];

        if (genericEmptyFieldValidator(fields)) {

            if ( IsEmail($("#contactemail").val()) ) {
                postGetInTouch(fields);                
            }
            return false;
        
        }
        return false;

    }

String.prototype.capitalizeFirstLetter = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}



</script>
<script type="text/javascript">
var LHCChatOptions = {};
LHCChatOptions.opt = {widget_height:340,widget_width:300,popup_height:520,popup_width:500,domain:'blueteam.in'};
(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
var referrer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://')+1)) : '';
var location  = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';
po.src = '//livechat.blueteam.in/index.php/chat/getstatus/(click)/internal/(position)/bottom_right/(ma)/br/(top)/350/(units)/pixels/(leaveamessage)/true?r='+referrer+'&l='+location;
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=999514663402400";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-70488081-1', 'auto');
  ga('send', 'pageview');

</script>