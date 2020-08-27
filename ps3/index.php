<a id="anchor" download="TIS2000.rar">Download</a>

<br>
<progress id="progress" value="0"></progress>
<span id="progress-text"></span>

<br>
<span id="remaining"></span>

<script>
	var ajax = new XMLHttpRequest();
	ajax.responseType = "blob";
	ajax.open("GET", "TIS2000.rar", true);
	ajax.send();
	
	var progress = document.getElementById("progress");
	var progressText = document.getElementById("progress-text");
	var remaining = document.getElementById("remaining");
	
	var start = new Date().getTime();
	
	ajax.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var obj = window.URL.createObjectURL(this.response);
			document.getElementById("anchor").setAttribute("href", obj);
			
			setTimeout(function () {
				window.URL.revokeObjectURL(obj);
			}, 60 * 1000);
		}
		
	};
	
	ajax.onprogress = function (e) {
		progress.max = e.total;
        progress.value = e.loaded;
		
		var percent = (e.loaded / e.total) * 100;
		percent = Math.floor(percent);
		progressText.innerHTML = percent + "%";
		
		var end = new Date().getTime();
		var duration = (end - start) / 1000;
		var bps = e.loaded / duration;
		var kbps = bps / 1024;
		kbps = Math.floor(kbps);
		
		var time = (e.total - e.loaded) / bps;
		var seconds = time % 60;
		var minutes = time / 60;
		
		seconds = Math.floor(seconds);
		minutes = Math.floor(minutes);
		
		remaining.innerHTML = kbps + " KB/s " + minutes + " mintues " + seconds +
		" seconds remaining";
	};
	
</script>