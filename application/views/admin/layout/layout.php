<!DOCTYPE html>
<html lang="en">
	 <?php $this->load->view('admin/layout/head'); ?>
	<body class="fixed-nav sticky-footer bg-dark" id="page-top">
	<?php  $this->load->view('admin/layout/header'); ?>
	  <div class="content-wrapper">
	 <?php $this->load->view('admin/layout/main_view',$data);?>
	  <?php $this->load->view('admin/layout/footer');?>   
	  </div>
</body>
</html>
    