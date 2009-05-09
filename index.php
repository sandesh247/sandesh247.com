<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="generator" content="Bluefish 1.0.7"/>

  <title>sandesh247.com</title>
  <link rel="stylesheet" type="text/css" href=
  "http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" />
  <link rel="stylesheet" type="text/css" href="styles/fonts.css" />
  <link rel="stylesheet" type="text/css" href="styles/layout.css" />
  <script type="text/javascript" src="http://www.google.com/jsapi">
</script>
  <script type="text/javascript">
//<![CDATA[
    // Load jQuery
    var proxy = "http://localhost/sandesh247.com/utils/proxy.php?u=";

    google.load("feeds", "1");
    google.load("jquery", "1");

    function initialize() {
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
                });
            };
        });
    }
    google.setOnLoadCallback(initialize);
  //]]>
  </script>
</head>

<body>
  <div id="doc" class="yui-t7">
    <div id="hd" role="banner" class="hiliteimp center">
      <h2>sandesh247's home page</h2>
    </div>

    <div id="bd" role="main">
      <div class="yui-gc">
        <div class="yui-u first main">
          <!-- TOP MAIN -->

          <p>Here's my <a href="resume/sandeshs_resume.pdf">resume</a>. You may
          want the <a href="resume/sandeshs_resume.tex">source</a>.</p>

          <p>I currently work at <a href="http://www.neorithm.com/">neorithm</a>.</p>

          <p>I've previously worked at:</p>

          <ul>
            <li><a href="http://www.finacus.co.in/">Finacus</a></li>

            <li><a href="http://www.amdocs.com/">Amdocs</a><br /></li>
          </ul>

          <h4>Projects</h4>

          <ul>
            <li><a href="http://tddb.sourceforge.net/">TDDB</a>.</li>
          </ul>

          <h4>Bookmarks</h4>

          <p>View my <a href="http://del.icio.us/sandesh247">tagged items</a> at <a href=
          "http://del.icio.us/">del.icio.us</a>. In particular, you may want to see the
          ones about <a href="http://del.icio.us/sandesh247/programming">programming</a>,
          <a href="http://del.icio.us/sandesh247/linux">linux</a>, or simply <a href=
          "http://del.icio.us/sandesh247/fun">fun</a>. The ones about <a href=
          "http://del.icio.us/sandesh247/life">life</a> are pretty good too.<br /></p>

          <h4>Books</h4>

          <p>There's a <a href="http://www.goodreads.com/sandesh247">separate page</a>
          dedicated to this list now.</p>
        </div>

        <div class="yui-u sidebar">
          <!-- Top Sidebar -->

          <h4>On this site</h4>

          <ul>
            <li>A few good <a href="words.php">words</a>.</li>
          </ul>

          <h4>More online</h4>

          <ul>
            <li>My <a rel="me" href="http://sandesh247.blogspot.com/">blog</a>.</li>

            <li>A few lines of <a href=
            "http://code.google.com/p/sandesh247-lab">code</a>.</li>

            <li><font color="#FF0000" size="1"><b>new</b></font> Newer repository <a rel=
            "me" href="http://github.com/sandesh247">here</a>.</li>

            <li><a href="http://del.icio.us/sandesh247/blogs">Blogs</a> I visit.</li>

            <li>Meet some <a href="http://del.icio.us/sandesh247/friends">of my
            friends</a>.</li>

            <li>Some <a rel="me" href=
            "http://picasaweb.google.com/sandesh247">photos</a>.</li>

            <li>Random <a href="stuff">Stuff</a>.</li>
          </ul>
        </div>
      </div>

      <div class="yui-g">
        <h4 class="center">Feeds</h4>
      </div>

      <div class="yui-gb">
        <div class="yui-u first">
          <div class="rss_reader" uri=
          "http://sandesh247.blogspot.com/feeds/posts/default?alt=rss">
            <div class="hiliteimp feed_title">
              <a rel="me" href="http://sandesh247.blogspot.com/">Blog</a>
            </div>

            <div class="items bghilite"></div>
          </div>
        </div>

        <div class="yui-u">
          <div class="rss_reader" uri=
          "http://identi.ca/api/statuses/user_timeline/sandesh247.rss">
            <div class="hiliteimp feed_title">
              <a rel="me" href="http://identi.ca/sandesh247">&micro;Blog</a>
            </div>

            <div class="items bghilite"></div>
          </div>
        </div>

        <div class="yui-u">
          <div class="rss_reader" uri=
          "http://www.google.com/reader/public/atom/user%2F16614168867282228082%2Fstate%2Fcom.google%2Fbroadcast">
          <div class="hiliteimp feed_title">
              <a rel="me" href=
              "http://www.google.com/reader/shared/16614168867282228082">Google Reader
              shared items</a>
            </div>

            <div class="items bghilite"></div>
          </div>
        </div>
      </div>

      <div class="yui-g">
        <h4 class="center">The arts</h4>
      </div>

      <div class="yui-gb">
        <div class="yui-u first">
          <div class="rss_reader" uri=
          "http://ws.audioscrobbler.com/1.0/user/sandesh247/recenttracks.rss">
            <div class="hiliteimp feed_title">
              <a rel="me" href="http://www.last.fm/user/sandesh247">Listening to</a>
            </div>

            <div class="items bghilite"></div>
          </div>
        </div>

        <div class="yui-u">
          <div class="rss_reader" uri=
          "http://www.goodreads.com/review/list_rss/2279676?key=8f5672c21f4fefcaa3e605c052403a3aaf88885e&amp;shelf=%23ALL%23">
          <div class="hiliteimp feed_title">
              <a rel="me" href="http://www.goodreads.com/review/list/2279676">Currently
              reading</a>
            </div>

            <div class="items bghilite"></div>
          </div>
        </div>

        <div class="yui-u">
          <div class="rss_reader" uri=
          "http://photos.googleapis.com/data/feed/base/user/sandesh247?kind=album&amp;alt=rss">
          <div class="hiliteimp feed_title">
              <a rel="me" href="http://picasaweb.google.com/sandesh247/">Recent
              photos</a>
            </div>

            <div class="items bghilite"></div>
          </div>
        </div>
      </div>

      <div class="yui-g">
        <h4 class="center">Meta</h4>
      </div>

      <div class="yui-gb">
        <div class="yui-u first center">
          <a href="http://github.com/sandesh247/sandesh247.com/tree/master">Site sources.</a>
        </div>

        <div class="yui-u center">
          <a href="http://github.com/sandesh247/sandesh247.com/issues">Report bugs on this site.</a>
        </div>

        <div class="yui-u center">
          <a href="mailto:sandesh247@gmail.com">Contact me.</a>
        </div>
      </div>
    </div>

    <div id="ft" role="contentinfo" class="center"></div>
  </div>
</body>
</html>

