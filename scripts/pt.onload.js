(function() {
  
	var loadRssItems = function($) {
    $(".rss_reader").each(function(elem){
      var container = $(this);
      var uri = container.attr('uri');
      var itemContatiner = container.find('.items');
      if(uri) {
        var feed = new google.feeds.Feed(uri);
        feed.setNumEntries(5);
        feed.load(function(result) {
          if (!result.error) {
            var feed = result.feed;
            $.each(feed.entries, function(idx, item){
              itemContatiner.append('<li class="feed_item"><a href="' + item.link + '">' + item.title + '<\/a><\/li>');
            });
          }
        }); /* end feed.load */
      } /* end if(uri) */
    }); /* end rss_reader.each */
  } /* end load Items */
  
  var init = function() {
		loadRssItems(jQuery);
	};

	google.load("feeds", "1");
  google.load("jquery", "1");
  
  google.setOnLoadCallback(init);
})();
