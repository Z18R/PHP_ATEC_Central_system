// Include jQuery UI Datepicker -->
    $(document).ready(function() {
        $("#loadContent").click(function(event) {
            event.preventDefault(); // Prevent default button behavior (form submission)
            $("#ajaxContent").load("tscHelp.txt"); // Load the content from sample.txt into the element with the ID "ajaxContent"
        });
    });

    // Initialize Datepicker
    $(document).ready(function() {
        $("#dateformat").datepicker({
            dateFormat: 'yy-mm-dd' // Default date format
        });
    });

    // Confirm update before submission
    $(document).on('submit', '.update-form', function() {
        var newDate = $(this).find('#newdate').val();
        return confirm('Please Send Screen Shot first before Updating. Are you sure about updating the date to ' + newDate + '? if done please Send the SS to the IT' );
    });
