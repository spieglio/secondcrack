<?php
 Header("Cache-Control: must-revalidate");

 $offset = 60 * 60 * 24 * 0.5;
 $ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
 Header($ExpStr);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <link rel="alternate" type="application/rss+xml" title="RSS" href="/rss.xml" />
        <meta name="viewport" content="width=device-width" />
        <link rel="apple-touch-icon-precomposed" href="/apple-touch-icon.png"/>

        <link rel="author" href="https://plus.google.com/114970984554176279502/posts" />
        <!--link rel="author" type="text/plain" href="http://cspiegl.com/humans.txt" /-->
        <meta name="author" content="Christoph Spiegl" />
        <meta name="description" content="The personal blog of Christoph Spiegl. Web-development, photography and what I care about." />
        <meta name="keywords" content="Tech, Movies, Personal, Blog, Thoughts, Development, Web, Photography" />

        <link rel="stylesheet" href="<?=$content['blog-url']?>/_/css/style.css?v=1.0" />


        <title><?= 
            (isset($content['post']) ? h($content['post']['post-title']) . ' &ndash; ' : '') . 
            ($content['page-title'] != $content['blog-title'] && (
                $content['page-type'] == 'page' || $content['page-type'] == 'archive' || $content['page-type'] == 'tag' || $content['page-type'] == 'type' 
            ) ? h($content['page-title']) . ' &ndash; ' : '') . 
            h($content['blog-title']) 
        ?></title>

        <? if ($content['page-type'] != 'frontpage' && $content['page-type'] != 'page' && $content['page-type'] != 'post') { ?>
            <meta name="robots" content="noindex" />
        <? } ?>
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>
    <body>
        <header id="main">
            <h1><a href="<?=$content['blog-url']?>"><?=$content['blog-title']?></a></h1>

            <p id="description">
                My name is <a href="<?=$content['blog-url']?>/about">Christoph Spiegl</a>:<br />
                I am the founder of <a href="http://AIDvertisement.net" target="_blank">AIDvertisement.net</a> and currently work on projects around the field of photography, web- and mobile-development.
            </p>
            <nav>
                <ul>
                    <li><a href="<?=$content['blog-url']?>/about">About</a></li>
                    <!--li><a href="<?=$content['blog-url']?>/tagged-bestof">Best Of</a></li-->
                    <li><a href="http://facebook.com/cspiegl" target="_blank">Facebook</a></li>
                    <li><a href="http://twitter.com/CHRISSPdotCOM" target="_blank">Twitter</a></li>
                </ul>
            </nav>
        </header>

        <section id="posts">

            <? if ($content['page-type'] == 'page') { ?>
                <article>
                    <header>
                        <h2><?= h($content['page-title']) ?></h2>
                    </header>
                    <?= $content['page-body'] ?>
                </article>

                <div class="fin">&Oslash;</div>
            <? } else { ?>
                <? if (isset($content['posts'])) foreach ($content['posts'] as $post) { ?>
                    <article<?= $post['post-type'] == 'link' ? ' class="link"' : '' ?>>
                        <header>
                            <h2>
                                <a href="<?= h($post['post-permalink-or-link']) ?>"><?= h($post['post-title']) ?></a>
                                <?= $post['post-type'] == 'link' ? '<span class="linkarrow">&rarr;</span>' : '' ?>
                            </h2>

                            <p>
                                <time datetime="<?= h(date('c', $post['post-timestamp'])) ?>" pubdate="pubdate"><?= date('F j, Y', $post['post-timestamp']) ?></time>
                                &bull;
                                <a class="permalink" title="Permalink" href="<?= h($post['post-permalink']) ?>">∞</a>
                            </p>
                        </header>
                    
                        <div class="post-body">
                            <?= $post['post-body'] ?>
                        </div>

                    </article>
                    
                    <div class="fin">&Oslash;</div>
                <? } ?>
            <? } ?>
            
            <!--div>
                <pre>
                    <?php
                        //print_r($content);
                    ?>
                </pre>
            </div-->



            <? if (isset($content['archives']) && $content['page-type'] != 'page' && $content['page-type'] != 'post') { ?>
                <nav id="archives">
                    <h3>Archives</h3> 
                    <div style="clear: both; font-size: 1px; line-height: 1px;">&nbsp;</div>
                    <div style="float: left; width: 90px; text-align: right; padding-bottom: 2em;">
                        <? $so_far = 0; $per_column = ceil(count($content['archives']) / 5); ?>
                        <? foreach ($content['archives'] as $archive) { ?>
                            <? if (++$so_far > $per_column) { ?>
                                <? $so_far = 1; ?>
                                </div>
                                <div style="float: left; width: 90px; text-align: right;">
                            <? } ?>
                            <a href="<?= h($archive['archives-uri']) ?>"><?= $archive['archives-month-short-name'] ?>&nbsp;<?= $archive['archives-year'] ?></a>
                            <br/>
                        <? } ?>
                    </div>
                    <div style="clear: both; font-size: 1px; line-height: 1px;">&nbsp;</div>
                </nav>
            <? } ?>
        </section>

        <footer>
            <p>Follow the CSPIEGL.com <a href="/rss.xml">RSS feed</a><!--, <a href="***LINK***">Email Subscription</a>--><!-- or <a href="***LINK**">Twitter feeed</a>-->.</p>
            <p>&copy; <?= date('Y') == 2012 ? '2012' : '2012-'.date('Y'); ?> Christoph Spiegl.</p>
            <p>Powered by <a href="http://www.marco.org/secondcrack">Second Crack</a>. My <a href="<?=$content['blog-url']?>/imprint">Imprint</a>.</p>
        </footer>

        <script type="text/javascript">
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-1173222-17']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();
        </script>
    </body>
</html>
