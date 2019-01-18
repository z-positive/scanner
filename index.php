<html>
<head>
	<title>Scan2Net Добро пожаловать в технологии S2N</title>
	<link rel="shortcut icon" href="http://192.168.1.27/s2n.gif">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="0">

	<style type="text/css">
		#message{
			margin-top: 200px;
			font-size:25px;
			text-align:center;
		} 
	</style>
 
 
 </head>
<?php require "updater.php"; ?>
<body>
	<div id="message"></div>
</body>

</html>


<script type="text/javascript">
	function getAllUrlParams(url) {

	  
	  var queryString = url ? url.split('?')[1] : window.location.search.slice(1);
	  var obj = {};

	  if (queryString) {

		queryString = queryString.split('#')[0];

		var arr = queryString.split('&');

		for (var i=0; i<arr.length; i++) {

		  var a = arr[i].split('=');


		  var paramNum = undefined;
		  var paramName = a[0].replace(/\[\d*\]/, function(v) {
			paramNum = v.slice(1,-1);
			return '';
		  });

		  var paramValue = typeof(a[1])==='undefined' ? true : a[1];

		  paramName = paramName.toLowerCase();
		  paramValue = paramValue.toLowerCase();

		  if (obj[paramName]) {

			if (typeof obj[paramName] === 'string') {
			  obj[paramName] = [obj[paramName]];
			}

			if (typeof paramNum === 'undefined') {

			  obj[paramName].push(paramValue);
			}

			else {

			  obj[paramName][paramNum] = paramValue;
			}
		  }

		  else {
			obj[paramName] = paramValue;
		  }
		}
	  }

	  return obj;
	}
	

var get_url = getAllUrlParams(window.location.search);
var folder = "/2019/АВТО/"+decodeURI(get_url['lastname'])+"-"+get_url['order'];

var request = new XMLHttpRequest();

request.open('POST','http://192.168.1.27/cgi/chopt.cgi?ftp+ftp_uploadpath+'+folder+'+1',true);

request.addEventListener('readystatechange', function() {

  if ((request.readyState==4) && (request.status==200)) {

    console.log(request);

    console.log(request.responseText);
	
  }
}); 

request.send();


document.getElementById('message').innerHTML = "Применяются настройки...";

function func() {
	window.location.href = "http://192.168.1.27/cgi/main_fs.cgi";
}

setTimeout(func, 2000);

</script>
