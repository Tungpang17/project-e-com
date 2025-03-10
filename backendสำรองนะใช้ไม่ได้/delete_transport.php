<?php
include("conf/mariadb.php");

if (!$_GET["id"]) {
    echo '';
} else {
    $sql = "DELETE FROM transport WHERE tra_id = '" . $_GET["id"] . "'";

    mysqli_query($con, $sql);
}

header('location:transport.php');