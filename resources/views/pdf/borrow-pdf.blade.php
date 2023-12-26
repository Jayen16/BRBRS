<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Borrow History</title>
    <!-- Any necessary stylesheets or CSS -->
    <style>
        /* Define your styles for the table, etc. */
    </style>
</head>
<body>
    <h1>Borrow History</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Borrower ID</th>
                <th>Borrow Status</th>
                <th>Created At</th>
                <!-- Add other table headers based on your BorrowHistory fields -->
            </tr>
        </thead>
        <tbody id="borrowHistoryBody">
            <!-- Table rows will be populated dynamically here -->
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('fetchBorrowHistory') }}",
                type: 'GET',
                success: function(response) {
                    var tableBody = $('#borrowHistoryBody');
                    $.each(response, function(index, data) {
                        tableBody.append(
                            `<tr>
                                <td>${data.book_id}</td>
                                <td>${data.title}</td>
                                <td>${data.borrower_id}</td>
                                <td>${data.borrow_status}</td>
                                <td>${data.created_at}</td>
                                <!-- Add other table data based on your BorrowHistory fields -->
                            </tr>`
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
    
        });
    </script>
</body>
</html>
