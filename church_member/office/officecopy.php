<?php
// Include the database connection file
include "connection.php";
// Set the number of items per page and current page number
$items_per_page = 10;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Get the total number of items in the table
$total_items = 100;

// Calculate the number of pages
$total_pages = ceil($total_items / $items_per_page);

// Calculate the starting item for the current page
$start_item = ($current_page - 1) * $items_per_page;

function fetch_data_from_database($start, $limit)
{


    // Build the SQL query to fetch data from the office table
    $sql = "SELECT * FROM office LIMIT $start, $limit";

}
// Generate the table headers
echo '<table>';
echo '<thead>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Name</th>';
echo '<th>Age</th>';
echo '</tr>';
echo '</thead>';

// Generate the table rows
echo '<tbody>';
foreach ($data as $item) {
    echo '<tr>';
    echo '<td>' . $item['id'] . '</td>';
    echo '<td>' . $item['name'] . '</td>';
    echo '<td>' . $item['age'] . '</td>';
    echo '</tr>';
}
echo '</tbody>';

echo '</table>';

// Generate the pagination links
echo '<div class="pagination">';
echo '<ul>';

// Generate the "Previous" link if not on the first page
if ($current_page > 1) {
    echo '<li><a href="?page=' . ($current_page - 1) . '">Previous</a></li>';
}

// Generate the numbered page links
for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $current_page) { // Highlight the current page
        echo '<li class="active"><a href="?page=' . $i . '">' . $i . '</a></li>';
    } else {
        echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
    }
} // Generate the "Next" link if not on the last page 
if ($current_page < $total_pages) {
    echo '<li><a href="?page=' . ($current_page + 1)
        . '">Next</a></li>';
}
echo '</ul>';
echo '</div>';
?>