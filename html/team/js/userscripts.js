/*Projects Scripts */
function jsResolve(item, comment, user){
  //$('#' + item).find('.open').removeClass('open');
  var pencil =$('#' + item).find('td.comment-btn');
  pencil.html("RESOLVED");
  pencil.addClass('project-header-like')
  pencil.removeClass('comment-btn');
  $('#' + item + ' select').attr('disabled', true);
  $('#' + item).removeClass("default info warning danger");
  $('#' + item).addClass("success");
  var date = new Date();
  var options = {month: "short", day: "2-digit", hour12:false};
  options.timeZone = "UTC";
  var dateString = "<span style=\"font-weight:bold; text-transform:uppercase; font-size:85%\">"  + 
      date.toLocaleDateString("en-US", options) + "</span> ";
  dateString += date.toLocaleTimeString("en-US", {hour12:false});
  var resolveBuild = "<tr>\
          <td class=\"details-title\">RESOLVED BY</td>\
          <td class=\"resolved-authordate\">" + user + " <span style=\"margin-right:10px;\">&nbsp;</span>" + dateString + "</td>\
        </tr>\
        <tr>\
          <td class=\"details-title\">MESSAGE</td>\
         <td class=\"resolved-comment\">"+comment+"</td></tr>";
  var moreinfo = $('#more-info-' + item + " tbody");
  moreinfo.html(moreinfo.html() + resolveBuild);
  
}

function resolveError(formPrefix, errorid, caller, itemToChange, e) {
        // Fill our request with data from our form
        var cmnt = $('textarea[name=Rcomment-' + formPrefix + ']').val();
        var formData = {
          'Rrescmnt' 	: $('textarea[name=Rcomment-' + formPrefix + ']').val(),
          'Rresusr' 	: caller,
          'Rid' 	: errorid,
          'token'  : $('input[name=restoken]').val(),
          'RES' : null
        };
        
        // Create our ajax requests
        var request = $.ajax({
          url: "/team/php/moderror.php",
          type: "POST", // Simple HTTP protocol
          data: formData, // Filling in our POSTDATA
          dataType: "html"
        })

        //If we're done & successful we print out any messages the php code echos out
        .done(function( msg ) {
           jsResolve(itemToChange, cmnt, caller);
           //window.location.reload(true);
        })
        
        .fail(function(xhr, status, error){
          
        });
  e.preventDefault();
}

function jsComment(item, comment){
  //$('#' + item).find('.open').removeClass('open');
  $('#more-info-' + item).find('td.comment').html(comment);
  var pencil =$('#' + item).find('a.comment-btn-link');
  pencil.html("<span style=\"font-size:80%; font-weight:bold\">COMMENTED</span>");
}

//['Mid','Msever', 'Musrid', 'Mcmnt', 'token', 'MOD'])
function modifyErrorComment(formPrefix, errorid, myid, itemToChange, e) {
        // Fill our request with data from our form
        var cmnt = $('textarea[name=Mcomment-' + formPrefix + ']').val();
        var formData = {
          'Mcmnt' 	: $('textarea[name=Mcomment-' + formPrefix + ']').val(),
          'Musrid' 	: myid,
          'Mid' 	: errorid,
          'Msever' : null,
          'token'  : $('input[name=modtoken]').val(),
          'MOD' : null
        };
        
        // Create our ajax requests
        var request = $.ajax({
          url: "/team/php/moderror.php",
          type: "POST", // Simple HTTP protocol
          data: formData, // Filling in our POSTDATA
          dataType: "html"
        })

        //If we're done & successful we print out any messages the php code echos out
        .done(function( msg ) {
          jsComment(itemToChange, cmnt);
           //window.location.reload(true);
        })
        
        .fail(function(xhr, status, error){
          
        });
  e.preventDefault();
}
function modifySeverity(formPrefix, errorid, severity, myid, itemToChange, e) {
        // Fill our request with data from our form
        var formData = {
          'Mcmnt' 	: null,
          'Musrid' 	: myid,
          'Mid' 	: errorid,
          'Msever' : severity,
          'token'  : $('input[name=modtoken]').val(),
          'MOD' : null
        };
        
        // Create our ajax requests
        var request = $.ajax({
          url: "/team/php/moderror.php",
          type: "POST", // Simple HTTP protocol
          data: formData, // Filling in our POSTDATA
          dataType: "html"
        })

        //If we're done & successful we print out any messages the php code echos out
        .done(function( msg ) {
          $(itemToChange).removeClass("default info warning danger");
          switch (severity){
            case '0':
              $(itemToChange).addClass("default");
              break;
            case '1':
              $(itemToChange).addClass("info");
              break;
            case '2':
              $(itemToChange).addClass("warning");
              break;
            case '3':
              $(itemToChange).addClass("danger");
              break;
          }
        })
        
        .fail(function(xhr, status, error){
          
        });
  e.preventDefault();
}

function dismissError(errorid, myid, itemToHide) {
        // Fill our request with data from our form
        var formData = {
          'Dusrid' 	: myid,
          'Did' 	: errorid,
          'token'  : $('input[name=modtoken]').val(),
          'DIS' : null
        };
        
        // Create our ajax requests
        var request = $.ajax({
          url: "/team/php/moderror.php",
          type: "POST", // Simple HTTP protocol
          data: formData, // Filling in our POSTDATA
          dataType: "html"
        })

        //If we're done & successful we print out any messages the php code echos out
        .done(function( msg ) {
           $(itemToHide).hide('fast');
        })
        
        .fail(function(xhr, status, error){
          
        });
  
}


function deployableScript(myId, projId){
  var user = null;
  var listener = "\
   window.onerror = function(msg, url, line, col, error) {<br>\
   var extra = !col ? '' : \"\\ncolumn: \" + col;<br>\
   extra += !error ? '' : \"\\nerror: \" + error;<br>\
   var severity = 0;<br>\
    if (error) {<br>\
     switch (error.name) {<br>\
       case 'EvalError':<br>\
       case 'RangeError':<br>\
       case 'TypeError':<br>\
         severity = 1;<br>\
         break;<br>\
       case 'ReferenceError':<br>\
       case 'SyntaxError':<br>\
       default:<br>\
         severity = 0;<br>\
         break;<br>\
      }<br>\
    }<br>\
   console.log('Error: ' + msg + \"\\nurl: \" + url + \"\\nline: \" + line + \"\\nseverity: \" + severity + extra);<br>\
   addError(msg, url,line, severity);<br>\
   var suppressErrorAlert = true;<br>\
   return suppressErrorAlert;<br>\
}<br>";
var actor = "function addError(msg, url, line, severity) {<br>\
  var formData = {'Aerr' : msg, 'Aline' : line, 'Asrc' : url, 'Asever' : severity, 'Ameth' : null, <br>\
                  'Ausr' : null, 'Ausrid' : '" + myId +"','Aprj' : '" + projId + "', 'ADD' : null};<br>\
         $.ajax({<br>\
          url: 'https://team.ninth.biz/team/php/logerror.php',<br>\
          type: 'POST', <br>\
          data: formData,<br>\
          dataType: 'html'<br>\
        })<br>\
        .done(function( msg ) { <br>\
          //Anything you might want to do after success<br>\
        })<br>\
      }";
  return listener + actor;
}
function displayScript (userid, projid) {
  var script = "&lt;script src=\"//code.jquery.com/jquery-1.11.1.min.js\"&gt&lt;/script&gt;<br>&lt;script&gt;<br>" + deployableScript(userid, projid) + "<br>&lt;/script&gt;";
  $('#script-body').html(script);
  $('#script-modal').modal('show');
}


      function removeUserFromProject (myId, userId, projId, idToHide){
        if (confirm("Are you sure you want to remove this user from your project?")) {
          if (removeUserFromProjectScript(myId, userId, projId)) {
            $("#" + idToHide).fadeOut("fast");
          }
        }
      }
      
      function removeUserFromProjectScript(myId, userId, projId) {
        // Fill our request with data from our form
        var formData = {};
        formData["RPUFmyid"] = myId;
        formData["RPUFuserid"] = userId;
        formData["RPUFprojectid"] = projId;
        
        // Create our ajax request
         return ($.ajax({
          url: "/team/php/pj_removeUser.php",
          type: "POST", // Simple HTTP protocol
          data: formData, // Filling in our POSTDATA
          dataType: "html"
        })
         
        //If we're done & successful we print out any messages the php code echos out
        .done(function( msg ) {
          // TODO :: Trigger display updates here
          $( "#response-container" ).html( msg ); 
          return true;
        })
         
        // Failed request 400 Bad Request is likely
        .fail(function(xhr, status, error) {
          $( "#response-container" ).html( xhr.responseText );
          return false;
        }));
      }

      function deleteProject (myId, projId, idToHide){
        if (confirm("Are you sure you want to delete this project?")) {
          if (deleteProjectScript(myId, projId)) {
            $("#" + idToHide).slideUp("fast");
          }
        }
      }

      function deleteProjectScript(myId, projId) {
        // Fill our request with data from our form
        var formData = {};
        formData["DPFmyid"] = myId;
        formData["DPFprojectid"] = projId;
        
        // Create our ajax request
         return ($.ajax({
          url: "/team/php/pj_deleteProject.php",
          type: "POST", // Simple HTTP protocol
          data: formData, // Filling in our POSTDATA
          dataType: "html"
        })
         
        //If we're done & successful we print out any messages the php code echos out
        .done(function( msg ) {
          // TODO :: Trigger display updates here
          $( "#response-container" ).html( msg ); 
          return true;
        })
         
        // Failed request 400 Bad Request is likely
        .fail(function(xhr, status, error) {
          $( "#response-container" ).html( xhr.responseText );
          return false;
        }));
      }
  
      function leaveProject (myId, projId, idToHide){
        if (leaveProjectScript(myId, projId)) {
          $("#" + idToHide).slideUp("fast");
        }
      }

      function leaveProjectScript(myId, projId) {
        // Fill our request with data from our form
        var formData = {};
        formData["LPFmyid"] = myId;
        formData["LPFprojectid"] = projId;
        
        // Create our ajax request
         return ($.ajax({
          url: "/team/php/pj_leaveProject.php",
          type: "POST", // Simple HTTP protocol
          data: formData, // Filling in our POSTDATA
          dataType: "html"
        })
         
        //If we're done & successful we print out any messages the php code echos out
        .done(function( msg ) {
          // TODO :: Trigger display updates here
          $( "#response-container" ).html( msg ); 
          return true;
        })
         
        // Failed request 400 Bad Request is likely
        .fail(function(xhr, status, error) {
          $( "#response-container" ).html( xhr.responseText );
          return false;
        }));
      }

      function projectScript(func, myId, userId, projId) {
        // Fill our request with data from our form
        var formData = {};
        var caller = func + "myid"
        var target = func + "userid";
        var project = func + "projectid";
        formData[caller] = myId;
        formData[target] = userId;
        formData[project] = projId;
        
        // Create our ajax request
         return ($.ajax({
          url: "/rolanderS.php",
          type: "POST", // Simple HTTP protocol
          data: formData, // Filling in our POSTDATA
          dataType: "html"
        })
         
        //If we're done & successful we print out any messages the php code echos out
        .done(function( msg ) {
          // TODO :: Trigger display updates here
          $( "#response-container" ).html( msg ); 
          return true;
        })
         
        // Failed request 400 Bad Request is likely
        .fail(function(xhr, status, error) {
          $( "#response-container" ).html( xhr.responseText );
          return false;
        }));
      }

  /*End Projects Scripts*/

/* Referral and Invite Scripts */
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
/* End of Referral and Invite Scripts */



/* Dashboard Graphing */
$('#show-errors').click(function () {
        $('#errors-toggle').show(function () {

          $('#userGraph').highcharts({
            title: {
              text: 'Monthly Error Tracking',
              x: -20 //center
            },
            subtitle: {
              text: 'Month of August',
              x: -20
            },
            xAxis: {
              categories: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25',
                           '26','27','28','29','30','31']
            },
            yAxis: {
              title: {
                text: 'Error Occurences'
              },
              plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
              }]
            },

            legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'middle',
              borderWidth: 0
            },
            series: [{
              name: 'RP (Resistricted Page Attempts)',
              data: [0,0,0,0,0,0,0,0,0,0,0,0,1]
            }, {
              name: 'FL (Failed Login Attempts)',
              data: [0,0,1,0,0,0,0,0,0,0,0,5,0]
            }]
          });
        });

      });
/* End of Dashboard Graphing */

/* Project Users Graphing */
$('#userData').on('shown.bs.modal', function() {

        $(function () {

          $('#alluserGraph').highcharts({
            title: {
              text: 'Monthly Error Tracking',
              x: -20 //center
            },
            subtitle: {
              text: 'Month of August',
              x: -20
            },
            xAxis: {
              categories: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25',
                           '26','27','28','29','30','31']
            },
            yAxis: {
              title: {
                text: 'Error Occurences'
              },
              plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
              }]
            },
            tooltip: {
              valueSuffix: '°C'
            },
            legend: {
              layout: 'vertical',
              align: 'right',
              verticalAlign: 'middle',
              borderWidth: 0
            },
            series: [{
              name: 'RP (Resistricted Page Attempts)',
              data: [0,0,0,0,0,0,0,0,0,0,0,0,1]
            }, {
              name: 'FL (Failed Login Attempts)',
              data: [0,0,1,0,0,0,0,0,0,0,0,5,0]
            }]
          });
        });
      });
/* End of Project Users Graphing */

