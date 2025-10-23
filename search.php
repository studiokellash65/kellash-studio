<?php
$conn = new mysqli("localhost", "root", "", "kellash_studio");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$q = $_GET['q'] ?? '';
$sql = "SELECT * FROM songs WHERE title LIKE '%$q%' OR artist LIKE '%$q%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Search Results</title>
<link rel="stylesheet" href="style.css">
<style>
.results { display: flex; flex-wrap: wrap; justify-content: center; gap: 20px; margin-top:20px; }
.cardyanyimbo { border:1px solid #ddd; border-radius:10px; padding:15px; width:300px; text-align:center; }
.cardyanyimbo img { width:100%; height:auto; border-radius:10px; }
.btn { display:inline-block; padding:8px 15px; margin-top:10px; background:orangered; color:#fff; text-decoration:none; border-radius:5px; }
</style>
</head>
<body>
<h2 style="text-align:center;">Search Results for "<?php echo htmlspecialchars($q); ?>"</h2>

<div class="results">
<?php
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='cardyanyimbo'>";
        echo "<img src='" . htmlspecialchars($row['image']) . "' alt='cover'>";
        echo "<h3>" . htmlspecialchars($row['title']) . " - " . htmlspecialchars($row['artist']) . "</h3>";
        echo "<audio controls><source src='" . htmlspecialchars($row['audio']) . "' type='audio/mpeg'>Your browser does not support audio.</audio>";
        echo "<br><a href='" . htmlspecialchars($row['audio']) . "' download class='btn'>Download</a>";
        echo "</div>";
    }
} else {
    echo "<p style='text-align:center;'>No results found.</p>";
}
?>
if (!$result) { die("SQL Error: " . $conn->error); }

</div>
</body>
</html>
