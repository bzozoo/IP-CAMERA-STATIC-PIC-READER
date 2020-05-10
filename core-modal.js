function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}

var startCB = null;

function startCallback() {
	clearInterval(startCB);
	startCB = setInterval(myCallback, 500, -1);
}

function stopCallback() {
	console.log('TRY TO STOP');
	clearInterval(startCB);
	console.log('STOPPED');
}

function myCallback(a)
{
plusSlides(a);
}

document.onkeydown = function(e){
    e = e || window.event;
    var key = e.which || e.keyCode;
    if(key===84){
          alert('TEST');
    }
	        if(key===37){
          plusSlides(-1);
    }
		    if(key===39){
          plusSlides(1);
    }
		    if(key===38){
          plusSlides(-1);
    }
		    if(key===40){
          plusSlides(1);
    }
}