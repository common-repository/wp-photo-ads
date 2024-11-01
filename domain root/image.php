<?php
global $HTTP_GET_VARS;
$url = $HTTP_GET_VARS["url"];
$description = $HTTP_GET_VARS["description"];
$title = $HTTP_GET_VARS["title"];


// CHANGE THIS INTO YOUR BLOG URL
$domain = 'http://wpphotoads.yxymedia.com/';

// CHANGE THIS INTO YOUR BLOG NAME
$sitename = 'WP Photo Ads';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?> - <?php echo $sitename; ?> Photo Page</title>

<style type="text/css">


body {
    background-color: #f1f1f1;
    font-family:Verdana, Arial, Helvetica, sans-serif;
}

div#container {
    width: 1120px;
    background-color:#f1f1f1;
    margin-top: 50px;
    margin-bottom: 50px;
    margin-left: auto;
    margin-right: auto;
    padding: 0px;
}


h1 {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size: 25px;
line-height: 15pt;
margin-left: 20px;
color: #000000;
}


h2  {
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size: 18px;
margin-top: -15px;
margin-left: 25px;
color: #CDCDCD;
}



div#header {
    margin: 0px;
    background-color: #FFFFFF;
}

div#mainleft {
    width: 160px;
    display:inline-block;
    float:left;
    background-color: #f1f1f1;
    font-size: 11px;
    margin-top: 60px;
}

div#mainright {
    width: 160px;
    display:inline-block;
    float:left;
    background-color: #f1f1f1;
    font-size: 11px;
    margin-top: 60px;
}

div#mainmid {
    width: 800px;
        float:left;        
    background-color: #FFFFFF;
    font-size: 11px;
}

#footer {
    font-size: 10px;
}
</style>


<script type="text/javascript">
function changewidth(img_element)
        {
        var t = new Image();
        t.src = (img_element.getAttribute ? img_element.getAttribute("src") : false) || img_element.src;
        var x=document.images;
    x[0].width=t.width;
        }
</script>


</head>

<body>

<div id="container">



    
    
    <div id="mainleft">
<!-- INSERT GOOGLE ADSENSE CODE HERE, 160x600 WILL DO --><br /></div>
    
    
    <div id="mainmid">
    
      <div id="header">
         <h1><strong><?php echo $title; ?></strong></h1>
         <h2><em><?php echo $description; ?></em></h2>
    </div>

<p align="center"><!-- 728x90 GOOGLE ADSENSE CODE HERE --></p>

<p align="center"><img id="resized" width="798px" onclick="javascript:changewidth(document.getElementById('resized'));" border="1" src="<?php echo $domain; ?>wp-content/<?php echo $url; ?>" alt="<?php echo $title; ?>" title="<?php echo $title; ?>" style="border-width: 1; padding: 0">
<br /><em>This image may be scaled down to fit this page, click the image to see it in its original size.</em></p>


<p id="footer">

<!-- WE WOULD VERY MUCH APPRECIATE IT IF YOU COULD LEAVE A LINK TO THE WP PHOTO ADS SITE ON THIS PAGE, BUT YOU ARE FREE TO REMOVE IT SHOULD YOU WISH TO DO SO. -->
<br /><br />
    &copy; <?php echo date("Y"); ?> All Rights Reserved, <a rel="nofollow" href="<?php echo $domain; ?>"><?php echo $sitename; ?></a>. Powered by <a href="http://wpphotoads.yxymedia.com/">WP Photo Ads</a> by <a href="http://www.yxymedia.com/">yxymedia online marketing</a>.</p>
    <p id="footer"><em>We use these photos as illustrations on our blog, <?php echo $sitename; ?>. We don't want to offend anyone's copyright. We use these images on our website in a completely informative way.
    If you feel like we are violating your copyright by using this image titled "<?php echo $title; ?>", please let us know right away, and we will gladly remove it from our website.</em>
     </p>



    </div>
    <div id="mainright"><br /></div>
        
        
        

    
    
</div>


</body>
</html>
