<?php
error_reporting(0);
?>
<div id="zoompiccontainer" style="width:<?php echo $_GET['w']-40;?>px; height:<?php echo $_GET['h']-88;?>px;">
	<div id="zoompic" style="position:absolute; border:1pt solid #000000;">
		<img id="zoom_pic" name="zoom_pic" src="<?php echo $_GET['filen']; ?>" />
    </div>
    
    <div style="position:absolute;width:40px; display:table-cell; vertical-align:middle;">
	    <div class="icon_left_arrow" style="border:1pt solid #000000;" onclick="getPrevZoomPic();"></div>
    </div>
    
    <div style="position:absolute; width:40px;right:20px;  display:table-cell; vertical-align:middle;">
	    <div class="icon_right_arrow" style="border:1pt solid #000000;" onclick="getNextZoomPic();"></div>
    </div>
</div>