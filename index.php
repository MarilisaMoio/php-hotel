<?php

    $hotels = [

        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],
    ];

    $parkFilter = isset($_GET["park"]) ? true : false;
    $voteFilter = !isset($_GET["vote"]) || $_GET["vote"] == "false" ? false : $_GET["vote"];

    $hotelsToPrint = [];
    foreach ($hotels as $hotel){
        if ($parkFilter && $voteFilter){
            $hotel["parking"] && $hotel["vote"] >= $voteFilter ? $hotelsToPrint[] = $hotel : null;
        } elseif ($parkFilter){
            $hotel["parking"] ? $hotelsToPrint[] = $hotel : null;
        } elseif ($voteFilter){
            $hotel["vote"] >= $voteFilter ? $hotelsToPrint[] = $hotel : null;
        } else {
            $hotelsToPrint[] = $hotel;
        };
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Hotel California</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <form method="GET">
        <label for="park">Filter for Parking</label>
        <input type="checkbox" name="park" id="park">
        <select name="vote">
            <option value="false" selected>Filtra per voto</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <button type="submit">Filter</button>
    </form>
    <table class="table">
        <thead>
            <tr>
            <?php foreach($hotels[0] as $key => $info) {?>
                <th scope="col"><?= str_replace("_", " ", ucfirst($key)) ?></th>
            <?php } ?>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($hotelsToPrint as $hotel) {?>
        <tr>
            <?php foreach($hotel as $key => $info) { ?>
                <?php if ($key === "parking"){ ?>
                    <td><?= $info ? "Present" : "None" ?></td>
                <?php } elseif ($key === "distance_to_center"){ ?>
                    <td><?= $info ?>km</td>
                <?php } else { ?>
                    <td><?= $info ?></td>
                <?php } ?>
            <?php } ?>
        </tr>
        <?php } ?>
    </tbody>
    </table>
    <!--bs js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!--/bs js-->
</body>
</html>