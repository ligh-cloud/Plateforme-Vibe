<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Search</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center;
        }
        input {
            padding: 10px;
            width: 300px;
        }
        button {
            padding: 10px;
            margin-top: 10px;
        }
        #results {
            margin-top: 20px;
        }
        .user-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px auto;
            width: 50%;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<h2>Search for Users</h2>

<!-- Show error message if redirected -->
@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<form id="searchForm">
    <input type="text" id="searchInput" name="search" placeholder="Enter name or email">
    <button type="submit">Search</button>
</form>

<div id="results">
    <!-- Show results if they exist from redirect -->
    @if(isset($users) && count($users) > 0)
        <h3>Search Results:</h3>
        @foreach($users as $user)
            <div class="user-card">
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>
        @endforeach
    @endif
</div>

<script>
    $(document).ready(function() {
        $('#searchForm').on('submit', function(event) {
            event.preventDefault(); // Prevent page reload

            let query = $('#searchInput').val();
            if (query === '') {
                alert('Please enter a search term.');
                return;
            }

            $.ajax({
                url: "{{ route('user.search') }}",
                type: "GET",
                data: { search: query },
                success: function(response) {
                    $('#results').html('');
                    if (response.length === 0) {
                        $('#results').html('<p>No users found.</p>');
                    } else {
                        $('#results').append('<h3>Search Results:</h3>');
                        response.forEach(user => {
                            $('#results').append(`
                                    <div class="user-card">
                                        <p><strong>Name:</strong> ${user.name}</p>
                                        <p><strong>Email:</strong> ${user.email}</p>
                                    </div>
                                `);
                        });
                    }
                },
                error: function(xhr) {
                    alert(xhr.responseJSON.message || 'Error searching for users.');
                }
            });
        });
    });
</script>

</body>
</html>
