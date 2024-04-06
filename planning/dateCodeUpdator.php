<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DateCodeUpdator</title>
    <!-- Add jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php 
    // Include your database connection file
    include_once '../phpCon/SqlHandlerMesAtec.php';
    
    // Query to fetch data
    $sql = "SELECT top 20 LOTNUMBER , ProcessTypeCode, PONumber, LotQty, CommitDate
    FROM PL_ProductionOrder
    WHERE CustomerCode = 55 and ProcessTypeCode = 1
    Order By PoCode desc";

    // Execute the query
    $results = executeSQLQuery($sql);

    // Check if there are results
    if (!empty($results)) {
        echo "<table class='table'>";
        echo "<thead><tr><th>LOTNUMBER</th><th>ProcessTypeCode</th><th>PONumber</th><th>LotQty</th><th>CommitDate</th><th>Action</th></tr></thead><tbody>";

        // Loop through each row in the results
        foreach ($results as $row) {
            echo "<tr>";
            echo "<td>" . $row['LOTNUMBER'] . "</td>";
            echo "<td>" . $row['ProcessTypeCode'] . "</td>";
            echo "<td>" . $row['PONumber'] . "</td>";
            echo "<td>" . $row['LotQty'] . "</td>";
            // Convert the DateTime object to a formatted string
            echo "<td>" . $row['CommitDate']->format('Y-m-d H:i:s') . "</td>";
            // Add button to edit CommitDate
            echo "<td><button class='btn btn-primary edit-lot' data-lotnumber='" . $row['LOTNUMBER'] . "' data-toggle='modal' data-target='#editModal'>Edit</button></td>";
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "No data found.";
    }
    ?>

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

    <script>
    $(document).ready(function(){
    // Handle click event for edit button
    $(document).on('click', '.edit-lot', function() {
        var lotnumber = $(this).data('lotnumber'); // Corrected variable name
        $('#lot').val(lotnumber);
    });
    
    // Handle click event for save button
    $('#save').click(function() {
        var lotnumber = $('#lot').val(); // Corrected variable name

        $.ajax({
            url: 'connection.php',
            method: 'post',
            data: { lotnumber: lotnumber }, // Corrected parameter name
            success: function(response) {
                console.log(response);
                location.reload(); // Reload the page after successful update
            },
            error: function(xhr, status, error) {
                console.error('Error updating lot number:', error);
                alert('Error updating lot number. Please try again.');
            }
        });
    });
});
    </script>
</body>
</html>
