<?php if(isset($_SESSION['toastr_success'])): ?>
	<script type="text/javascript">
	    toastr.options.hideDuration = 250;
	    toastr.options.showDuration = 250;
	    toastr.options.progressBar = true;
	    toastr.options.timeOut = 3000;
		toastr.options.extendedTimeOut = 2000;
		toastr.success("<?= $_SESSION['toastr_success'] ?>", "Server Response:");
	</script>
	<?php unset($_SESSION['toastr_success']); ?>
<?php endif; ?>

<?php if(isset($_SESSION['toastr_error'])): ?>
	<script type="text/javascript">
	    toastr.options.hideDuration = 250;
	    toastr.options.showDuration = 250;
	    toastr.options.progressBar = true;
	    toastr.options.timeOut = 3000;
		toastr.options.extendedTimeOut = 2000;
		toastr.error("<?= $_SESSION['toastr_error'] ?>", "Server Response:");
	</script>
	<?php unset($_SESSION['toastr_error']); ?>
<?php endif; ?>

<?php if(isset($_SESSION['toastr_warning'])): ?>
	<script type="text/javascript">
	    toastr.options.hideDuration = 250;
	    toastr.options.showDuration = 250;
	    toastr.options.progressBar = true;
	    toastr.options.timeOut = 3000;
		toastr.options.extendedTimeOut = 2000;
		toastr.warning("<?= $_SESSION['toastr_warning'] ?>", "Server Response:");
	</script>
	<?php unset($_SESSION['toastr_warning']); ?>
<?php endif; ?>

