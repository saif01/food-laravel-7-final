

?>
<!--*********start Sweet alert For Submiting data **********-->
<script src="jslib.js"></script>
<script src="dev.js"></script>
<link rel="stylesheet" type="text/css" href="sweetalert.css">
<!--*********end Sweet alert For Submiting data **********-->

<?php

	 function success( $file_name ){

        
		?>	<script>

            var FineName= '<?php echo $file_name; ?>' ;
				setTimeout(function () { 
						swal({
						title: "Successfully!",
						text: "Data Add Completed!",
						type: "success",
						confirmButtonText: "OK"
						},
						function(isConfirm){
						if (isConfirm) {
							//history.back();
							window.location.href = FineName ;
						}
								},
									setTimeout(function(){
									window.location.href = FineName;
									//history.back();	
								}, 1000),

						); },0);
				</script>
				<?php
	}

	 function error(){
		?><script>
				setTimeout(function () { 
						swal({
						title: "Error!",
						text: "Data Add Not Completed!",
						type: "error",
						confirmButtonText: "OK"
						},
						function(isConfirm){
						if (isConfirm) {
							history.back();
							// window.location.href = "product-all";
						}
						},
								setTimeout(function(){
									history.back();	
								}, 1000),
							
								); },0);
				</script>
				<?php
	}


	?>