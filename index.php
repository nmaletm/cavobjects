<?php

include "class/includes.php";
include "data.php";

$isRender = $_GET['render'];

$firstObjectsPath = $gallery->getObject(1)->getRenderPath($isRender);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Cavobjects Storn.es</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />
    <meta name="description" content="Pagina  de  Storn.es"/>
    <link href="http://www.storn.es/favicon.ico" rel="icon" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" media="all" href="css/style.css" />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Indie+Flower' rel='stylesheet' type='text/css'>
   </head>
    <body class="page-main">
       <h1 class="pageTitle"><i class="fa fa-rocket"></i> Cavobjects</h1>

       <div class="text-row" id="info-open">
        "Cavobject"? What the hell is this? And what is the story about it 
        <i class="fa fa-question" style="font-size: xx-large"></i>
       </div>

       <div class="text-row notepad" id="info-box" style="display:none;">
        <p>
          During a 2014 Christmas dinner at my grandparents' home, I was playing with a cava 
        cork stopper while talking with my family. 
          My first "Cavobject" was a <a href="<?=$firstObjectsPath?>">spider</a>
          that I did without thinking what I was doing. 
        </p>
        <p>
          The idea of a Cavobject is to build an object from scratch, using only materials 
          that you can find in a dinning table. The unique extra material that I've used is wire
          (that originally was wire from the cava stopper keeper). But as I need much more that 
          I could get with the cava bottles, I bought a roll wire at a hardware store.
        </p>
        <p>
          For each object you can see some photos, the used materials, the used tools and the creation date.
        </p>
        <p>
          I hope you enjoy it, if you want to talk to me, feel free to tweet me 
          <a href="https://twitter.com/NestorMalet" target="_blank">@NestorMalet</a>
          or contact me at <a href="http://nestor.cat">my website</a>.
        </p>
        <p class="rocket-spin">
          <i class="fa fa-rocket"></i>
        </p>
       </div>

<div class="large-12 columns" style="overflow: visible">
  <div class="polaroids large-block-grid-4 small-block-grid-2">
<?php
$objects = $gallery->getObjectOrderDesc();
foreach ($objects as $object) {
  echo "\t\t<div>\n";
  echo "\t\t<a href='".$object->getRenderPath($isRender)."' title='".$object->getName()."'>\n";
  echo "\t\t\t<img alt='".$object->getName()."' src='".$object->getMainPhoto()->getRenderPath(Photo::SIZE_THUMBNAIL, $isRender)."' />\n";
  echo "\t\t</a>\n";
  echo "\t\t</div>\n";
}
?>
  </div> 
</div>

<script>
$(function() {
  $('#info-open').click(function(){
    $('#info-open').fadeOut(function(){
      $('#info-box').fadeIn(100, function(){
        $('#info-box').slideDown();
      });
      
    });
    
  });
});


</script>
    </body>
</html>