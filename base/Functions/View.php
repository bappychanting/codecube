<?php   

  // Function for creating current page title
function title($title='')
{
  return empty($title) ? ucwords(APP_NAME) : $title.' || '.ucwords(APP_NAME);
}

    // Function for creating csrf token
function csrf_token()
{
  $token_data = getTokenData();
  return $token_data['csrf_token'];  
}

  // Function for returning source of asset
function asset($src){
  $src = (APP_ENV == 'dev') ? APP_URL.'/'.$src."?".time()  : APP_URL.'/'.$src; 
  return $src;
}

  // Function for generating icon location
function icon($directory='')
{
  if(APP_ENV == 'dev')
    $location = APP_URL.'/resources/assets/'.$directory.'?'.mt_rand();
  else
    $location = APP_URL.'/resources/assets/'.$directory;

  return '<link rel="icon" href="'.$location.'" type="image/x-icon">';
}

  // Function for generating style location
function style($directory='')
{
  if(APP_ENV == 'dev')
    $location = APP_URL.'/resources/assets/'.$directory.'?'.mt_rand();
  else
    $location = APP_URL.'/resources/assets/'.$directory;

  return '<link href="'.$location.'" rel="stylesheet">';
}

  // Function for generating script location
function script($directory='')
{
  if(APP_ENV == 'dev')
    $location = APP_URL.'/resources/assets/'.$directory.'?'.mt_rand();
  else
    $location = APP_URL.'/resources/assets/'.$directory;

  return '<script type="text/javascript" src="'.$location.'"></script>';
}

  // Function for showing image
function image($src, $alt='', $misc = array()){
  $image = '<img src="';
  if(file_exists($src)){
    $image .= (APP_ENV == 'dev') ? APP_URL.'/'.$src."?".time()  : APP_URL.'/'.$src;
  }
  else{
    logger('ERROR: File '.$src.' missing!');
    $image .= "https://via.placeholder.com/150?text=".ucwords(str_replace(" ","+",$alt));
  } 
  $image .= '" alt="'.$alt.'"';
  if(!empty($misc)){
    foreach ($misc as $key => $value) {
      $image .= ' '.$key.'="'.$value.'"';
    }
  }
  $image .= '>';
  return $image;
}

  // Function for showing old field values
function old_val($key='')
{
  $token_data = getTokenData();
  if(!empty($token_data['posts']) && array_key_exists($key, $token_data['posts'])){
      return $token_data['posts'][$key];
  }
  return NULL;
}

    // Function for showing field values
function field_val($key='')
{
  $token_data = getTokenData();
  if(!empty($token_data['errors']) && array_key_exists($key, $token_data['posts'])){
      return $token_data['posts'][$key];
  }
  return NULL;
}

    // Function for showing field errors
function field_err($key='')
{
  $token_data = getTokenData();
  if(!empty($token_data['errors']) && array_key_exists($key, $token_data['errors'])){
    return $token_data['errors'][$key];
  }
  return NULL;
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
  else{
    throw new Exception('Resource '.$_file.' not found!');
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
  else{
    throw new Exception('Resource '.$_file.' not found!');
  }
}

  // Function for generating link
function route($route_url, $parameters= array())
{
  $routes = include("routes/web.php");

  if(array_key_exists($route_url, $routes)){

    $link = APP_URL.'/'.$route_url;

    if(!empty($parameters)){
      $link .= '?';
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
  else{
    throw new Exception('Route '.$route_url.' does not exist!');
  }

}

  // Function for manipulate url string
function urlStr($route_url, $parameters= array())
{
  $routes = include("routes/web.php");

  if(array_key_exists($route_url, $routes)){

    $link = APP_URL.'/'.$route_url;

    if(!empty($parameters)){
      $link .= '?';
      $count = 1;
      foreach($parameters as $key=>$value){
        if($count > 1){
          $link .= '&';
        }
        $link .= $key.'='.$value;
        $count++;
      }
      if(!empty($_GET)){
        foreach($_GET as $key=>$value){
          if(empty($parameters[$key])){
            $link .= '&'.$key.'='.$value;
          }
        }
      }
    }

    return $link;
  }
  else{
    throw new Exception('Route '.$route_url.' does not exist!');
  }

}

  // Function for getting route
function get_route()
{

  $route = str_replace(APP_URL.'/', "", $_SERVER['REQUEST_URI']);

  if(substr($route, -1) == '/' || count($_GET) > 0){

    $route = explode('/', $route);

    unset($route[count($route) - 1]);

    $route = implode('/', $route);

  }

  return $route;

}

  // Function for getting current url
function get_url()
{

  $url = APP_URL.$_SERVER['REQUEST_URI'];

  return $url;

}

  // Function for checking route
function route_is($param='')
{
  if(strpos($_SERVER['REQUEST_URI'], $param) !== false){
    return true;
  }
  else{
    return false; 
  }

}

?>