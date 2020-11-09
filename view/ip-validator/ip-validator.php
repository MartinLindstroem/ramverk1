<?php

namespace Anax\View;

?>

<h1>Validera Ip-adress</h1>

<form method="get">
    <input type="text" name="ipAddress">
    <input type="submit" value="Validera">
</form>

<?php if (filter_var($ipAddress, FILTER_VALIDATE_IP)) : ?> 
    <p><?=$ipAddress?> är en giltig IP-adress</p>
    <p>Domän: <?=$domainName?></p>
<?php else : ?>
    <?php if ($ipAddress) : ?>
        <p><?=$ipAddress?> är inte en giltig IP-adress</p>
    <?php endif; ?>
<?php endif; ?>