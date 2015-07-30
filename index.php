<?php
    /* Require the Pinterest API class */
    require_once 'lib/Pinterest.class.php';

    $pins = [];

    // Set users and their boards - not pretty
    $users = [ 'electricsheep01', 'electricsheep01' ];
    $boards = [ 'firewatch', 'monument-valley' ];

    // Loop for each user/board
    foreach ($users as $key=>$user) {
        $pinterest = new Pinterest($user);
        $resp = $pinterest->getPinsFromBoard($boards[$key]);

        // Merge into one array
        $pins = array_merge($pins, $resp["data"]);
    }

    // Sort by most recent (using ID)
    function compare($a, $b)
    {
        return strcmp($a->id, $b->id);
    }
    usort($pins, "compare");

?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <ul>
        <?php foreach ($pins as $pin) : ?>
            <li>
                <div style="background-color: <?php echo $pin->dominant_color; ?>; background-image: url(<?php echo $pin->images->{'237x'}->url; ?>);"></div>
                <a href="<?php echo $pin->link; ?>" style="background-color: <?php echo $pin->dominant_color; ?>;">
                    <img src="img/eye.svg" />
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
    </body>
</html>

