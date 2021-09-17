<html>
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script type="text/javascript">
			var username = prompt("Enter a username","");
			window.addEventListener("DOMContentLoaded",function(){
				//Grab elements
				var canvas,video,context,videoObj,url,upload;
				canvas  = document.getElementById("c");
				video   = document.getElementById("v");
				context = canvas.getContext("2d");
				snap    = document.getElementById("snap");
				url     = window.URL || window.webkitURL;
				upload  = document.getElementById("upload");
				upload.style.display = "none";
				videoObj = {video:true};
				navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia ||
										 navigator.mozGetUserMedia || navigator.msGetUserMedia;
				if(navigator.getUserMedia){
					alert("WEBCAM SUPPORTED");
					navigator.getUserMedia(
						videoObj,
						function(stream){
							/**/
							mediaStreamTrack=typeof stream.stop==='function'?stream:stream.getTracks()[1];
							try{
								video.src = url.createObjectURL(stream);
							}catch(e){
								console.log(e);
								video.srcObject=stream;
							}
							
							video.play();
						},
						function(error){
							alert("Something went wrong");
						}
					);
				}else{
					alert("Bienvenido a la Web Cam Octavio");
				}
				document.getElementById("snap").addEventListener("click",function(){
					draw(video,context,video.width,video.height);
				});
				function draw(video,context,width,height){
					context.drawImage(video,0,0,width,height);
					upload.style.display = "block";
				}
				upload.addEventListener("click",function(){
					var dataUrl = canvas.toDataURL("image/jpeg",1.0);
					$.ajax({
						type:"POST",
						url: "webcam-upload.php",
						data:{
							imgBase64:dataUrl,
							user:username
						},
					}).done(function(response){
						alert("Saved to "+response);
					}).fail(function(e) {
   console.info("error",e)
  })
  .always(function() {
    alert( "complete" );
  });
 ;
				});
			},false);
		</script>
	</head>
	<body>
		<video id="v" width="100%" height="100%" autoplay></video>
		<button id="snap" type="button">Snap</button>
		<canvas id="c" width="100" height="100"></canvas>
		<button type="button" id="upload">Upload</button>
	</body>
</html>