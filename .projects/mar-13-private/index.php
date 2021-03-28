<?php
$sTrips = '[{"from":"A", "to":"B", "stops":[{"name":"STOP ONE", "duration":100}, {"name":"STOP TWO", "duration":200}]}, {"from":"X", "to":"Y", "stops":[{"name":"STOP Ten", "duration":50}, {"name":"STOP Eleven", "duration":60}]}]';
$ajData = json_decode($sTrips);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body{color: white; background-color: rgba(50, 60, 70, 1);}
    </style>
    <title>loop in loop</title>
</head>
<body>
    <?php
    // loops through the page
    foreach($ajData as $jTrip){
        echo "<div>FROM: $jTrip->from</div>";
        echo "<div>TO: $jTrip->to</div>";
        // loop through the stops
        foreach($jTrip->stops as $jStop){
            echo "<div>name: $jStop->name Time: $jStop->duration</div>";
        }
    }
    ?>
    
</body>
</html>