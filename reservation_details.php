<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Details</title>
    <style>
        .container {
            text-align: center;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .details-table-container {
            overflow-x: auto; /* Enable horizontal scrolling */
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
        }

        .details-table th,
        .details-table td {
            border: 1px solid #dddddd;
            padding: 8px;
        }

        .details-table th {
            background-color: #f2f2f2;
        }

        .details-link {
            color: blue; /* Change the color if needed */
            text-decoration: none;
            transition: padding 0.3s ease, -webkit-filter 0.3s ease, filter 0.3s ease;
            padding: 0px 50px;
        }

        .details-link:hover {
            -webkit-filter: drop-shadow(1px 1px 1px #222);
            filter: drop-shadow(1px 1px 1px #222);
        }
    </style>
</head>
<body>
    <?php include 'shared/navigation.html'; ?>
    <div class="container">
        <h1>Reservation Details</h1>
        <div class="details-table-container">
            <table class="details-table">
                <thead>
                    <tr>
                        <th>Reservation ID</th>
                        <th>Guest Name</th>
                        <th>Room ID</th>
                        <th>Check-in Date</th>
                        <th>Check-out Date</th>
                        <th>Room Size</th> <!-- Added Room Size -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include database connection
                    include 'config.php';

                    // Check if reservation ID is provided and is a valid integer
                    if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
                        $reservation_id = $_GET['id'];

                        // Convert the ID to an integer for security and consistency
                        $reservation_id = intval($reservation_ID);

                        // Query to fetch reservation details based on ID
                        $query = "SELECT r.*, g.first_name, g.last_name, g.telephone, g.email, rm.room_size 
                                  FROM Reservations r
                                  INNER JOIN Guests g ON r.guest_id = g.guest_id
                                  INNER JOIN Rooms rm ON r.room_id = rm.room_id
                                  WHERE reservation_id = $reservation_id";
                        $result = $con->query($query);

                        // Display reservation details
                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo "<tr>";
                            echo "<td>" . $row['reservation_ID'] . "</td>";
                            echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                            echo "<td>" . $row['room_id'] . "</td>";
                            echo "<td>" . $row['check_in_date'] . "</td>";
                            echo "<td>" . $row['check_out_date'] . "</td>";
                            echo "<td>" . $row['room_size'] . "</td>";
                            echo "</tr>";
                        } else {
                            echo "<tr><td colspan='6'>Reservation not found.</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Invalid reservation ID.</td></tr>";
                    }

                    // Close database connection
                    $con->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
