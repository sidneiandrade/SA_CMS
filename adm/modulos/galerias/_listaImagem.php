<?php 

$folder_name = '../../uploads/';

$result = array();

$files = scandir($folder_name);

$output = '<div class="row">';

if(false !== $files)
{
 foreach($files as $file)
 {
  if('.' !=  $file && '..' != $file)
  {
   $output .= '
   <div class="col-md-2 text-center">
    <img src="'.$folder_name.$file.'" class="img-thumbnail" />
    <button type="button" class="btn btn-danger btn-sm btn-block remove_image" id="'.$file.'">Apagar</button>
   </div>
   ';
  }
 }
}
$output .= '</div>';
echo $output;


if(isset($_POST["name"]))
{
 $filename = $folder_name.$_POST["name"];
 unlink($filename);
}