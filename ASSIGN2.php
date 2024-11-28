<?php
//Task 1:Data Retrival 

//Link to fetch data from the Bahrain Open Data Portal API
$url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";


$response = file_get_contents($url);

if ($response === FALSE) {
    die("Error: Unable to fetch API data.");
}

//JSON Decode
$data = json_decode($response, true);

//If condition if there is no data availablr to fetch
if (!$data || !isset($data['results'])) {
    die("No data available");
}

//Task 2: Data Visualization

echo "<!DOCTYPE html>";
echo "<html lang='en'>";
echo "<head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Assignment 2</title>
       <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css'>
       
      </head>";
echo "<body>";
echo "<main class='container'>";
echo "<h1>Comprehensive View of Student Demographics at the University of Bahrain</h1>";

//HTML table to display the retreived data
echo "<table>";
echo "<thead data-theme='light'>
        <tr>
            <th>Year</th>
            <th>Semester</th>
            <th>The Programs</th>
            <th>Nationality</th>
            <th>Colleges</th>
            <th>Number of Students</th>
        </tr>
      </thead>";
echo "<tbody>";

foreach ($data['results'] as $record) {
    echo "<tr>
            <td>" . htmlspecialchars($record['year'] ) . "</td>
            <td>" . htmlspecialchars($record['semester']) . "</td>
            <td>" . htmlspecialchars($record['the_programs']) . "</td>
            <td>" . htmlspecialchars($record['nationality']) . "</td>
            <td>" . htmlspecialchars($record['colleges'] ) . "</td>
            <td>" . htmlspecialchars($record['number_of_students']) . "</td>
          </tr>";
}

echo "</tbody>";
echo "</table>";
echo "</main>";
echo "</body>";
echo "</html>";
?>