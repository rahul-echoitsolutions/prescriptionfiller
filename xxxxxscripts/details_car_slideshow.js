// DETAILS SLIDE SHOW
function changeCarDetailsPic(index) {
	$("#thumb"+currentThumbIndex).css('border-color', '#ffffff');
	currentThumbIndex = index;
	$("#thumb"+currentThumbIndex).css('border-color', '#ff0000');
	$("#detail_car_container_pic").css('display', 'none');
	eval("document.detail_car_container_img").src = "https://yesplanfinancial.ca/inventory/images/"+thumbarray[currentThumbIndex-1];
	$("#detail_car_container_pic").fadeIn(1000);
}

var thumbarray = [];
var currentThumbIndex = 1;
var thumslideshowon = 1;
var myThumbIntervalVar;

function thumbover(index) {
	if (index != currentThumbIndex) $("#thumb"+index).css('border-color', '#e4821a');
	
}

function thumbout(index) {
	if (index != currentThumbIndex) $("#thumb"+index).css('border-color', '#20263c');
	else $("#thumb"+index).css('border-color', '#ff0000');
	//else $(target).css('border', '1pt solid #ff0000');
}

function thumbreset(index) {
	 $("#thumb"+index).css('border-color', '#20263c');
}

var totalthumbs = 0;
function startThumbSlides(slides) {
	totalthumbs = slides;
	thumbout(currentThumbIndex)
	resumeThumbSlideShow();
}

function resumeThumbSlideShow() {
	
	if (thumslideshowon == 1) myThumbIntervalVar = setInterval( function() { changeThumbSlidePic() }, 4000 );
	
	
}

function changeThumbSlidePic() {	
		clearInterval(myThumbIntervalVar);
		if (thumslideshowon == 1) {
			thumbreset(currentThumbIndex);
			currentThumbIndex++;
			if (currentThumbIndex > totalthumbs) currentThumbIndex = 1;
			$("#detail_car_container_pic").fadeOut(1000,loadnewThumbpic);
		}
}	

function loadnewThumbpic() {	
		document.detail_car_container_img.src = "https://yesplanfinancial.ca/inventory/images/"+thumbarray[currentThumbIndex-1];
		if (thumslideshowon == 0) $("#detail_car_container_pic").fadeIn(500);	
		else $("#detail_car_container_pic").fadeIn(1000,resumeThumbSlideShow);	
		thumbout(currentThumbIndex);
}

function stopThumbSlideShow() {
	clearInterval(myThumbIntervalVar);
	thumslideshowon = 0;
}

function restartThumbSlideShow() {
	if (thumslideshowon == 0) {
		thumslideshowon = 1;
		resumeThumbSlideShow();
	}
}

function getNextZoomPic() {
	currentZoomIndex++;
	if (currentZoomIndex > totalthumbs-1) currentZoomIndex = 0;
	$("#zoompic").css("display","none");
	document.zoom_pic.src = "";
	document.zoom_pic.src = "https://yesplanfinancial.ca/inventory/images/zoom_"+thumbarray[currentZoomIndex];
	$("#zoompic").fadeIn(500);	
	
}

function getPrevZoomPic() {
	currentZoomIndex--;
	if (currentZoomIndex < 0) currentZoomIndex = totalthumbs-1;
	$("#zoompic").css("display","none");
	
	document.zoom_pic.src = "";
	document.zoom_pic.src = "https://yesplanfinancial.ca/inventory/images/zoom_"+thumbarray[currentZoomIndex];
	$("#zoompic").fadeIn(500);	
	
}

var currentZoomIndex = 0;
function openZoomPic(id, title) {
	w = 790; h = 650;
	currentZoomIndex = currentThumbIndex-1;
	//alert("ok");
	var loadform = "https://yesplanfinancial.ca/scripts/_zoompic.php?filen=https://yesplanfinancial.ca/inventory/images/zoom_"+thumbarray[currentZoomIndex]+"&id="+id+"&h="+h+"&w="+w;
	$('#overlay_title').html(title);
	$('#overlay_content').html("Loading...");
	
	$('#overlay').css("display", "block");
	$('#overlay').animate({
		width: w+'px',
		height: h+'px',
		marginLeft:'-'+(w/2)+'px',
		marginTop:'-'+(h/2)+'px',
		opacity:'1'},
		"slow", function() { 
			$('#overlay_content').load(loadform);
		}
	);
}