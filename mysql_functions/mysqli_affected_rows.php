<?php

if ($mysqli->affected_rows!=-1){
    echo "success";// for "INSERT IGNORE" statements will not occur if there were any duplicate key errors ignored during execution of the query
}
else {
    echo "fail";// "INSERT IGNORE" statements causing any duplicate key errors (however ignored) lead to mysqli->affected_rows equal -1
}

?>
