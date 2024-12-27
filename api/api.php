<?php
// Initialize cURL session
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://universities.hipolabs.com/search?country=United+States',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

// Execute the API request
$response = curl_exec($curl);

// Close cURL session
curl_close($curl);

// Decode the JSON response into an array
$data = json_decode($response, true);
?>

<!DOCTYPE html>
<html>
<head>
    <title>University Data</title>
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.table').DataTable();
        });
    </script>
</head>
<body>

<table class="table" id="universityTable">
    <thead>
        <tr>
            <th>#</th>
            <th>University Name</th>
            <th>Country</th>
            <th>Website</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if data is not empty
        if (!empty($data)) {
            $index = 1; // Counter for row numbers
            foreach ($data as $university) {
                echo "<tr>";
                echo "<td>{$index}</td>";
                echo "<td>{$university['name']}</td>";
                echo "<td>{$university['country']}</td>";
                echo "<td><a href='{$university['web_pages'][0]}' target='_blank'>Visit Website</a></td>";
                echo "</tr>";
                $index++;
            }
        } else {
            echo "<tr><td colspan='4'>No data available</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
