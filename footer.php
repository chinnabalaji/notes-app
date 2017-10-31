	<!-- Footer -->
		
	  <!-- /main content -->
	  
  </div>
  <!-- /main container -->
  
</div>
<!-- /page container -->
<script src="<?php echo $admin_path;?>js/jquery.min.js"></script>
<script src="<?php echo $admin_path;?>js/bootstrap.min.js"></script>
<script src="<?php echo $admin_path;?>js/plugins/metismenu/jquery.metisMenu.js"></script>
<script src="<?php echo $admin_path;?>js/plugins/blockui-master/jquery-ui.js"></script>
<script src="<?php echo $admin_path;?>js/plugins/blockui-master/jquery.blockUI.js"></script>
<script src="<?php echo $admin_path;?>js/functions.js"></script>
<script src="<?php echo $admin_path;?>js/jquery-validation.js"></script>

<script src="<?php echo $admin_path;?>js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $admin_path;?>js/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo $admin_path;?>js/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo $admin_path;?>js/plugins/datatables/jszip.min.js"></script>
<script src="<?php echo $admin_path;?>js/plugins/datatables/pdfmake.min.js"></script>
<script src="<?php echo $admin_path;?>js/plugins/datatables/vfs_fonts.js"></script>
<script src="<?php echo $admin_path;?>js/plugins/datatables/extensions/Buttons/js/buttons.html5.js"></script>
<script src="<?php echo $admin_path;?>js/plugins/datatables/extensions/Buttons/js/buttons.colVis.js"></script>
<script src="<?php echo $admin_path;?>ajax.js" type="text/javascript"></script>

<script>
	$(document).ready(function () {
		
		$('.dataTables-example').DataTable({
	
			dom: '<"html5buttons" B>lTfgitp',
			buttons: [
				{
					extend: 'copyHtml5',
					exportOptions: {
						columns: [ 0, ':visible' ]
					}
				},
				{
					extend: 'excelHtml5',
					exportOptions: {
						columns: ':visible'
					}
				},
				{
					extend: 'pdfHtml5',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4 ]
					}
				},
				'colvis'
			]
		});
	});
</script>
<script src="<?php echo $admin_path;?>js/plugins/summernote/summernote.min.js"></script>
<!--Markdown Editor-->
<script src="<?php echo $admin_path;?>js/plugins/markdown/bootstrap-markdown.js"></script>
<script src="<?php echo $admin_path;?>js/plugins/markdown/markdown.js"></script>
<script>
	 $(document).ready(function(){
		$('#summernote').summernote({
		  height: 260,                 // set editor height
		  minHeight: null,             // set minimum height of editor
		  maxHeight: null,             // set maximum height of editor
		  focus: true                  // set focus to editable area after initializing summernote
		});
		
		
	});
</script>
<script src="<?php echo $admin_path;?>js/plugins/datepicker/bootstrap-datepicker.js"></script>

</body>

</html>

<script src="<?php echo $admin_path;?>js/dcalendar.picker.js"></script>


<script>
$('#from_date').dcalendarpicker();
$('#to_date').dcalendarpicker();
$('#iwallet_trans_date').dcalendarpicker();
</script>