<!doctype>
<html>
<head>
	<title>Generate PDF</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<script type="text/javascript" src="js/libs/swfobject.js"></script>
	<script type="text/javascript" src="js/libs/downloadify.min.js"></script>
	<script type="text/javascript" src="js/jspdf/jspdf.js"></script>
    <script src='ex/examples/js/jquery/jquery-1.7.1.min.js' type='text/javascript'></script>
	<script src='ex/libs/Blob.js/Blob.js' type='text/javascript'></script>
	<script src='ex/libs/FileSaver.js/FileSaver.js' type='text/javascript'></script>
    
    <script src='ex/libs/png_support/zlib.js' type='text/javascript'></script>
	<script src='ex/libs/png_support/png.js' type='text/javascript'></script>
	
	<script src='ex/libs/Deflate/deflate.js' type='text/javascript'></script>
    <script src='ex/jspdf.plugin.addimage.js' type='text/javascript'></script>
    <script src='ex/jspdf.plugin.png_support.js' type='text/javascript'></script>
	<script type="text/javascript">

	function downloadPdf(){
		Downloadify.create('downloadify',{
    filename: 'Example.pdf',
    dataType: 'base64',
    data: function(){ 
	 (function(API){
    API.myText = function(txt, options, x, y) {
        options = options ||{};
        /* Use the options align property to specify desired text alignment
         * Param x will be ignored if desired text alignment is 'center'.
         * Usage of options can easily extend the function to apply different text 
         * styles and sizes 
        */
        if( options.align == "center" ){
            // Get current font size
            var fontSize = this.internal.getFontSize();

            // Get page width
            var pageWidth = this.internal.pageSize.width;

            // Get the actual text's width
            /* You multiply the unit width of your string by your font size and divide
             * by the internal scale factor. The division is necessary
             * for the case where you use units other than 'pt' in the constructor
             * of jsPDF.
            */
            txtWidth = this.getStringUnitWidth(txt)*fontSize/this.internal.scaleFactor;

            // Calculate text's x coordinate
            x = ( pageWidth - txtWidth ) / 2;
        }

        // Draw text at x,y
        this.text(txt,x,y);
    }
})(jsPDF.API);
			var imgData = 'data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAA8AAD/4QNUaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjMtYzAwNyAxLjE0NDEwOSwgMjAxMS8wOS8yMC0xODowOToxMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoMTMuMDIwMTExMDEyLm0uMjU4IDIwMTEvMTAvMTI6MjE6MDA6MDApICAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OUY4QzE3OEJDNDFGMTFFNUFFNTVCQjZDNEU3MjAzODEiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OUY4QzE3OENDNDFGMTFFNUFFNTVCQjZDNEU3MjAzODEiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo5RjhDMTc4OUM0MUYxMUU1QUU1NUJCNkM0RTcyMDM4MSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo5RjhDMTc4QUM0MUYxMUU1QUU1NUJCNkM0RTcyMDM4MSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/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';
var doc = new jsPDF();

			doc.setFontSize(22);
			doc.setFontType('bold');
			doc.text(55, 105, "Piccadilly Biscuits Limited");
			doc.addImage(imgData, 'JPEG', 80, 110);
			doc.setFontType('bold');
			doc.setFontSize(26);
			doc.text(75, 155, "HR Report");
			doc.setFontType('italic');
			doc.setFontSize(16);
			doc.text(75, 165, "<?php echo date('F, Y');?>");
			doc.addPage();
			doc.setFontSize(22);
			doc.text(75, 55, "Content");
		var output = doc.output();
        return btoa(output);
			},
			onComplete: function(){ alert('Your File Has Been Saved!'); },
			onCancel: function(){ alert('You have cancelled the saving of this file.'); },
			onError: function(){ alert('You must put something in the File Contents or there will be nothing to save!'); },
			downloadImage: 'images/download.png',
			swf: 'images/downloadify.swf',
			width: 100,
			height: 30,
			transparent: true,
			append: false
		});
	}
</script>	
<body>
To generate PDF Click Here.
<input type="button" value="Generate" onclick="downloadPdf()" />
<br/>
<div id="downloadify"></div>


	
	
	
	