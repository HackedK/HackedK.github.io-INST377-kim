<!DOCTYPE html>
<html>
<head>	
<style>
	div {
		margin-top: 20px;
		margin-bottom: 20px;
	}
</style>

<script>
function validateForm() {
    // you can write a code for validating your forms (if you want).
}
</script>

</head>
<body>
    
<?php 
// forms need to be generated here inside the PHP tag.
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

// task 0
$sql = "SELECT first_name, last_name, email, address, city
        FROM customer as c JOIN address as a
            ON c.address_id = a.address_id
                JOIN city as t
                    ON t.city_id = a.city_id
        ORDER BY c.last_name ASC LIMIT 1 OFFSET 9";
$result = mysqli_query($conn, $sql);

 //display the query result
if (mysqli_num_rows($result) > 0) {   
    while($row = mysqli_fetch_assoc($result)) {
        display($row['first_name'], $row['last_name'], $row['email'], $row['address'], $row['city']);
    }
} else {
    echo "No results..";
}

// create the form and send input to the form_display.php
function display($firstName, $lastName, $email, $address, $city){
    echo "<form action = 'form_display.php' method ='POST'>
            <div>
                <strong>Enter the first name</strong>
                <input type = 'text' name = 'firstName' value = '$firstName'><br>
                
                <strong>Enter the last name</strong>
                <input type = 'text' name = 'lastName' value = '$lastName'><br>
                
                <strong>Enter the email</strong>
                <input type = 'email' name = 'email' value = '$email'><br>
                
                <strong>Enter the address</strong>
                <input type = 'text' name = 'address' value = '$address'><br>
                
                <strong>Enter the city</strong>
                <input type = 'text' name = 'city' value = '$city'><br>
                
                <input type = 'submit' name = 'submit'>
            </div>
        </form>";
}

// close the connection.
mysqli_close($conn);
?>
</body>
</html>