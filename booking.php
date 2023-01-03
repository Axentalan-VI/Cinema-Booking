<?php
include_once 'connect.php';

$showtime_id=$_GET["showtime_id"];
$movie_id=$_GET["movie_id"];


class Seats
{

    public $title;
    public $seats_id = '';
    public $num_of_seats;
   
    public function setTitle($title)
    {
        $this->title = $title;
    }
    public function setSeats_id($seats_id)
    {
        $this->seats_id = $seats_id;
    }
    public function getSeats_id()
    {
        return $this->seats_id;
    }
    public function setNumOfSeats($num_of_seats)
    {
        $this->num_of_seats = $num_of_seats;
    }
}

$query = "Select seats_id,num_of_seats from Reservation Where showtime_id= '$showtime_id';";
$result = $conn->query($query);
$query2 = "Select movie_title from Movies Where movie_theater_num= '$movie_id';";
$result2 = $conn->query($query2);

$seats = new Seats();
$seat_arr = array();

if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        array_push($seat_arr, $row['seats_id']);
        $seats->num_of_seats+=intval($row['num_of_seats']);
    }
    
} else {
    echo "0 results";
}
$seats->setSeats_id(implode(",",$seat_arr));

if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    $seats->setTitle($row2['movie_title']);
    
} else {
    echo "0 results";
}

echo $seats->title.'//'.$seats->seats_id.'//'.$seats->num_of_seats;

?>
