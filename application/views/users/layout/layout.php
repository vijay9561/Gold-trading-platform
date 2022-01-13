<!DOCTYPE html>
<html lang="en">
	 <?php $this->load->view('users/layout/head'); ?>
	<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" class="top" ng-controller="MainCtrl">
   <!-- Loader -->
	<?php  $this->load->view('users/layout/header'); ?>
	 <?php $this->load->view('users/layout/main_view',$data);?>
	  <?php $this->load->view('users/layout/footer');?>   
</body>
</html>
    