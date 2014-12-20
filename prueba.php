<html>
    <head>
        <script>


            function updateButtonClipboardAttribute() {
                document.getElementById("copy-button").setAttribute("data-clipboard-text", document.getElementById("test").innerHTML);
            }

        </script>
    </head>
    <body>
        <textarea id="test" onkeyup="updateButtonClipboardAttribute()">
            Cosa pa probar
        </textarea>
        <button id="copy-button" data-clipboard-text=" " >Copy to Clipboard</button>
        <script src="js/zeroClipBoard/ZeroClipboard.js"></script>
        <script>
            var client = new ZeroClipboard(document.getElementById("copy-button"));

        </script>
    </body>
</html>