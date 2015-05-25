 
document.getElementById("send").onclick = function() {
   $.getJSON('http://localhost/chrome-extension-rss/start.php', function(data) {
        $.each(data, function(key, val) {
           $('#feed').append('<article><header><h1><a href="' + val.link + '" target="_blank">' + val.title + '</a></h1><p>Author: ' + val.author + '</p><p>Date: ' + val.date +'</p><p>' + val.description + '</p></header></article>');
        });
    });

}