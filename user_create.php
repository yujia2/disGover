<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>
<body>

<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $passwordErr = $locationErr = "";
$name = $email = $password = $gender = $location = "";
$valid_input = true;
$success_message = $success_email = $success_name = $success_password = $success_gender = $success_location = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('./mysqli_connect.php');
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $valid_input = false;
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $valid_input = false;
        }
        if($valid_input) {
            $email_query = "SELECT email FROM Users WHERE email = "."'" .$email."'";
            $email_response = @mysqli_query($dbc, $email_query);
            if(!$email_response){
                echo "Couldn't issue database query"."<br>";
                echo mysqli_error($dbc);
            }
            if($email_response->num_rows > 0){
                $emailErr = "E-mail has been used!";
                $valid_input = false;
            }
        }
    }

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $valid_input = false;
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
            $valid_input = false;
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
        $valid_input = false;
    } else {
        $password = ($_POST["password"]);
    }

    if (empty($_POST["location"])) {
        $locationErr = "Location is required";
        $valid_input = false;
    } else {
        $location = test_input($_POST["location"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $location)) {
            $locationErr = "Only letters and white space allowed";
            $valid_input = false;
        }
    }
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
        $valid_input = false;
    } else {
        $gender = test_input($_POST["gender"]);
    }
    if ($valid_input) {
        $insert = "INSERT INTO Users (email, name, password, gender, location)". "VALUES ('".$email."','" .$name."','".$password."','".$gender."','".$location."')";
        if (!mysqli_query($dbc, $insert)) {
            echo "Error: " . $insert . "<br>" . mysqli_error($dbc);
        }
        $success_message = "<h2> Your account has been created. </h2>";
        $success_email = "E-mail: ".$email;
        $success_name = "Name: ".$name;
        $success_password = "Password: ".$password;
        $success_location = "Location: ".$location;
        $success_gender = "Gender: ".$gender;

    } else {
        $success_message = "<h2><span class=\"error\"> Failed! Check your inputs! </span></h2>";
    }
    mysqli_close($dbc);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<h2>Create new user</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
    <span class="error">* <?php echo $emailErr; ?></span>
    <br><br>
    Password: <input type="password" name="password" value="<?php echo $password; ?>">
    <span class="error">* <?php echo $passwordErr; ?></span>
    <br><br>
    Name: <input type="text" name="name" value="<?php echo $name; ?>">
    <span class="error">* <?php echo $nameErr; ?></span>
    <br><br>
    Location: <input type="text" name="location" value="<?php echo $location; ?>">
    <span class="error">* <?php echo $locationErr; ?></span>
    <br><br>
    Gender:
    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?>
           value="female">Female
    <input type="radio" name="gender" <?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="male">Male
    <span class="error">* <?php echo $genderErr; ?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form>

<?php
    echo($success_message);
    echo($success_email);
    echo("<br><br>");
    echo($success_password);
    echo("<br><br>");
    echo($success_name);
    echo("<br><br>");
    echo($success_location);
    echo("<br><br>");
    echo($success_gender);
    echo("<br><br>");
?>

</body>
</html>