<!DOCTYPE html>
<html>

<head>
    <title>User Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <style>
        body {
            background-image: url(a.jpg);
        }

        .edit-form,
        .delete-form {
            display: none;
        }


        .card {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .avatar {
            width: 70%;
            margin: 3vh auto;
            display: block;
        }

        .card-title,
        .card-text {
            text-align: left;
            margin-left: 1vw;
        }

        .card-columns {
            width: 50vw;
        }

        h1 {
            margin-top: 3vh;
            background-color: rgb(1, 25, 83);
            color: rgb(114, 205, 221);
            padding: 20px;
        }

        .container {
            max-width: 100%;
        }
    </style>
    <script>
        function showEditForm(id) {
            var form = document.querySelector('.edit-form[data-id="' + id + '"]');
            var siblingForms = document.querySelectorAll('.edit-form:not([data-id="' + id + '"])');
            for (var i = 0; i < siblingForms.length; i++) {
                siblingForms[i].style.display = 'none';
            }
            form.style.display = 'block';
        }

        function showDeleteForm(id) {
            var form = document.querySelector('.delete-form[data-id="' + id + '"]');
            var siblingForms = document.querySelectorAll('.delete-form:not([data-id="' + id + '"])');
            for (var i = 0; i < siblingForms.length; i++) {
                siblingForms[i].style.display = 'none';
            }
            form.style.display = 'block';
        }
    </script>
</head>

<body>

    <div class="container">

        <h1 class="text-center mb-4">User Data</h1>

        <div class="card-columns">

            <?php
            include("connection.php");

            $items_per_page = 4;
            $sql = "SELECT * FROM users";
            $result = mysqli_query($conn, $sql);
            $num_of_pages = ceil(mysqli_num_rows($result) / $items_per_page);
            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
            $start_index = ($current_page - 1) * $items_per_page;

            if (mysqli_num_rows($result) > 0) {
                $counter = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($counter >= $start_index && $counter < $start_index + $items_per_page) {
                        ?>

                        <div class="card mb-3">
                            <img class="avatar" src="a.jpg">
                            <div class="card-body">

                                <h5 class="card-title">
                                    <?= $row['username'] ?>
                                </h5>
                                <p class="card-text"><strong>Email:</strong>
                                    <?= $row['email'] ?>
                                </p>
                                <p class="card-text"><strong>Role:</strong>
                                    <?= $row['usertype'] ?>
                                </p>
                                <button class="btn btn-info mr-2" onclick="showEditForm(<?= $row['id'] ?>)">Edit</button>
                                <button class="btn btn-danger" onclick="showDeleteForm(<?= $row['id'] ?>)">Delete</button>
                            </div>
                        </div>

                        <form class="edit-form" id="edit-form" method="POST" action="edit-data.php?id=<?= $row['id'] ?>"
                            data-id="<?= $row['id'] ?>">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?= $row['username'] ?>
                                    </h5>
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="<?= $row['username'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            value="<?= $row['email'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role:</label>
                                        <input type="text" class="form-control" id="role" name="role"
                                            value="<?= $row['usertype'] ?>">
                                    </div>
                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                    <button type="button" class="btn btn-danger" onclick="closeForm()">Close</button>
                                </div>
                            </div>
                        </form>

                        <form class="delete-form" method="POST" action="delete-data.php?id=<?= $row['id'] ?>"
                            data-id="<?= $row['id'] ?>">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Delete User</h5>
                                    <p class="card-text">Are you sure you want to delete the user <strong>
                                            <?= $row['username'] ?>
                                        </strong>?</p>
                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                </div>
                            </div>
                        </form>
                        <script>
                            // Add an event listener to the close button in the edit form
                            document.querySelector('#edit-form .close').addEventListener('click', function () {
                                // Hide the edit form
                                document.querySelector('#edit-form').style.display = 'none';
                            });

                            function showEditForm(id) {
                                // Hide other edit forms
                                document.querySelectorAll('.edit-form').forEach(function (form) {
                                    if (form.dataset.id != id) {
                                        form.style.display = 'none';
                                    }
                                });

                                // Show the selected edit form
                                var form = document.querySelector('.edit-form[data-id="' + id + '"]');
                                form.style.display = 'block';

                                // Clear any validation errors in the form
                                form.querySelectorAll('.is-invalid').forEach(function (input) {
                                    input.classList.remove('is-invalid');
                                    var feedback = input.nextElementSibling;
                                    if (feedback.classList.contains('invalid-feedback')) {
                                        feedback.remove();
                                    }
                                });
                            }
                        </script>

                        <?php
                    }
                    $counter++;
                }

                echo '<ul class="pagination justify-content-center">';
                for ($i = 1; $i <= $num_of_pages; $i++) {
                    echo '<nav aria-label="Page navigation example">';
                    echo '<ul class="pagination justify-content-end">';

                    if ($current_page > 1) {
                        echo '<li class="page-item">';
                        echo '<a class="page-link" href="?page=' . $current_page - 1 . '" tabindex="-1">Previous</a>';
                        echo '</li>';
                    } else {
                        echo '<li class="page-item disabled">';
                        echo '<a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>';
                        echo '</li>';
                    }

                    for ($i = 1; $i <= $num_of_pages; $i++) {
                        echo '<li class="page-item';
                        if ($current_page == $i) {
                            echo ' active';
                        }
                        echo '">';
                        echo '<a class="page-link" href="?page=' . $i . '">' . $i . '</a>';
                        echo '</li>';
                    }

                    if ($current_page < $num_of_pages) {
                        echo '<li class="page-item">';
                        echo '<a class="page-link" href="?page=' . $current_page + 1 . '">Next</a>';
                        echo '</li>';
                    } else {
                        echo '<li class="page-item disabled">';
                        echo '<a class="page-link" href="#" aria-disabled="true">Next</a>';
                        echo '</li>';
                    }

                    echo '</ul>';
                    echo '</nav>';
                }
                echo '</ul>';

            } else {
                echo 'No data found.';
            }

            mysqli_close($conn);
            ?>

        </div>

    </div>

</body>

</html>