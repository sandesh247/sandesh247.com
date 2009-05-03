<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="generator" content=
  "HTML Tidy for Linux/x86 (vers 11 February 2007), see www.w3.org" />

  <title>sandesh247.com</title>
  <link rel="stylesheet" type="text/css" href=
  "http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" />
  <link rel="stylesheet" type="text/css" href="styles/fonts.css" />
  <link rel="stylesheet" type="text/css" href="styles/layout.css" />
  <script type="text/javascript" src=
  "http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js">
</script>
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
            if(uri) {
                var feed = new google.feeds.Feed(uri);
                feed.setNumEntries(7);
                feed.load(function(result) {
                    if (!result.error) {
                        var feed = result.feed;
                        container.append('<div class="feed_title"><a href="' + feed.link + '">' + feed.title + "<\/div>");
                            $.each(feed.entries, function(idx, item){
                                container.append('<div class="feed_item"><a href="' + item.link + '">' + item.title + '<\/a><\/div>');
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
  <div id="doc2" class="yui-t7">
    <div id="hd" role="banner">
      <h2>sandesh247's home page</h2>
    </div>

    <div id="bd" role="main">
      <div class="yui-gc">
        <div class="yui-u first main">
          <!-- TOP MAIN -->

          <p>Here's my <a href="sandeshs_professional_resume.pdf">resume</a>. You may
          want the <a href="sandesh247_resume.tex">source</a>.</p>

          <p>I am currently working at <a href=
          "http://www.neorithm.com/">neorithm</a>.</p>

          <p>I've previously worked @:</p>

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
            <li>A few good <a href="quotes">words</a>.</li>
          </ul>

          <h4>More online</h4>

          <ul>
            <li>My <a href="http://sandesh247.blogspot.com/">blog</a>.</li>

            <li>A few lines of <a href=
            "http://code.google.com/p/sandesh247-lab">code</a>.</li>

            <li><font color="#FF0000" size="1"><b>new</b></font> Newer repository
            <a href="http://github.com/sandesh247">here</a>.</li>

            <li><a href="http://del.icio.us/sandesh247/blogs">Blogs</a> I visit.</li>

            <li>Meet some <a href="http://del.icio.us/sandesh247/friends">of my
            friends</a>.</li>

            <li>Some <a href="http://picasaweb.google.com/sandesh247">photos</a>.</li>

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
          "http://sandesh247.blogspot.com/feeds/posts/default?alt=rss"></div>
        </div>

        <div class="yui-u">
          <div class="rss_reader" uri=
          "http://identi.ca/api/statuses/user_timeline/sandesh247.rss"></div>
        </div>

        <div class="yui-u">
          <div class="rss_reader" uri=
          "http://www.google.com/reader/public/atom/user%2F16614168867282228082%2Fstate%2Fcom.google%2Fbroadcast">
          </div>
        </div>
      </div>

      <div class="yui-g">
        <h4 class="center">Meta</h4>
      </div>

      <div class="yui-gb">
        <div class="yui-u first center">
          <a href="http://github.com/sandesh247/sandesh247.com/tree/master">Site
          source.</a>
        </div>

        <div class="yui-u center">
          <a href="http://github.com/sandesh247/sandesh247.com/issues">Bugs on this
          site.</a>
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

