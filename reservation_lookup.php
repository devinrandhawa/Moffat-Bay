<?php
$searched = false; // Initialize the variable

// Include the database configuration file to establish the connection
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $searched = false;
    $reservation_ID = $_POST['reservation_ID'];
    $email = $_POST['email'];

    //Querying the view for the reservation information
    $query = "SELECT * FROM reservationinfo WHERE reservation_id = '$reservation_ID' or email = '$email'";

    $result = $con->query($query);
    $searched = true;
}
?>

<!DOCTYPE html>
<!-- Team 2 : Capstone Project Room Reservation Page -->
<html lang="en">

<head>
    <title>CSD460 Capstone</title>
    <link href="shared/style.css" type="text/css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Julius Sans One' rel='stylesheet'>
</head>

<body class="landing-page">
    <?php
    readfile("shared/navigation.html");
    ?>
    <div id="container">
        <div class="card">
            <div class="card-title">
                <p>Reservation Lookup</p><br>
            </div>
            <div class="card-content">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label for="reservation_ID">
                        Reservation ID:
                    </label>
                    <label>
                        <input type="text" id="reservation_ID" name="reservation_ID">
                    </label>
                    <label for="email">
                        Email:
                    </label>
                    <label>
                        <input type="text" id="email" name="email"><br>
                    </label><br><br>
                    <label>
                        <input type="submit" value="Find Your Reservation!">
                    </label>
                </form>
            </div>
            <div class="card-content left-text">
                <?php
                if ($searched == true) {
                    //Displaying the results
                    if ($result->num_rows > 0) {
                        echo "<br><br><table>
                    <th>Reservation ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Room Type</th>
                    <th>Check In Date</th>
                    <th>Check Out Date</th>
                    <th>Number of Guests</th>
                    <th>Nights Booked</th>
                    <th>Stay Total</th>
                    </tr>";
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['reservation_ID'] . "</td>";
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['last_name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['room_type'] . "</td>";
                            echo "<td>" . $row['check_in_date'] . "</td>";
                            echo "<td>" . $row['check_out_date'] . "</td>";
                            echo "<td>" . $row['num_of_guests'] . "</td>";
                            echo "<td>" . $row['nights_booked'] . "</td>";
                            echo "<td>" . $row['stay_total'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<script>alert('No Reservations were found using that Email Address or Reservation ID');</script>";
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
