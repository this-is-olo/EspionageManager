<?php

require_once 'misc.php';

class Database {

    private $link;

    public function __construct( $host, $user, $pass, $db ) {
        $link = mysqli_connect($host, $user, $pass, $db) or die("Error " . mysqli_error($link));

        $this->link = $link;
    }

    public function getPosterInformation( $round_id ) {
        $round_id = (int)sanitize($round_id);

        //$query = "SELECT * FROM `espi_users` NATURAL JOIN `espi_avatars` NATURAL JOIN `espi_teams` NATURAL JOIN `espi_roles` WHERE `round_id`=$round_id";
        $query = "SELECT `username`, `teamname`, `role_name`, `poster_position`, `avatar_url`, `isAlive` FROM `espi_users` NATURAL JOIN `espi_avatars` NATURAL JOIN `espi_teams` NATURAL JOIN `espi_roles` WHERE `round_id`=$round_id";

        //execute the query.
        $result = $this->link->query($query) or die("Error in the consult.." . mysqli_error( $this->link));

        $data = Array();
        while($row = mysqli_fetch_array($result)) {
            $data[] = $row;
        }
        return $data;
    }

}

?>