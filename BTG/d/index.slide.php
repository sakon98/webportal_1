
<style>
.mySlides {display: none;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  bottom: 0px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  display:none;	
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 8px;
  width: 8px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 12px}
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 1% auto; /* 15% from the top and centered */
  padding: 5px;
  border: 1px solid #888;
  width: 850px; /* Could be more or less, depending on screen size */
  height: 600px; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

</style>




<?php 
$max_slide=4;
$download="";
$download_title="Download";
?>

<script>
var modal = new Array(<?=$max_slide?>);
var btn = new Array(<?=$max_slide?>);
var btn_ = new Array(<?=$max_slide?>);
var span = new Array(<?=$max_slide?>);
function openImg(id,img,i){
// Get the modal
modal[i] = document.getElementById(id);

// Get the button that opens the modal
btn[i] = document.getElementById(img+"");
btn_[i] = document.getElementById(img+"_");

// Get the <span> element that closes the modal
span[i] = document.getElementById("close"+i);

// When the user clicks the button, open the modal 
btn[i].onclick = function() {
  btn_[i].src=btn[i].src;	
  modal[i].style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span[i].onclick = function() {
  modal[i].style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal[i]) {
    modal[i].style.display = "none";
  }
}
}
</script>
<br/>
<br/>
<div class="slideshow-container">
<?php for($i=1;$i<=$max_slide;$i++){?>
<div class="mySlides fade">
  <div class="numbertext"><?=$i?> / <?=$max_slide?></div>
   
  &nbsp;&nbsp;&nbsp;&nbsp;<img src="img_slide_<?=$i?>.png" style="width:460px;height:300px;vertical-align: middle;" id="myBtn<?=$i?>">&nbsp;&nbsp;
  <!--<div class="text"><a href="slide<?=$download?><?=$i?>.pdf" target="_blank"><?=$download_title?></a></div>-->

<!-- The Modal -->
<div id="myModal<?=$i?>" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" id="close<?=$i?>">&times;</span>
    <p><img src="" style="width:800px;height:580px;vertical-align: middle;" id="myBtn<?=$i?>_"></p>
  </div>

</div>

 <script>
 openImg('myModal<?=$i?>' ,'myBtn<?=$i?>',<?=$i?>);
 </script>

</div>
<?php } ?>

</div>
<br>

<div style="text-align:center">

<?php for($i=1;$i<=$max_slide;$i++){?>
  <span class="dot"></span> 
<?php } ?> Click ที่รูปเพื่อขยาย

</div>


<script>
var slideIndex = 0;
var delay=9000;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, delay); // Change image every 9 seconds
}
</script>
