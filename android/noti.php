<!DOCTYPE html>
<html>
<head>
	<title>noti</title>
	<script type="text/javascript">
		if ("Notification" in window) {
			let ask = Notification.requestPermission();
			ask.then (permission => 
			{
				if (permission === "granted") {
					let msg = new Notification("Title", {
						body: "Hello, World",
						icon: "../images/avatar.jpg"
					});
					msg.addEventListener("click", event =>
					{
						alert("Click recieved");
					});
				}
			});
		}
	</script>
</head>
<body>


</body>
</html>