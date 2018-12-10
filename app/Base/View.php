<?php    

  // Function for creating current page title
function title($title='')
{
  return empty($title) ? ucwords(APP_NAME) : $title.' || '.ucwords(APP_NAME);
}

  // Function for generating icon location
function icon($ico='')
{
  if(strpos($ico, "https://") !== false || strpos($ico, "http://") !== false){
    return '<link rel="icon" href="'.$ico.'">';
  }
  else{
    return (APP_ENV == 'dev') ? '<link href="'.APP_URL.'/resources/assets/'.$ico.'?'.mt_rand().'" rel="stylesheet">' : '<link href="'.APP_URL.'/resources/assets/'.$ico.'" rel="stylesheet">';
  }
}

  // Function for showing image
function image($src, $alt='', $misc = array()){
  $image = '<img src="';
  if(file_exists($src)){
    $image .= (APP_ENV == 'dev') ? $src."?".time()  : $src;
  }
  else{
    $image .= "https://via.placeholder.com/150?text=Image+Missing";
  } 
  $image .= '" alt="'.$alt.'"';
  if(!empty($misc)){
    foreach ($misc as $key => $value) {
      $image .= ' "'.$key.'"="'.$value.'"';
    }
  }
  $image .= '>';
  return $image;
}

  // Function for generating style location
function style($style='')
{
  if(strpos($style, "https://") !== false || strpos($style, "http://") !== false){
    return '<link href="'.$style.'" rel="stylesheet">';
  }
  else{
    return (APP_ENV == 'dev') ? '<link href="'.APP_URL.'/resources/assets/'.$style.'?'.mt_rand().'" rel="stylesheet">' : '<link href="'.APP_URL.'/resources/assets/'.$style.'" rel="stylesheet">';
  }
}

  // Function for generating script location
function script($script='')
{
  if(strpos($script, "https://") !== false || strpos($script, "http://") !== false){
    return '<script type="text/javascript" src="'.$script.'"></script>';
  }
  else{
    return (APP_ENV == 'dev') ? '<link href="'.APP_URL.'/resources/assets/'.$script.'?'.mt_rand().'" rel="stylesheet">' : '<link href="'.APP_URL.'/resources/assets/'.$script.'" rel="stylesheet">';
  }
}

  // Function for including view
function append($_location='', $_data='')
{
  $_location_array =  explode(".",$_location);

  $_file = 'resources/views';
  foreach ($_location_array as $loc) {
    $_file .= '/'.$loc; 
  }
  $_file .= '.php';

  if(!empty($_data)){
    extract($_data);
  }

  if(file_exists($_file)){
    include($_file);
  }
}

  // Function for extending layout
function inherits($_location='')
{
  $_location_array =  explode(".",$_location);

  $_file = 'resources/views';
  foreach ($_location_array as $loc) {
    $_file .= '/'.$loc; 
  }
  $_file .= '.php';

  if(file_exists($_file)){
    include($_file);
  }
}

  // Function for generating link
function route($route_url, $parameters= array())
{

  $link = APP_URL.'/'.$route_url;

  if(!empty($parameters)){
    $link .= '/?';
    $count = 1;
    foreach($parameters as $key=>$value){
      if($count > 1){
        $link .= '&';
      }
      $link .= $key.'='.$value;
      $count++;
    }
  }

  return $link;

}

?>