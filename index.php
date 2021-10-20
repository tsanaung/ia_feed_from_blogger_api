<?php
// REPLACE
// "BLOGID" with "Your Blog ID", "APIKEY" with "Your API Key" and some other static data.
$blogia = file_get_contents('https://www.googleapis.com/blogger/v3/blogs/BLOGID/posts?key=APIKEY');
$data_raw = json_decode($blogia);
$data_items = $data_raw->items;

header('Content-type: application/xml');

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?><rss version=\"2.0\" xmlns:content=\"http://purl.org/rss/1.0/modules/content/\"><channel><title>News Publisher</title><link>http://www.example.com/</link><description>Read our awesome news, every day.</description><language>en-us</language><lastBuildDate>2014-12-11T04:44:16Z</lastBuildDate>";

foreach ($data_items as $data) {
    echo "<item> <title>$data->title</title> <link>https://your-static-site/articles/pid=$data->id</link> <guid>$data->etag</guid> <pubDate>$data->published</pubDate> <author>Blogia</author> <description>This is my first Instant Article. How awesome is this?</description> <content:encoded> <![CDATA[ <!doctype html><html lang=\"en\" prefix=\"op: http://media.facebook.com/op#\"><head><meta charset=\"utf-8\"> <link rel=\"canonical\" href=\"https://your-static-site/articles/pid=$data->id\"> <meta property=\"op:markup_version\" content=\"v1.0\"></head><body><article> <header>$data->title</header> $data->content <footer>&copy;2021 Blobia | All Rights Reserved</footer> </article></body></html>]]></content:encoded></item>";
}

echo "</channel></rss>"
?>
