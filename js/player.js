var currentSongTimeout = null;

var exportablePlayer = null;
var adText = "Publicité";

function Ready() {
	InitializeExportablePlayer();
	GetCurrentSong();
}

function InitializeExportablePlayer() {
	exportablePlayer = $('#player');
	player = exportablePlayer.find('#jquery_jplayer_1').jPlayer({
        ready: function (event) {
            ready = true;
            $(this).jPlayer("setMedia", stream);
        },
        pause: function() {
            $(this).jPlayer("clearMedia");
        },
        error: function(event) {
            if(ready && event.jPlayer.error.type === $.jPlayer.error.URL_NOT_SET) {
                // Setup the media stream again and play it.
                $(this).jPlayer("setMedia", stream).jPlayer("play");
            }
        },
        swfPath: "jPlayer-2.9.2/dist/jplayer",
        supplied: "mp3",
        preload: "none",
        wmode: "window",
        useStateClassSkin: true,
        autoBlur: false,
        keyEnabled: true
	});

    currentStream.isPlaying = true;
}

function GetCurrentSong() {
	if (currentSongTimeout) clearTimeout(currentSongTimeout);
	$.post('currentsong/call_api.php',
		{  },
		function (result) {
			if (result) {
				var currentSongData = JSON.parse(result).track;
				var artist = currentSongData.artists;
				var title = currentSongData.title;

				clearTimeout(currentSongTimeout);

				if (artist != null && artist.length > 0) {
					var ad = artist.match(/targetspot/i) || title.match(/targetspot/i);

					exportablePlayer.find('#info .artist span').text(ad ? '-' : artist);
					exportablePlayer.find('#info .track span').text(ad ? adText : title);
					exportablePlayer.find('#info .artist, #info .track').show();

					currentStream.cover = currentSongData.cover;
				}
				else {
					exportablePlayer.find('#info .artist, #info .track').hide();
				}

				if (currentStream.isPlaying && currentStream.cover && currentStream.cover.length > 2 && !ad) {
					SetPlayerImage(currentStream.cover);
				}
				else {
					SetPlayerImage(currentStream.logo);
				}
                var callback = currentSongData.playduration - (new Date().getTime() - new Date(currentSongData.starttime).getTime());
                if(callback < 0) callback = 5000;
				currentSongTimeout = setTimeout(GetCurrentSong, callback);
			}
		});
}

function SetPlayerImage(image) {
	exportablePlayer.find('#cover').css("background-image", "url('" + image + "')");
}