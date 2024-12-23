<?php

    include_once("config.php");
	// Check If form submitted, insert form data into users table.
	if(isset($_POST['Submit'])) {
        $username = trim($_POST["username"]);
        $password = $_POST['password'];
        $first_name = $_POST["firstname"];
        $last_name = $_POST["lastname"];
        $birthday = $_POST["birthday"];
        $gender = $_POST["gender"];
        $is_admin = isset($_POST["admin"]) && $_POST["admin"] == '1' ? 1 : 0;
        
		if (empty($username) || empty($password) || empty($first_name) || empty($last_name) || empty($birthday) || empty($gender)) {
            echo '<script>alert("Please fill out all required fields.")</script>';
            exit;
        }
        $password = password_hash($password, PASSWORD_DEFAULT);
		// include database connection file
				
		// Insert user data into table
        $stmt = $conn->prepare("INSERT INTO users (username, first_name, last_name, password, birthday, gender, is_admin) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $username, $first_name, $last_name, $password, $birthday, $gender, $is_admin);
    
        if ($stmt->execute()) {
            echo '<script>alert("User Successfully added")</script>';
        } else {
            echo '<script>alert("Failed to add user. Please try again.")</script>';
        }
    
		// echo '<script>alert("User Successfully added")</script>';
        $stmt->close();
        $conn->close();	
	}
?>
<html>
<head>
	<title>Add Users</title>
    <!-- later make the css file-->
	<link rel="stylesheet" href="styles/register.css"><link rel="stylesheet" href="styles/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <h1>Add Users</h1>
    <!-- Starting here -->
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" name="form1">
        <table width="100%" border="0" class="table">
            <tr> 
                <td><label for="username" class="form-label">Username</label></td>
                <td><input type="text" id="username" class="form-control" name="username" required></td>
            </tr>	
            <tr> 
                <td><label for="password" class="form-label">Password</label></td>
                <td><input type="password" id="password" class="form-control" name="password" required></td>
            </tr>	
            <tr> 
                <td><label for="firstname" class="form-label">First Name</label></td>
                <td><input type="text" id="firstname" class="form-control" name="firstname" required></td>
            </tr>	
            <tr>
                <td><label for="lastname" class="form-label">Last Name</label></td>
                <td><input type="text" id="lastname" class="form-control" name="lastname" required></td>
            </tr>
            <tr> 
                <td><label for="birthday" class="form-label">Birthday</label></td>
                <td><input type="date" id="birthday" class="form-control" name="birthday" required></td>
            </tr>
            <tr>
                <td><label class="form-check-label-gender" for="mb-3-gender">Gender</label></td>
                <td><div class="mb-3-gender">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="male-gender" value="male" required>
                        <label class="form-check-label" for="male-gender">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="female-gender" value="female">
                        <label class="form-check-label" for="female-gender">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="other-gender" value="other">
                        <label class="form-check-label" for="other-gender">Other</label>
                    </div>
                </div></td>
            </tr>
            <tr> 
                <td>Is Administrator?</td>
                <td><div class="mb-3">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="admin" id="not-admin" value="0" required>
                        <label class="form-check-label" for="not-admin">No</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="admin" id="is-admin" value="1">
                        <label class="form-check-label" for="is-admin">Yes</label>
                    </div>
                </div></td>
                </td>
            </tr>
            </table>
            <td><button type="submit" name="Submit" class="btn btn-primary" value="Submit">Add User</button></td>
        </form>
        <br><br><a href="admindashboard.php"><button class="btn btn-primary">Go Back</button></a>
</body>
</html>
