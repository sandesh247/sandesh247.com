(function(){

  /* makes all <pre> tags code elements. */  
  var applyHiliteHack = function() {
    // to apply this hack, just include the relevant google prettify script file.    
    if(window.prettyPrint) {
      $('pre').addClass('prettyprint');
      prettyPrint();
    }
  }
  
  var loadRssItems = function() {
    $(".rss_reader").each(function(elem){
      var container = $(this);
      var uri = container.attr('uri');
      var itemContatiner = container.find('.items');
      if(uri) {
        var feed = new google.feeds.Feed(uri);
        feed.setNumEntries(10);
        feed.load(function(result) {
          if (!result.error) {
            var feed = result.feed;
            $.each(feed.entries, function(idx, item){
              itemContatiner.append('<div class="feed_item"><a href="' + item.link + '">' + item.title + '<\/a><\/div>');
            });
          }
        }); /* end feed.load */
      } /* end if(uri) */
    }); /* end rss_reader.each */
  } /* end load Items */
  
  var init = function() {
    applyHiliteHack();
    loadRssItems();
  }
  
  google.load("feeds", "1");
  google.load("jquery", "1");
  
  google.setOnLoadCallback(init);

})();