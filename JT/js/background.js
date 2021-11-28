var i = 0;
var images = []; //array
var time = 4000; // time in millie seconds

//images

images[0] = "url(images/bgimage_4.jpg)";
images[1] = "url(images/bgimage_3.jpg)";
images[2] = "url(images/bgimage_2.jpg)";
images[3] = "url(images/bgimage_1.jpg)";
//function

function changeImage() {
    var el = document.getElementById('background');
    el.style.backgroundImage = images[i];
    if (i < images.length - 1) {
        i++;
    } else {
        i = 0;
    }
    setTimeout('changeImage()', time);
}

window.onload = changeImage;