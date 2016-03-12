<?php

require_once('./mysqli_connect.php');
$query = "SELECT title, runtime, rated, metascore FROM Movies";
$response = @mysqli_query($dbc, $query);

// If the query executed properly proceed
if ($response) {

    echo '<table align="left"
			cellspacing="5" cellpadding="8">
			<tr><td align="left"><b>title</b></td>
			<td align="left"><b>time</b></td>
			<td align="left"><b>rated</b></td>
			<td align="left"><b>metascore</b></td></tr>';

// mysqli_fetch_array will return a row of data from the query
// until no further data is available
    while ($row = mysqli_fetch_array($response)) {

        echo '<tr><td align="left">' .
            $row['title'] . '</td><td align="left">' .
            $row['runtime'] . '</td><td align="left">' .
            $row['rated'] . '</td><td align="left">' .
            $row['metascore'] . '</td><td align="left">' .
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