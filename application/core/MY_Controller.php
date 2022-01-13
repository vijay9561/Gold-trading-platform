<?php

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
		//$this->load->library('session/session');

    }
    public function layout_users($data) {
	$temp['data'] = $data;
        $temp['title'] = $data['title'];
        $temp['page']=$data['page'];
        $this->load->view('users/layout/layout', $temp);
    }
	public function layout_admin($data) {
        if($this->session->userdata('ADMIN_ID')!=null){
        $temp['data'] = $data;
        $temp['title'] = $data['title'];
		 $temp['page']=$data['page'];
        $this->load->view('admin/layout/layout', $temp);
		}
	  else
		{
		  redirect('admin-login');
		}
	}
	
	 public function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = ''){
 $target_path = $target_folder;
 $thumb_path = $thumb_folder;
 $filename_err = explode(".",$_FILES[$field_name]['name']);
 $filename_err_count = count($filename_err);
 $file_ext = $filename_err[$filename_err_count-1];
 if($file_name != '')
 { $fileName = $file_name.'.'.$file_ext; } else { $fileName = $_FILES[$field_name]['name']; }
 $upload_image = $target_path.basename($fileName);
 if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image)) {
  if($thumb == TRUE) {
   $thumbnail = $thumb_path.$fileName;
   list($width,$height) = getimagesize($upload_image);
   $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
   switch($file_ext){
    case 'jpg':
     $source = imagecreatefromjpeg($upload_image);
     break;
    case 'jpeg':
     $source = imagecreatefromjpeg($upload_image);
     break;
    case 'png':
     $source = imagecreatefrompng($upload_image);
     break;
    case 'gif':
     $source = imagecreatefromgif($upload_image);
     break;
     default:
     $source = imagecreatefromjpeg($upload_image);
   }
   imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
   switch($file_ext){
    case 'jpg' || 'jpeg':
     imagejpeg($thumb_create,$thumbnail,100);
     break;
    case 'png':
     imagepng($thumb_create,$thumbnail,100);
     break;
    case 'gif':
     imagegif($thumb_create,$thumbnail,100);
     break;
    default:
     imagejpeg($thumb_create,$thumbnail,100);
   }
  }
  return $fileName;
 }
 else
 {
  return false;
 }
}
}
