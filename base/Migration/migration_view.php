<!DOCTYPE html>
<html lang="en">

  <!-- Header -->
  <head>
    <!-- Favicon-->
    <link rel="icon" href="resources/assets/img/favicon.png">
    <title></title>
    
    <!-- CSS-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<style>
		body {
          background-color: #f2f2f2;
      	}
		.form-control {;
		    text-align:center;
		}
		input:focus::-webkit-input-placeholder {
    		opacity: 0;
		}
		a:link {
		  text-decoration: none;
		}
		.brand {  
			position:absolute;
			bottom:0px;
			right:25%;
			left:50%;
		}
		.custom-control-label:before{
		  background-color: #ffb3b3;
		}
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before{
		  background-color: #00b300;
		}
    </style>

  </head>
  <!-- #ENDS# Header -->

  <body>
        <div class="my-5 mx-5" align="center">
      		<h1 class="mb-5 text-secondary" id="project_name"></h1>
        	<h3 class="text-info mb-3">Welcome to Migration!</h3> 
        	<div id="feedback" class="my-5"></div>
        </div>    

		<p class="small brand">
			<a href="https://www.codecubeit.com/" class="text-muted">codecube.com</a> 
		</p>           

    <!-- JQuery -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="http://malsup.github.io/jquery.form.js"></script>

	<script>

		$(document).ready(function(){
				
				// Check Project name and environment
			$.ajax({
			    url: 'base/Migration/check_env.php',
			    type: 'GET',
			    dataType: 'JSON',
			    beforeSend: function(){
			      document.title = 'Database Migration';
			      $("#project_name").empty().append('<i class="fa fa-spinner fa-spin"></i>');
			      $("#feedback").empty().append('<i class="fa fa-spinner fa-spin"></i>');
			    },
			    success:function(response){
			      document.title = 'Database Migration || '+response['name'];
			      $("#project_name").empty().append(response['name']).hide().fadeIn('slow');
			      if(response['env'] != 'dev'){
			      	$("#feedback").empty().append('<h4 class="text-muted"><i class="far fa-frown pr-2"></i>Oops..</h4><p class="text-danger">Migration is unavialable at the moment!</p>').hide().fadeIn('slow');
			      }
			      else{
			      	var html = '';
			      	html +='<form class="mb-5 mx-5 execute-form" method="post" action="base/Migration/execute_queries.php">';
                        html +='<div class="form-group">';
                            html +='<label for="key">Please enter project execution key to continue..</label>';
                           	html +='<input type="password" class="form-control" id="key" name="app-key" placeholder="KEY" pattern=".{3,}" required title="3 characters minimum">';
                            html +='<small id="key" class="form-text text-muted">Check out project configuration file to find out your key!</small>';
                        html +='</div>';
                        html +='<div class="custom-control custom-checkbox my-3">';
                           	html +='<input type="checkbox" class="custom-control-input" id="reset_migration" name="reset_migration" value="reset">';
                           	html +='<label class="custom-control-label" for="reset_migration">Reset Migration Table</label>';
                            html +='<small id="reset_migration" class="form-text text-muted">By default migration only executes newly added queries ! Check this box it if you want all queries executed!</small>';
                        html +='</div>';
                        html +='<button type="submit" class="btn btn-primary text-uppercase">Proceed<i class="fas fa-angle-double-right pl-2"></i></button>';
                    html +='</form>';

			      	$("#feedback").empty().append(html).hide().fadeIn('slow');

			      		// Execute Queries
				    (function() {
					    $('.execute-form').ajaxForm({
					      beforeSend: function() {
					      	$('#feedback').html('<p class="text-info">Database migration in progress...</p>');
					      },
					      uploadProgress: function(event, position, total, percentComplete) {
					        percentVal = percentComplete + '%';
			            	$('#feedback').html('<p class="text-info">Database migration in progress...</p><div class="progress"><div class="progress-bar bg-success" role="progressbar" style="width: '+percentVal+'" aria-valuenow="'+percentComplete+'" aria-valuemin="0" aria-valuemax="100">'+percentVal+'</div></div>');
					      },
					      success: function() {
					        $('#feedback').html('<p class="text-success">Migration Complete!</p><div class="progress"><div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100</div></div>');    
					      },
					      error: function() {
					      	$('#feedback').empty().append('<p class="text-danger"><i class="fa fa-warning pr-2"></i>Something went wrong in the server! Please wait until the page refreshes..</p><div class="progress"><div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>').fadeIn("slow");
			        		setTimeout(function() {
							    location.reload();
							}, 1000);
					      },
					      complete: function(xhr) {
					      	$(".brand").remove();
			                $('#feedback').append("<h5 class='my-5 text-secondary'><i class='far fa-clock pr-2'></i>Waiting for return messages...</h5>");
			                var time = 1000;
					        var message = JSON.parse(xhr.responseText);
			                for( var i = 0; i<message.length; i++){
							    var info = $("<p />");
							    info.attr('class',"text-info");
							    info.html('<i class="far fa-hand-point-right pr-2"></i>'+message[i]);
							    info.hide();
							    $('#feedback').append(info);
							    time += 100;
							    info.delay(time).fadeIn('fast');
							};
			                $('#feedback').append("<p class='small'><a href='https://www.codecubeit.com/' class='text-muted'>codecube.com</a></p>");
					      }
					    }); 
			  		})();
			      }
			    }
			});
		});

	</script>

</html>