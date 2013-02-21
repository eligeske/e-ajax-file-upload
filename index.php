<?php

if(isset($_GET['upload'])){
	
	echo json_encode($_FILES);	
	exit();
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Form Inputs</title>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<link href="http://google-code-prettify.googlecode.com/svn/trunk/styles/sunburst.css" rel="stylesheet">
		<style>
			body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 150%; }
			/*pre { background: rgb(56, 56, 56); color: rgb(152, 214, 243); padding: 15px; border-radius: 6px; }*/
			k { color: #dad700; }
			o { color: #a96200; }
			st { color: #65B042; }
			v { color: #89bdff; }
			eq { color: #b49500; }
			prp { color: #a474ff; }
			cm { color: rgb(160, 160, 160) }
			nm { color: #ff4f54; }
			pre.prettyprint { color: #fff; margin: 1em 0; }
			.prm { list-style: none; }
			.prm label { font-weight: bold; display: inline-block; min-width: 75px; margin-right: 10px; text-align: right; }
			small { font-size: 14px; }
			.oui { color: green }
			.negs { color: red }
		</style>
		<script>		
			<?php $url = $_SERVER['PHP_SELF']."?upload=true"; ?>
			
			var uploadURL = "<?php echo $url; ?>";
			
			$(function(){
				
				// Check for File Object support in this browser
				try{  $('body input')[0].files[0]; }
				catch(e){ 
					$('h1 small').removeClass('oui').addClass('negs').text('This browser is not supported'); 
				}
				
				// enable button
				$($('body input')[0]).change(function(){
					if($(this)[0].files.length){
						$('#demoSend').removeAttr('disabled');	
					}else{
						$('#demoSend').attr('disabled','disabled');	
					}
				});
				
				$('#demoSend').click(function(){ 
					sendFile($('#demoFile')[0].files[0]); 
				});
				
			});
			
			var sendFile = function(file){
				var formData = new FormData();
				formData.append("file", file);
				var xhr = new XMLHttpRequest();
				xhr.open("POST",uploadURL);
	            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");	
				xhr.onreadystatechange = function(){
					if(xhr.readyState == 4){
						$('#output').html(xhr.responseText);
					}
				}
				xhr.send(formData);
			}
			
			
			
		</script>
	</head>

	<body>
		<div>
			<header>
				<h1>Ajax File Upload <small class="oui">This browser is supported</small></h1>
			</header>
			
			<div style="border: 5px solid #ccc; padding: 15px;">
				<div>
				<input id="demoFile" type="file" name="file" />	<i>id="demoFile"</i>	
			</div>
			<div>
				<input id="demoSend" type="button" value="Upload" disabled="disabled" />  <i>id="demoSend"</i>	
			</div>
			<fieldset style="margin:10px 0">
				<legend>Server Response</legend>
				<div id="output" style="padding: 10px;">
					
				</div>	
			</fieldset>
				<h3>Get File Object from Input</h3>
				<pre class="prettyprint"><cm>/**
* Get File Object and send
**/
$(<st>'#demoSend'</st>).click(<k>function</k>(){ 
	sendFile($(<st>'#demoFile'</st>)[<nm>0</nm>].files[<nm>0</nm>]); 
});</cm>
</pre>
				<h3>Ajax Send Method</h3>
				<pre class="prettyprint"><cm>/**
* Post a file object to server view Ajax
* Params: file (DOM File object)
**/</cm>
<k>var</k> <o>sendFile</o> <eq>=</eq> <k>function</k>(<v>file</v>){
	<k>var</k> formData <eq>=</eq> new FormData(); 
	formData.append(<st>"file"</st>, file);
	<k>var</k> xhr <eq>=</eq> new <prp>XMLHttpRequest</prp>();
	xhr.open(<st>"POST"</st>,uploadURL);  <cm>// uploadUrl is url to server</cm>
	xhr.setRequestHeader(<st>"X-Requested-With"</st>, <st>"XMLHttpRequest"</st>);
	xhr.<o>onreadystatechange</o> <eq>=</eq> function(){
		if(xhr.readyState <eq>==</eq> <nm>4</nm>){
			$(<st>'#output'</st>).html(xhr.responseText); <cm>// Shows in Server Response box for demo</cm>
		}
	}
	xhr.send(<v>formData</v>);				
}</pre>
				
				
			</div>
			<h3>Params <small> - sendFile(file);</small></h3>
			<ul class="prm">
				<li><label>file:</label> This is the DOM File object from FileList, find in input.files.</li>
			</ul>						
			<h3>Requirements</h3>
			<ul>
				<li>DOM File Object Support</li>
				<li>Server to receive Post data</li>
			</ul>
			<h3>Demo Environment</h3>
			<ul>
				<li>PHP</li>
				<li>jQuery</li>
			</ul>		
			<h3>Quick Explanation</h3>
			<p>How to send a file via ajax.</p>
			<footer style="color: #ccc; margin-top: 55px; border-top: 1px solid #ccc;">
				<p>eligeske</p>
			</footer>
		</div>
	</body>
</html>

