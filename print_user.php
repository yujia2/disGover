<?php

require_once('./mysqli_connect.php');
$query = "SELECT email, name, password, location, gender FROM Users";
$response = @mysqli_query($dbc, $query);

// If the query executed properly proceed
if ($response) {

    echo '<table align="left"
			cellspacing="5" cellpadding="8">
			<tr><td align="left"><b>E-mail</b></td>
			<td align="left"><b>Name</b></td>
			<td align="left"><b>Password</b></td>
			<td align="left"><b>Location</b></td>
            <td align="left"><b>Gender</b></td></tr>';

// mysqli_fetch_array will return a row of data from the query
// until no further data is available
    while ($row = mysqli_fetch_array($response)) {

        echo '<tr><td align="left">' .
            $row['email'] . '</td><td align="left">' .
            $row['name'] . '</td><td align="left">' .
            $row['password'] . '</td><td align="left">' .
            $row['location'] . '</td><td align="left">' .
            $row['gender'] . '</td><td align="left">' .
            '</td><td align="left">';
        echo '</tr>';
    }

    echo '</table>';

} else {

    echo "Couldn't issue database query<br />";

    echo mysqli_error($dbc);

}

// Close connection to the database
mysqli_close($dbc);

?>