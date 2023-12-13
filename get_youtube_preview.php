<?php
$apiKey = '';
$searchTerm = 'game';
$maxResults = 10;

$url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=$searchTerm&maxResults=$maxResults&key=$apiKey";

$response = file_get_contents($url);
$data = json_decode($response, true);

foreach ($data['items'] as $item) {
    $videoId = $item['id']['videoId'];
    $videoTitle = $item['snippet']['title'];

    echo "<div class='video'>";
    echo "<h2>" . $videoTitle . "</h2>";
    echo "<iframe width='100%' height='auto' src='https://www.youtube.com/embed/$videoId' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>";
    echo "</div>";
}
?>