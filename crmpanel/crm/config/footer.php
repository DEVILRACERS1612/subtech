	<div class="page-footer">
		<div class="page-footer-inner"> <?php echo date("Y");?> &copy; <?php echo $school['cmp_name'];?>
			<a href="mailto:info@microelectra.in" target="_top" class="makerCss">MicroElectra</a>
		</div>
		<div class="scroll-to-top">
			<i class="icon-arrow-up"></i>
		</div>
	</div>

	<script src="<?php echo BASE_PATH;?>assets/plugins/popper/popper.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/jquery-blockui/jquery.blockui.min.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
	<!-- bootstrap -->
	<script src="<?php echo BASE_PATH;?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
	<!-- bootstrap Datepicker-->
    <script src="<?php echo BASE_PATH;?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script src="<?php echo BASE_PATH;?>assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker-init.js" charset="UTF-8"></script>
	<!-- owl carousel -->
	<script src="<?php echo BASE_PATH;?>assets/plugins/owl-carousel/owl.carousel.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/js/pages/owl-carousel/owl_data.js"></script>

	<!-- counterup -->
	<script src="<?php echo BASE_PATH;?>assets/plugins/counterup/jquery.waypoints.min.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/counterup/jquery.counterup.min.js"></script>
	<!-- Common js-->
	<script src="<?php echo BASE_PATH;?>assets/js/app.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/js/layout.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/js/theme-color.js"></script>
	<!-- material -->
	<script src="<?php echo BASE_PATH;?>assets/plugins/material/material.min.js"></script>
	<!-- chart js -->
	<script src="<?php echo BASE_PATH;?>assets/plugins/chart-js/Chart.bundle.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/chart-js/utils.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/js/pages/chart/chartjs/home-data2.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/sparkline/jquery.sparkline.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/js/pages/sparkline/sparkline-data.js"></script>
	<!-- data tables -->
	<!-- notifications -->
	<script src="<?php echo BASE_PATH;?>assets/plugins/jquery-toast/dist/jquery.toast.min.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/jquery-toast/dist/toast.js"></script>
	<!-- Data Table -->
	<script src="<?php echo BASE_PATH;?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/datatables/export/dataTables.buttons.min.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/datatables/export/buttons.flash.min.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/datatables/export/jszip.min.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/datatables/export/pdfmake.min.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/datatables/export/vfs_fonts.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/datatables/export/buttons.html5.min.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/datatables/export/buttons.print.min.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/js/pages/table/table_data.js"></script>
	
	<!--<script src="<?php echo BASE_PATH;?>assets/js/pages/material-select/getmdl-select.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/material-datetimepicker/moment-with-locales.min.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/material-datetimepicker/bootstrap-material-datetimepicker.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/material-datetimepicker/datetimepicker.js"></script>
	 dropzone -->
	<script src="<?php echo BASE_PATH;?>assets/plugins/dropzone/dropzone.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/dropzone/dropzone-call.js"></script>
	<script src="<?php echo BASE_PATH;?>assets/plugins/jquery-tags-input/jquery-tags-input.js"></script>
    <script src="<?php echo BASE_PATH;?>assets/plugins/jquery-tags-input/jquery-tags-input-init.js"></script>
	 <!--select2-->
    <script src="<?php echo BASE_PATH;?>assets/plugins/select2/js/select2.js"></script>
    <script src="<?php echo BASE_PATH;?>assets/js/pages/select2/select2-init.js"></script>
<script>
	function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
	if(charCode==46 ||charCode==43 ||charCode==45 ){return true;}
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
	}
	</script>
	<script type="text/javascript">
    function uploadimg(a) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadinput"+a).files[0]);

        oFReader.onload = function (oFREvent) {
            //document.getElementById("image"+a).src = oFREvent.target.result;
			document.getElementById("upload"+a).src = oFREvent.target.result;
        };
    }

$(document).ready(function () {
	$('.dp1').datepicker({
		format: 'dd-mm-yyyy'
	});
	$('#dp2').datepicker({
		format: 'mm-dd-yyyy'
	});
	$('#dp3').datepicker({
		format: 'mm-dd-yyyy'
	});

});
</script>