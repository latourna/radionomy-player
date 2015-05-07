<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Rubbish Radio</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" type="text/css" href="css/player.css">
        <link href="jPlayer-2.9.2/dist/skin/blue.monday/css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="jPlayer-2.9.2/lib/jquery.min.js"></script>
        <script type="text/javascript" src="jPlayer-2.9.2/dist/jplayer/jquery.jplayer.min.js"></script>
        <script type="text/javascript" src="js/player.js"></script>
    </head>
    <body>
        <div id="player">
            <div id="cover"></div>
            <div id="info">
                <p class="artist"><span>""</span></p>
                <p class="track"><span>""</span></p>
            </div>
            <div id="jquery_jplayer_1" class="jp-jplayer"></div>
            <div id="jp_container_1" class="jp-audio-stream" role="application" aria-label="media player">
                <div class="jp-type-single">
                    <div class="jp-gui jp-interface">
                        <div class="jp-controls">
                            <button class="jp-play" role="button" tabindex="0">play</button>
                        </div>
                        <div class="jp-volume-controls">
                            <button class="jp-mute" role="button" tabindex="0">mute</button>
                            <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
                            <div class="jp-volume-bar">
                                <div class="jp-volume-bar-value"></div>
                            </div>
                        </div>
                    </div>
                    <div class="jp-details">
                        <div class="jp-title" aria-label="title">&nbsp;</div>
                    </div>
                    <div class="jp-no-solution">
                        <span>Update Required</span>
                        To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
                    </div>
                </div>
            </div>
        </div>
        <script>
            var stream = {
                title: "Rubbish Radio",
                mp3: "http://listen.radionomy.com/rubbishradio"
            },
            ready = false;
            currentStream = {"logo": "https://i.radionomy.com/document/radios/8/8913/8913381b-377c-4165-a8cd-1f70c640dd01.s300.png"};
            $(Ready);
        </script>
    </body>

</html>
