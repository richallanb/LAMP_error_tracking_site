/*Projects Scripts */
      function removeUserFromProject (myId, userId, projId, idToHide){
        if (confirm("Are you sure you want to remove this user from your project?")) {
          if (removeUserFromProjectScript(myId, userId, projId)) {
            $("#" + idToHide).hide("fast");
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
            $("#" + idToHide).hide("fast");
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
          $("#" + idToHide).hide("fast");
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

