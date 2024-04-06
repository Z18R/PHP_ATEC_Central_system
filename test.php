<?php
// Include your database connection file
include_once 'phpCon/SqlHandlerMesAtec.php';


// Check if the form is submitted and the lotnumber parameter is set
if (isset($_POST['lotnumber'])) {
    // Get the lotnumber value from the POST parameters
    $lotnumber = $_POST['lotnumber'];

    // Perform the database update
    $updateResult = executeSQLUpdate("UPDATE PL_ProductionOrder SET lotnumber = ? WHERE LotNumber = ?", array($lotnumber, $lotnumber));

    if ($updateResult === true) {
        echo "Lot number updated successfully!";
    } else {
        echo "Error updating lot number: " . $updateResult;
    }
}

// Query to fetch data
$sql = "SELECT top 20 LOTNUMBER , ProcessTypeCode, PONumber, LotQty, CommitDate
FROM PL_ProductionOrder
WHERE CustomerCode = 55 and ProcessTypeCode = 1
Order By PoCode desc";

// Execute the query
$results = executeSQLQuery($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DateCodeUpdator</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Date Code Updator</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>LOTNUMBER</th>
                    <th>ProcessTypeCode</th>
                    <th>PONumber</th>
                    <th>LotQty</th>
                    <th>CommitDate</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through each row in the results
                foreach ($results as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['LOTNUMBER'] . "</td>";
                    echo "<td>" . $row['ProcessTypeCode'] . "</td>";
                    echo "<td>" . $row['PONumber'] . "</td>";
                    echo "<td>" . $row['LotQty'] . "</td>";
                    echo "<td>" . $row['CommitDate']->format('Y-m-d H:i:s') . "</td>";
                    // Add button to edit LotNumber
                    echo "<td><button class='btn btn-primary edit-lot' data-lotnumber='" . $row['LOTNUMBER'] . "' data-toggle='modal' data-target='#editModal'>Edit</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Edit Lot Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Lot Number</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="lot">Lot Number:</label>
                        <input type="text" class="form-control" id="lot">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save">Save changes</button>
                </div>
            </div>
        </div>
    </div>

<!-- Add jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        // Handle click event for edit button
        $(document).on('click', '.edit-lot', function () {
            var lotnumber = $(this).data('lotnumber');
            $('#lot').val(lotnumber);
        });

        // Handle click event for save button
        $('#save').click(function () {
            var lotnumber = $('#lot').val();

            $.ajax({
                url: window.location.href, // Same page URL
                method: 'post',
                data: { lotnumber: lotnumber },
                success: function (response) {
                    alert(response);
                    location.reload(); // Reload the page after successful update
                },
                error: function (xhr, status, error) {
                    console.error('Error updating lot number:', error); // Log error to console
                    alert('Error updating lot number. Please try again.');
                }
            });
        });
    });
</script>

</body>
</html>
