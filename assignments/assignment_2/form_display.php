<!DOCTYPE html>
<html>
<head>	
<style>
	div {
		margin-top: 20px;
		margin-bottom: 20px;
	}
</style>


</head>
<body>

<?php 
// The code that you recieve input data from the form goes to here.
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
    
$server = "localhost";
$username = "root";
$password = "root";
$db = "sakila";

// Create connection
$conn = mysqli_connect($server, $username, $password, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully<br><br>";

$sql = "SELECT first_name, last_name, email, address, city
        FROM customer as c JOIN address as a
            ON c.address_id = a.address_id
                JOIN city as t
                    ON t.city_id = a.city_id
        ORDER BY c.last_name ASC";

$result = mysqli_query($conn, $sql);
$boolFName = "new";
$boolLName = "new";
$boolEmail = "new";
$boolAddress = "new";
$boolCity = "new";

// check whether user input exists in the database
// in the future it is possible to compare values with case insensitive to improve the code but not now
// the code can be cleaner if I create a function to compare the values, but it is working now just ugly.....
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
        if($row['first_name'] == $firstName){
            $boolFName = "exist";
        }
        if($row['last_name'] == $lastName){
            $boolLName = "exist";
        }
        if($row['email'] == $email){
            $boolEmail = "exist";
        }
        if($row['address'] == $address){
            $boolAddress = "exist";
        }
        if($row['city'] == $city){
            $boolCity = "exist";
        }
    }
}
    
// need to create a table to display all the information.....
echo "<table border = 1 align = 'center'>";
    echo "<tr>";
        echo "<th bgcolor= '#00FFFF'><FONT FACE = 'courier'>" . "First Name" . "</FONT></th>";
        echo "<td>" . $firstName . "</td>";
        echo "<td>" . $boolFName . "</td>";
    echo"</tr>";
    echo "<tr>";
        echo "<th bgcolor= '#00FFFF'><FONT FACE = 'courier'>" . "Last Name" . "</FONT></th>";
        echo "<td>" . $lastName . "</td>";
        echo "<td>" . $boolLName . "</td>";
    echo "</tr>";
    echo "<tr>";
        echo "<th bgcolor= '#00FFFF'><FONT FACE = 'courier'>" . "Email" . "</FONT></th>";
        echo "<td>" . $email . "</td>";
        echo "<td>" . $boolEmail . "</td>";
    echo "</tr>";
    echo "<tr>";
        echo "<th bgcolor= '#00FFFF'><FONT FACE = 'courier'>" . "Address" . "</FONT></th>";
        echo "<td>" . $address . "</td>";
        echo "<td>" . $boolAddress . "</td>";
    echo "</tr>";
    echo "<tr>";
        echo "<th bgcolor= '#00FFFF'><FONT FACE = 'courier'>" . "City" . "</FONT></th>";
        echo "<td>" . $city . "</td>";
        echo "<td>" . $boolCity . "</td>";
    echo "</tr>";
echo "</table>";
?>



</body>
</html>