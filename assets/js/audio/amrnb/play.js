var  gAudioContext = new AudioContext();
function getAudioContext() {
    if (!gAudioContext) {
        gAudioContext = new AudioContext();
    }
    return gAudioContext;
}

function fetchBlob(url, callback) {
	//url = url.replace('https://','//');
	 
	console.log(url);
	var xhr = new XMLHttpRequest();
    xhr.open('GET', url ,true);
   // xhr.responseType = 'arraybuffer';
    xhr.responseType = 'blob';
    xhr.onload = function() {
		//console.log(this.response);
		//var blob = new Blob([this.response],{type:"text/plain"});  
		//console.log(blob);
         callback(this.response);
    };
    xhr.onerror = function() {
        console.log('Failed to fetch ' + url);
		console.log(xhr.responseText);
    };
    xhr.send();
	
}

function readBlob(blob, callback) {
    var reader = new FileReader();
    reader.onload = function(e) {
        var data = new Uint8Array(e.target.result);
        callback(data);
    };
    reader.readAsArrayBuffer(blob);
}

function fetchAndReadBlob(url, callback) {
    fetchBlob(url,
    function(blob) {
        readBlob(blob, callback);
    });
}

function playAmrBlob(blob, callback) {
    readBlob(blob,
    function(data) {
        playAmrArray(data);
    });
}

function convertAudioBlobToAmr(blob) {
    readBlob(blob,
    function(data) {
        var ctx = getAudioContext();
        ctx.decodeAudioData(data.buffer,
        function(audioBuffer) {
            var pcm;
            if (audioBuffer.copyFromChannel) {
                pcm = new Float32Array(audioBuffer.length);
                audioBuffer.copyFromChannel(pcm, 0, 0);
            } else {
                pcm = audioBuffer.getChannelData(0);
            }
            var amr = AMR.encode(pcm, audioBuffer.sampleRate, 7);
            playAmrArray(amr);
        });
    });
}

function playAmrArray(array) {
    var samples = AMR.decode(array);
    if (!samples) {
        alert('Failed to decode!');
        return;
    }
    playPcm(samples);
}
var playAMRsrcDOM ;
function playPcm(samples) {
    var ctx = getAudioContext();
    playAMRsrcDOM = ctx.createBufferSource();
    var buffer = ctx.createBuffer(1, samples.length, 8000);
    if (buffer.copyToChannel) {
        buffer.copyToChannel(samples, 0, 0)
    } else {
        var channelBuffer = buffer.getChannelData(0);
        channelBuffer.set(samples);
    }
    playAMRsrcDOM.buffer = buffer;
    playAMRsrcDOM.connect(ctx.destination);
    playAMRsrcDOM.start();
	return playAMRsrcDOM;
}
function stopPcm() {
    playAMRsrcDOM.stop();
}
function convertAmrBlobToWav(blob) {
    readBlob(blob,
    function(data) {
        var buffer = AMR.toWAV(data);
        E('pre').textContent = toHex(buffer);
        var url = URL.createObjectURL(new Blob([buffer], {
            type: 'audio/x-wav'
        }));
        // Play wav buffer
        var audio = new Audio(url);
        audio.onloadedmetadata = audio.onerror = function() {
            URL.revokeObjectURL(url);
        };
        audio.play();
    });
}

function toHex(buffer) {
    var str = '';
    for (var i = 0; i < buffer.length; i++) {
        var s = buffer[i].toString(16);
        if (s.length == 1) {
            s = '0' + s;
        }
        str += s;
        if (i % 16 == 15) { // print 16 bytes per line
            str += '\n'
        } else if (i % 2 == 1) { // add a space seperator every two bytes.
            str += ' ';
        }
    }
    return str;
}

function handler(evtXHR) {  
      if (xhr.readyState == 4) {  
        if (xhr.status == 200) {  
          var response = xhr.responseText;  
          //document.getElementById("content").innerHTML = "结果：" + response;  
        } else {  
         // document.getElementById("content").innerHTML = "不允许跨域请求。";  
        }  
      }  
      else {  
       // document.getElementById("content").innerHTML += "<br/>执行状态 readyState：" + xhr.readyState;  
      }  
}  