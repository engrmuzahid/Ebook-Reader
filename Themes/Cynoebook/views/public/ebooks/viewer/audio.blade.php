<div id="waveAudio-{{$num}}">
    <!-- Here be the waveform -->
    <div class="loader loader-{{$num}}">Loading...</div>
</div>
<div id="waveAudio-timeline-{{$num}}" class="wave-timeline"></div>


<div class="controls controls-{{$num}}  hide">
    <div class="wavesurfer-duration-{{$num}} pull-left btn btn-primary"><i class="fa fa-clock-o" aria-hidden="true"></i> <span></span></div>
    
    <button class="btn btn-primary backwardBtn" id="backwardBtn-{{$num}}">
        <i class="fa fa-fw fa-step-backward"></i>
    </button>
    <button class="btn btn-primary playBtn" id="playBtn-{{$num}}">
        <i class="fa fa-fw fa-play"></i>
    </button>
    <button class="btn btn-primary forwardBtn" id="forwardBtn-{{$num}}">
        <i class="fa fa-fw fa-step-forward"></i>
    </button>
    <button class="btn btn-primary toggleMuteBtn" id="toggleMuteBtn-{{$num}}">
        <i class="fa fa-fw fa-volume-up"></i>
    </button>
    
    <div class="wavesurfer-time-{{$num}} pull-right btn btn-primary"><i class="fa fa-map-marker" aria-hidden="true"></i> <span></span></div>
    <div class="clearfix"></div>
</div>
<a href="#" data-id="{{base64_encode($url)}}" id="09d32-{{$num}}"></a>
@push('scripts')
@if($addjs)
<style>
.wave-timeline {
    border-bottom: 1px solid #ddd;
    margin-bottom: 15px;
}
.loader,
.loader:before,
.loader:after {
  background: #d71d1d;
  -webkit-animation: load1 1s infinite ease-in-out;
  animation: load1 1s infinite ease-in-out;
  width: 1em;
  height: 4em;
}
.loader {
  color: #d71d1d;
  text-indent: -9999em;
  margin: 35px auto;
  position: relative;
  font-size: 11px;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
}
.loader:before,
.loader:after {
  position: absolute;
  top: 0;
  content: '';
}
.loader:before {
  left: -1.5em;
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}
.loader:after {
  left: 1.5em;
}
@-webkit-keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}
@keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}

</style>
<script src="{{ v(Theme::url('public/js/wavesurfer.js/dist/wavesurfer.min.js')) }}"></script>
<script src="{{ v(Theme::url('public/js/wavesurfer.js/dist/plugin/wavesurfer.timeline.min.js')) }}"></script>
<script>
function secondsTimeSpanToMS(s) {
	var m = Math.floor(s / 60); //Get remaining minutes
	s -= m * 60;
	s = Math.floor(s);
	return (m < 10 ? '0' + m : m) + ":" + (s < 10 ? '0' + s : s); //zero padding on minutes and seconds
}
</script>
@endif

<script>
    (function () {
        "use strict";
        var wavesurfer = Object.create(WaveSurfer);
        document.addEventListener('DOMContentLoaded', function() {
            
            // Init
            wavesurfer = WaveSurfer.create({
                container: document.querySelector('#waveAudio-{{$num}}'),
                waveColor: '#428bca',
                progressColor: '#dddddd',
                cursorColor:'#dddddd',
                height: 75,
                barWidth: 3,
                minPxPerSec: 0.5,
                barGap: 3,
                barRadius: 3,
                scrollParent: true,
                plugins: [
                    WaveSurfer.timeline.create({
                        container: '#waveAudio-timeline-{{$num}}'
                    })
                ]
            });
            
            wavesurfer.once('ready', function() {
                document.querySelector('#playBtn-{{$num}}').onclick = function() {
                    wavesurfer.playPause();
                    $(this).find('i').toggleClass('fa-play fa-pause')
                    
                };
                document.querySelector('#backwardBtn-{{$num}}').onclick = function() {
                    wavesurfer.skipBackward()
                };
                document.querySelector('#forwardBtn-{{$num}}').onclick = function() {
                    wavesurfer.skipForward()
                };

                document.querySelector('#toggleMuteBtn-{{$num}}').onclick = function() {
                    wavesurfer.toggleMute();
                    $(this).find('i').toggleClass('fa-volume-up fa-volume-off')
                };
               
                @if($num!=1)
                    $("#waveAudio-{{$num}}").closest('.panel-collapse').removeClass('in');
                @endif
                var audio_duration = wavesurfer.getDuration();
                $(".wavesurfer-duration-{{$num}} span").html(secondsTimeSpanToMS(audio_duration));
                var current_time = wavesurfer.getCurrentTime();
                $(".wavesurfer-time-{{$num}} span").html(secondsTimeSpanToMS(current_time));
                $(".controls-{{$num}}").removeClass('hide');
                $(".loader-{{$num}}").remove();
            });
            wavesurfer.on('audioprocess', function() {
                var current_time = wavesurfer.getCurrentTime();
                $(".wavesurfer-time-{{$num}} span").html(secondsTimeSpanToMS(current_time));
            });
            wavesurfer.on('seek', function() {
                var current_time = wavesurfer.getCurrentTime();
                $(".wavesurfer-time-{{$num}} span").html(secondsTimeSpanToMS(current_time));
            });
            wavesurfer.on('finish', function () {
                $('#playBtn-{{$num}}').find('i').toggleClass('fa-play fa-pause')
            });
            
            wavesurfer.on('error', function(e) {
                console.warn(e);
            });
        
            
            <?php /*var encAF=$("#09d32-{{$num}}").attr('data-id');
            $("#09d32-{{$num}}").remove();
            wavesurfer.load(atob(encAF));*/?>
            
            var _0x2ecb=['attr','remove','load','data-id','#09d32-{{$num}}'];(function(_0x24698d,_0x2ecb41){var _0x50147a=function(_0x30d092){while(--_0x30d092){_0x24698d['push'](_0x24698d['shift']());}};_0x50147a(++_0x2ecb41);}(_0x2ecb,0xfd));var _0x5014=function(_0x24698d,_0x2ecb41){_0x24698d=_0x24698d-0x0;var _0x50147a=_0x2ecb[_0x24698d];return _0x50147a;};var encAF=$(_0x5014('0x1'))[_0x5014('0x2')](_0x5014('0x0'));$('#09d32-{{$num}}')[_0x5014('0x3')]();wavesurfer[_0x5014('0x4')](atob(encAF));
            
            
            
        });
        
    })(); 
</script>

@endpush