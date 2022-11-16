<?php

require_once 'db/procedure.php';
$procedure = new Procedure();
$result = $procedure -> addPhrase('AL FIN JALA');
print_r($result);