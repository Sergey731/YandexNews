<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
</head>
<body>
    <?php
    $monthes = [
        1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля',
        5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа',
        9 => 'сентября', 10 => 'октября', 11 => 'ноября', 12 => 'декабря'
    ];
    $news_date = (date('Новости за d ') . $monthes[(date('n'))] . date(' Y года: '));
    echo "<h3>$news_date</h3>";    
    
    $page = file_get_contents("https://www.yandex.ru");
    $marker = '"link list__item-content link_black_yes" aria-label="';
    $marker_count = substr_count($page, $marker);
    $pos = strpos($page, $marker);
    $storage = [];
    $counter = 0;
    $last = '>';
    $pos_last = strpos($page, $last, $pos);

    while ($counter < $marker_count) {
        $str = substr($page, $pos + strlen($marker), $pos_last - ($pos + strlen($marker)) - 1);
        array_push($storage, $str);
        $counter++; 
        $pos = strpos($page, $marker, $pos + 1);
        $pos_last = strpos($page, $last, $pos);         
    }
    echo '<ul>';
    for ($i = 0; $i < $marker_count; $i++) {
        echo "<li>$storage[$i]</li>";        
    }
    echo '</ul>';
    ?>     	
</body>
</html>