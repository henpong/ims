
<style type="text/css">
.clockStyle {
	color: #00073a;
	font-family: arial black, Gadget, sans-serif;
	font-size: 15px;
	font-weight: bold;
	letter-spacing: 3px;
	display: inline;
	/*padding-bottom: 0px;*/
	/* margin-top: 100px; */
}
</style>

	<div id="clockDisplay" class="clockStyle"></div>
		
	<script type="text/javascript" language="javascript">
		function myTime() {

			var currentTime = new Date();
			var h = currentTime.getHours();
			var m = currentTime.getMinutes();
			var s = currentTime.getSeconds();

			if (h == 0) {
				h = 24;
			} else if (h > 24) {
				h = h - 12;
				
			}

			if (h < 10) {
				h = "0" + h;
			}
			if (m < 10) {
				m = "0" + m;
			}
			if (s < 10) {
				s = "0" + s;
			}

			var myClock = document.getElementById('clockDisplay');
			myClock.textContent = h + ":" + m + ":" + s;
			myClock.innerHtml = h + ":" + m + ":" + s;
			setTimeout('myTime()', 1000);
		}
		myTime();
	</script>

