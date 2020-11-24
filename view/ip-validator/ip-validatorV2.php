<?php

namespace Anax\View;

?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>

<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>

<h1>Validera Ip-adress</h1>

<form method="get">
    <input type="text" name="ipAddress" value=<?= $userIpAddr ?>>
    <input type="submit" value="Validera">
</form>

<?php if ($isValid) : ?> 
    <p>Ip: <?=$result["ip"]?></p>
    <p>Typ: <?=$result["type"]?></p>
    <p>Land: <?=$result["country_name"]?></p>
    <p>Ort: <?=$result["region_name"]?></p>
    <p>Stad: <?=$result["city"]?></p>
    <p>Latitud: <?=$result["latitude"]?></p>
    <p>Longitud: <?=$result["longitude"]?></p>
<?php else : ?>
    <?php if ($result) : ?>
        <p><?=$result["ip"]?> är inte en giltig IP-adress</p>
    <?php endif; ?>
<?php endif; ?>
<br>
<br>
<div id="mapid" style="height: 680px;"></div>

<script type="text/javascript">
    var ipResult = <?php echo json_encode($result); ?>;
    var locationResult;
</script>