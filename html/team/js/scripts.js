/* Error Reporting Scripts */
window.onerror = function(msg, url, line, col, error) {
   // Note that col & error are new to the HTML 5 spec and may not be 
   // supported in every browser.  It worked for me in Chrome.
   var extra = !col ? '' : '\ncolumn: ' + col;
   extra += !error ? '' : '\nerror: ' + error;
   var severity = 0;
  // Get error type to judge severity
   switch (error.name) {
  	 case 'SyntaxError':
  		 severity = 0;
  		 break;
  	 case 'EvalError':
  		 severity = 1;
  		 break;
     case 'ReferenceError':
  		 severity = 0;
  		 break;
     case 'RangeError':
       severity = 1;
       break;
     case 'TypeError':
       severity = 1;
       break;
  	 default:
  			severity = 0;
  			break;
  	}
   // You can view the information in an alert to see things working like this:
  console.log("Error: " + msg + "\nurl: " + url + "\nline: " + line + "\nseverity: " + severity + extra);
   //alert("Error: " + msg + "\nurl: " + url + "\nline: " + line + extra);
  addError(msg, url,line, severity);
   // TODO: Report this error via ajax so you can keep track
   //       of what pages have JS issues

   var suppressErrorAlert = true;
   // If you return true, then error alerts (like in older versions of 
   // Internet Explorer) will be suppressed.
   return suppressErrorAlert;
};

function addError(msg, url, line, severity) {
        // Fill our request with data from our form
  var formData = {'Aerr' : msg, 'Aline' : line, 'Asrc' : url, 'Asever' : severity, 'Ameth' : null, 
                  'Ausr' : TeamNineLoggedUser, 'Aprj' : null, 'ADD' : null};
        // Create our ajax request
         $.ajax({
          url: "/team/php/logerror.php",
          type: "POST", // Simple HTTP protocol
          data: formData, // Filling in our POSTDATA
          dataType: "html"
        })
        //If we're done & successful we print out any messages the php code echos out
        .done(function( msg ) { 
        })
        
      }
/* End of Error Reporting Scripts */

/*Sign Up Scripts */
      function clearSignUpInputs() {
        $('input[name=Srepassword]').val("");
        $('input[name=Spassword]').val("");
        $('input[name=Semail]').val("");
        $('input[name=Suser]').val("");
        $('input[name=Prepassword]').val("");
        $('input[name=Ppassword]').val("");
        $('input[name=Pemail]').val("");
        $('input[name=Puser]').val("");
        $('input[name=Preferid]').val("");
        $('input[name=Pprojid]').val("");
      }
      /* Start Single Sign-Up Scripts */
      // This is needed if you plan on printing anything to the page
      // This grabs the submit function from the signup form
      $('#signup').submit(function(event) {
        signUp();
        event.preventDefault(); // This stops the form from refreshing the page VERY IMPORTANT
      });
      
      
      function signUp() {
        // Fill our request with data from our form
        var formData = {
          'Suser' 			: $('input[name=Suser]').val(),
          'Semail' 			: $('input[name=Semail]').val(),
          'Spassword' 	: $('input[name=Spassword]').val(),
          'Srepassword' : $('input[name=Srepassword]').val(),
          'token'      : $('input[name=Stoken]').val()

        }; 
        // Create our ajax request
         $.ajax({
          url: "/team/php/signup.php",
          type: "POST", // Simple HTTP protocol
          data: formData, // Filling in our POSTDATA
          dataType: "html"
        })
        //If we're done & successful we print out any messages the php code echos out
        .done(function( msg ) {
          $('#modal-signup').modal('hide');
          clearSignUpInputs();
          $( "#response-container" ).html( msg ); 
        })
         // Failed request 400 Bad Request is likely
        .fail(function(xhr, status, error) {
          $('input[name=Srepassword]').val("");
          $('input[name=Spassword]').val("");
          $( "#signup-response" ).html( xhr.responseText );
        });
      }
      /* End Single Sign-Up Scripts */
      
      /* Start Project Sign-Up Scripts */
      // This is needed if you plan on printing anything to the page
      // This grabs the submit function from the signup form
      $('#proj-signup').submit(function(event) {
        projSignUp();
        event.preventDefault(); // This stops the form from refreshing the page VERY IMPORTANT
      });
      
      function projSignUp() {
        // Fill our request with data from our form
        var formData = {
          'Suser' 			: $('input[name=Puser]').val(),
          'Semail' 			: $('input[name=Pemail]').val(),
          'Spassword' 	: $('input[name=Ppassword]').val(),
          'Srepassword' : $('input[name=Prepassword]').val(),
          'Sprojectid'  : $('input[name=Pprojid]').val(),
          'Sreferal'    : $('input[name=Preferid]').val(),
          'token'      : $('input[name=Ptoken]').val()
        }; 
        // Create our ajax request
         $.ajax({
          url: "/team/php/signup.php",
          type: "POST", // Simple HTTP protocol
          data: formData, // Filling in our POSTDATA
          dataType: "html"
        })
        //If we're done & successful we print out any messages the php code echos out
        .done(function( msg ) {
          $('#modal-signup').modal('hide');
          clearSignUpInputs();
          $( "#response-container" ).html( msg ); 
        })
         // Failed request 400 Bad Request is likely
        .fail(function(xhr, status, error) {
          $('input[name=Prepassword]').val("");
          $('input[name=Ppassword]').val("");
          $( "#signup-response" ).html( xhr.responseText );
        });
      }
      /* End Project Sign-Up Scripts */
      
      /* Forgot PW Scripts */
      $('#forgotpw').submit(function(event) {
        forgotPw();
        event.preventDefault(); // This stops the form from refreshing the page VERY IMPORTANT
      });
      function forgotPw() {
        // Fill our request with data from our form
        var formData = {
          'Fuser' 			: $('input[name=Fuser]').val(),
          'Femail' 			: $('input[name=Femail]').val(),
          'token'      : $('input[name=Ftoken]').val()
        };
        // Create our ajax request
         $.ajax({
          url: "/team/php/pwrecovery.php",
          type: "POST", // Simple HTTP protocol
          data: formData, // Filling in our POSTDATA
          dataType: "html"
        })
        //If we're done & successful we print out any messages the php code echos out
        .done(function( msg ) {
          $('#modal-forgotpw').modal('hide');
          $('input[name=Femail]').val("");
          $('input[name=Fuser]').val("");
          $( "#response-container" ).html( msg ); 
        })
         // Failed request 400 Bad Request is likely
        .fail(function(xhr, status, error) {
          $( "#forgotpw-resp" ).html( xhr.responseText );
        });
      }
    /* End of Forgot PW Scripts */

  // Grab file from upload dialog
      $('#upload-screen').change(function(click) {
        var file = this.value;
      });

    // Sign Up Script PW Checker
    function pwCompare(input, other) {
      if ($(input).val() != $(other).val()) {
        //$(input).addClass("invalid")
        input.setCustomValidity("Passwords Must Match!");
      } else {
          // input is valid -- reset the error message
          //$(input).removeClass("invalid")
         input.setCustomValidity("");
     }
    }

        /* Sign Up Modal Scripts */
      $('.module ul, ul.tabbed-list').each(function(){
        var parent = this;
        $(parent).children('li.tab').click(function(){
          $('.signup-pane').hide();
          $(parent).parent().siblings('.pane-toggle').hide();
          var itemToShow = $(this).attr('data-action');
          $(parent).parent().siblings("#" + itemToShow).show();
          $(parent).children('li.tab').removeClass('activeTab');
          $(this).addClass('activeTab');
        });
      });
      /* End Sign Up Modal Scripts */

      /* Project Sign Up Scripts */
      $('[name=Ppassword]').keyup(function(){
        if ($(this).is(":valid")) {
          $('.Prepassword').slideDown('fast');
        }
      });
      function projSignUpValid() {
        return $('[name=Ppassword]').is(":valid") && $('[name=Prepassword]').is(":valid") && $('[name=Puser]').is(":valid") && $('[name=Pemail]').is(":valid")
              && $('[name=Preferid]').is(":valid") && $('[name=Pprojid]').is(":valid");
      }

      $('form#proj-signup input').keyup(function(){
        if (projSignUpValid()){
          $('form#proj-signup [type=submit]').addClass('btn-valid');

        } else{
          $('form#proj-signup [type=submit]').removeClass('btn-valid');
        }
      });
      /* End Project Sign Up Scripts */

      /* Single Signup Scripts */
      $('[name=Spassword]').keyup(function(){
        if ($(this).is(":valid")) {
          $('.Srepassword').slideDown('fast');
        }
      });

      function signUpValid() {
        return $('[name=Spassword]').is(":valid") && $('[name=Srepassword]').is(":valid") && $('[name=Suser]').is(":valid") && $('[name=Semail]').is(":valid");
      }

      $('form#signup input').keyup(function(){
        if (signUpValid()){
          $('form#signup [type=submit]').addClass('btn-valid');

        } else{
          $('form#signup [type=submit]').removeClass('btn-valid');
        }
      });
      /* End Single Signup Scripts */

/* Various GUI Scipts */
    $('#adduser-btn').click(function(){
        var span = $(this).find("span");
        if (span.hasClass("glyphicon-circle-arrow-up")) {
          span.addClass("glyphicon-circle-arrow-down");
          span.removeClass("glyphicon-circle-arrow-up");
          $("#adduser-container").slideUp(300);
        } else {
          span.addClass("glyphicon-circle-arrow-up");
          span.removeClass("glyphicon-circle-arrow-down");
          $("#adduser-container").slideDown(300);
        }
      });

      $(function () {
        $("[data-rel='tooltip']").tooltip();
      });

      $(function () {
        $("[data-toggle='popover']").popover();
      });

      $('html').click(function(){
        $('#curly').hide();$('#team-container').show(); });

      $('.ignoreme').click(function(event){
        event.stopPropagation(); });
      
      $('#ad-show-users').click(function() {
        $('.jumbotron').hide();
        $('#usrmgt').show();});     

      $('.dropdown-toggle').dropdown();
     
      
      // ADD SLIDEDOWN ANIMATION TO DROPDOWN //
  $('.dropdown').on('show.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideDown("fast");
  });

  // ADD SLIDEUP ANIMATION TO DROPDOWN //
  $('.dropdown').on('hide.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').first().stop(true, true).slideUp("fast");
  });
      
      $("img.members")
      .click(function(){
        $('img.members').removeClass('face-selected');
        var otherguys = $('img.members').not($(this)).closest('div.members');
        otherguys.removeClass('face-selected');
        otherguys.addClass('face-unselected');
    

        $(this).addClass('face-selected');
        $(this).closest('div.members').addClass('face-selected');
        var dField = $(this).attr("data-click");
        $('.data').not($(dField)).hide();

        $(dField).show();
      });
/* End of Various GUI Scripts */


      Highcharts.createElement('link', {
        href: 'http://fonts.googleapis.com/css?family=Unica+One',
        rel: 'stylesheet',
        type: 'text/css'
      }, null, document.getElementsByTagName('head')[0]);



      // This grabs the submit function from the referral form
      $('#referal').submit(function(event) {
        referalSender();
        event.preventDefault(); // This stops the form from refreshing the page VERY IMPORTANT
      });
      
      function referalSender() {
        // Fill our request with data from our form
        var formData = {
          'RFemail' 	: $('input[name=RFemail]').val(),
          'token'  : $('input[name=reftoken]').val(),
          'INV' : null
        };
        // Create our ajax request
        var request = $.ajax({
          url: "/team/php/referral.php",
          type: "POST", // Simple HTTP protocol
          data: formData, // Filling in our POSTDATA
          dataType: "html"
        })

        //If we're done & successful we print out any messages the php code echos out
        .done(function( msg ) {
          $('input[name=RFemail]').val("");
          $( "#response-container" ).html( msg );
        })
        
        .fail(function(xhr, status, error) {
          $( "#response-container" ).html( xhr.responseText );
        })
      }
      
      
      
      
      // This grabs the submit function from the referral form
      $('.proj-invite').submit(function(event) {
        event.preventDefault(); // This stops the form from refreshing the page VERY IMPORTANT
      });
      
      function projSender(formPrefix, projid, myid) {
        // Fill our request with data from our form
        var formData = {
          'RIemail' 	: $('input[name=RIemail-' + formPrefix + ']').val(),
          'RIprojid' 	: projid,
          'RImyid' 	: myid,
          'token'  : $('input[name=reftoken]').val(),
          'PROJREF' : null
        };
        
        // Create our ajax requests
        var request = $.ajax({
          url: "/team/php/referral.php",
          type: "POST", // Simple HTTP protocol
          data: formData, // Filling in our POSTDATA
          dataType: "html"
        })

        //If we're done & successful we print out any messages the php code echos out
        .done(function( msg ) {
          $('input[name=RFemail]').val("");
          $( "#proj-resp-"+formPrefix ).html( msg );
        })
        
        .fail(function(xhr, status, error){
          $( "#proj-resp-"+formPrefix ).html( xhr.responseText );
        });
      }








