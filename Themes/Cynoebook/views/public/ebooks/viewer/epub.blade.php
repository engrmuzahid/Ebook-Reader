<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        
        <link rel="stylesheet" href="{{ v(Theme::url('epub/css/main.css')) }}">
        
        <script src="{{ v(Theme::url('epub/js/jquery.min.js')) }}"></script>
        <script src="{{ v(Theme::url('epub/js/zip.min.js')) }}"></script>
        
        <script>
            "use strict";
            document.onreadystatechange = function () {
              if (document.readyState == "complete") {
                window.reader = ePubReader("{{ $file_url }}", {
                   restore: true
                });
              }
            };
        </script>
        <script src="{{ v(Theme::url('epub/js/screenfull.min.js')) }}"></script>
        <script src="{{ v(Theme::url('epub/js/epub.js')) }}"></script>
        <script src="{{ v(Theme::url('epub/js/reader.js')) }}"></script>
    </head>
    <body>
        <div id="sidebar">
            <div id="panels">
                <a id="show-Toc" class="show_view icon-list-1 active" data-view="Toc">TOC</a>
            </div>
            <div id="tocView" class="view">
            </div>
        </div>
        <div id="main">

            <div id="titlebar">
                <div id="opener">
                    <a id="slider" class="icon-menu">Menu</a>
                </div>
                <div id="metainfo">
                    <span id="book-title"></span>
                    <span id="title-seperator" style="display: inline;"></span>
                    <span id="chapter-title"></span>
                </div>
                <div id="title-controls">

                </div>
            </div>

            <div id="divider" class="show"></div>
            <div id="prev" class="arrow">‹</div>
            <div id="viewer"></div>
            <div id="next" class="arrow">›</div>

            <div id="loader" style="display: none;"><img src="loader.gif"></div>
        </div>
      
        <div class="overlay"></div>
    </body>
</html>