<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Connect to MySQL database
  $mysql_host = "localhost";
  $mysql_user = "root";
  $mysql_password = "";
  $mysql_db = "user";

  $mysql_conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_db);

  if (!$mysql_conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Connect to MongoDB database
  $mongo_client = new MongoDB\Client;
  $mongo_db = $mongo_client->mydb;
  $mongo_collection = $mongo_db->users;

  // Get user data from AJAX request
  $email = $_POST['email'];
  $password = $_POST['password'];
  $name = $_POST['name'];
  $dob = $_POST['dob'];
  $age = $_POST['age'];
  $contact = $_POST['contact'];

  // Hash the password
  $password = password_hash($password, PASSWORD_BCRYPT);

  // Store the login information in MySQL
  $mysql_query = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

  if (mysqli_query($mysql_conn, $mysql_query)) {
    echo "New record created successfully in MySQL";
  } else {
    echo "Error: " . $mysql_query . "<br>" . mysqli_error($mysql_conn);
  }

  // Store the user details in MongoDB
  $mongo_data = [
    'email' => $email,
    'name' => $name,
    'dob' => $dob,
    'age' => $age,
    'contact' => $contact
  ];

  $mongo_result = $mongo_collection->insertOne($mongo_data);

  echo "New record created successfully in MongoDB";
  echo "User registered successfully";
} else {
  echo "Invalid request";
}
?>

 
