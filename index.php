<?php

$active = 'Home';
include("includes/header.php");

?>
<link rel="stylesheet" href="admin_area/css/slider.css">
<script src="admin_area/js/slider.js"></script>
<div class="container" id="slider"><!-- container Begin -->

    <!-- slider -->
    <!-- <section class="slideshow">
            <div class="content">
                <div class="slider-content">  
                    <figure class="shadow"><img src="laptop_immg/laptop/s1.png"></figure>
                    <figure class="shadow"><img src="laptop_immg/laptop/s2.png"></figure>
                    <figure class="shadow"><img src="laptop_immg/laptop/s11.png"></figure>
                    <figure class="shadow"><img src="laptop_immg/laptop/s3.png"></figure>
                    <figure class="shadow"><img src="laptop_immg/laptop/Category_Page_Inspiron_7400.png"></figure>
                    <figure class="shadow"><img src="laptop_immg/laptop/s4.png"></figure>
                    <figure class="shadow"><img src="laptop_immg/laptop/s6.png"></figure>
                    <figure class="shadow"><img src="laptop_immg/laptop/s7.png"></figure>
                    <figure class="shadow"><img src="laptop_immg/laptop/s8.jpg"></figure>
                    <figure class="shadow"><img src="laptop_immg/laptop/s9.jpg"></figure>
                </div>
            </div>
        </section> -->
    <div class="slideshowContainer">

        <img class="imageSlides" src="laptop_immg/laptop/slide1.png" alt="beach side city view">
        <img class="imageSlides" src="laptop_immg/laptop/slide2.1.jpg" alt="leaf on the ground">
        <img class="imageSlides" src="laptop_immg/laptop/slider3.png" alt="lake surrounded by mountains">

        <span id="leftArrow" class="slideshowArrow">&#8249;</span>
        <span id="rightArrow" class="slideshowArrow">&#8250;</span>

        <div class="slideshowCircles">
            <span class="circle dot"></span>
            <span class="circle"></span>
            <span class="circle"></span>
        </div>
    </div>

</div><!-- container Finish -->

<div id="advantages"><!-- #advantages Begin -->

    <div class="container"><!-- container Begin -->

        <div class="same-height-row"><!-- same-height-row Begin -->

            <?php

            $get_boxes = "select * from boxes_section";
            $run_boxes = mysqli_query($con, $get_boxes);

            while ($run_boxes_section = mysqli_fetch_array($run_boxes)) {

                $box_id = $run_boxes_section['box_id'];
                $box_title = $run_boxes_section['box_title'];
                $box_desc = $run_boxes_section['box_desc'];

            ?>

                <div class="col-sm-4"><!-- col-sm-4 Begin -->

                    <div class="box same-height"><!-- box same-height Begin -->

                        <div class="icon"><!-- icon Begin -->

                            <i class="fa fa-heart"></i>

                        </div><!-- icon Finish -->

                        <h3><a href="#"><?php echo $box_title; ?></a></h3>

                        <p> <?php echo $box_desc; ?> </p>

                    </div><!-- box same-height Finish -->

                </div><!-- col-sm-4 Finish -->

            <?php    } ?>

        </div><!-- same-height-row Finish -->

    </div><!-- container Finish -->

</div><!-- #advantages Finish -->

<div id="hot"><!-- #hot Begin -->

    <div class="box"><!-- box Begin -->

        <div class="container"><!-- container Begin -->

            <div class="col-md-12"><!-- col-md-12 Begin -->

                <h2>
                    Sản phẩm mới nhất của chúng tôi
                </h2>

            </div><!-- col-md-12 Finish -->

        </div><!-- container Finish -->

    </div><!-- box Finish -->

</div><!-- #hot Finish -->

<div id="content" class="container"><!-- container Begin -->

    <div class="row"><!-- row Begin -->

        <?php

        getPro();

        ?>

    </div><!-- row Finish -->

</div><!-- container Finish -->

<div id="hot"><!-- #hot Begin -->

    <div class="box"><!-- box Begin -->

        <div class="container"><!-- container Begin -->

            <div class="col-md-12"><!-- col-md-12 Begin -->

                <h2>
                    Sản phẩm bán chạy nhất của chúng tôi
                </h2>

            </div><!-- col-md-12 Finish -->

        </div><!-- container Finish -->

    </div><!-- box Finish -->

</div><!-- #hot Finish -->

<div id="content" class="container"><!-- container Begin -->

    <div class="row"><!-- row Begin -->

        <?php

        getHotPro();

        ?>

    </div><!-- row Finish -->

</div><!-- container Finish -->

<?php

include("includes/footer.php");

?>

<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>


</body>
<script>
    // IMAGE SLIDES & CIRCLES ARRAYS, & COUNTER
var imageSlides = document.getElementsByClassName('imageSlides');
var circles = document.getElementsByClassName('circle');
var leftArrow = document.getElementById('leftArrow');
var rightArrow = document.getElementById('rightArrow');
var counter = 0;

// HIDE ALL IMAGES FUNCTION
function hideImages() {
  for (var i = 0; i < imageSlides.length; i++) {
    imageSlides[i].classList.remove('visible');
  }
}

// REMOVE ALL DOTS FUNCTION
function removeDots() {
  for (var i = 0; i < imageSlides.length; i++) {
    circles[i].classList.remove('dot');
  }
}

// SINGLE IMAGE LOOP/CIRCLES FUNCTION
function imageLoop() {
  var currentImage = imageSlides[counter];
  var currentDot = circles[counter];
  currentImage.classList.add('visible');
  removeDots();
  currentDot.classList.add('dot');
  counter++;
}

// LEFT & RIGHT ARROW FUNCTION & CLICK EVENT LISTENERS
function arrowClick(e) {
  var target = e.target;
  if (target == leftArrow) {
    clearInterval(imageSlideshowInterval);
    hideImages();
    removeDots();
    if (counter == 1) {
      counter = (imageSlides.length - 1);
      imageLoop();
      imageSlideshowInterval = setInterval(slideshow, 10000);
    } else {
      counter--;
      counter--;
      imageLoop();
      imageSlideshowInterval = setInterval(slideshow, 10000);
    }
  } 
  else if (target == rightArrow) {
    clearInterval(imageSlideshowInterval);
    hideImages();
    removeDots();
    if (counter == imageSlides.length) {
      counter = 0;
      imageLoop();
      imageSlideshowInterval = setInterval(slideshow, 10000);
    } else {
      imageLoop();
      imageSlideshowInterval = setInterval(slideshow, 10000);
    }
  }
}

leftArrow.addEventListener('click', arrowClick);
rightArrow.addEventListener('click', arrowClick);


// IMAGE SLIDE FUNCTION
function slideshow() {
  if (counter < imageSlides.length) {
    imageLoop();
  } else {
    counter = 0;
    hideImages();
    imageLoop();
  }
}

// SHOW FIRST IMAGE, & THEN SET & CALL SLIDE INTERVAL
setTimeout(slideshow, 1000);
var imageSlideshowInterval = setInterval(slideshow, 10000);
</script>
</html>