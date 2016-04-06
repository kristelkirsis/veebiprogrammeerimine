<?php
//  /lib/utils.php
function fixDb ($val) {
    return '"'.addlashes ($val).'"';
}

?>