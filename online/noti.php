<!DOCTYPE html>
<html>
<head>
	<title>noti</title>
	<script type="text/javascript">
		function displayPushNotification() {
			if ("Notification" in window) {
			let ask = Notification.requestPermission();
			ask.then (permission => 
			{
				if (permission === "granted") {
					let msg = new Notification("Title", {
						body: "Hello, World",
						icon: "../images/foodstufflogo.jpg"
					});
					msg.addEventListener("click", event =>
					{
						 window.location.href = "http://www.stackoverflow.com";
					});
				}
			});
		}
		}
	</script>
</head>
<body onload="displayPushNotification()">


</body>
</html>