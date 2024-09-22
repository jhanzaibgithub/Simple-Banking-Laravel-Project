<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Student AJAX CRUD</title>
</head>
<body>
    <h1>Student CRUD with AJAX</h1>
    <form id="studentForm">
        <?php echo csrf_field(); ?>
        <input type="text" name="name" id="name" placeholder="Name" required>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <input type="text" name="address" id="address" placeholder="Address" required>
        <input type="text" name="phone" id="phone" placeholder="Phone" required>
        <button type="submit">Add Student</button>
    </form>

    <table id="studentTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // CSRF Token setup for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Fetch and display students
            function fetchStudents() {
                $.ajax({
                    url: '/students',
                    type: 'GET',
                    success: function (data) {
                        let rows = '';
                        data.forEach(student => {
                            rows += `<tr>
                                <td>${student.name}</td>
                                <td>${student.email}</td>
                                <td>${student.details.address}</td>
                                <td>${student.details.phone}</td>
                                <td>
                                    <button class="edit-btn" data-id="${student.id}">Edit</button>
                                    <button class="delete-btn" data-id="${student.id}">Delete</button>
                                </td>
                            </tr>`;
                        });
                        $('#studentTable tbody').html(rows);
                    }
                });
            }

            fetchStudents();

            // Add student
            $('#studentForm').submit(function (e) {
                e.preventDefault();
                let formData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    address: $('#address').val(),
                    phone: $('#phone').val()
                };

                $.ajax({
                    url: '/students',
                    type: 'POST',
                    data: formData,
                    success: function (data) {
                        fetchStudents();
                    }
                });
            });

            // Delete student
            $(document).on('click', '.delete-btn', function () {
                let id = $(this).data('id');

                $.ajax({
                    url: '/students/' + id,
                    type: 'DELETE',
                    success: function (data) {
                        fetchStudents();
                    }
                });
            });

            // Edit student (add your edit logic here)
        });
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel_10_ajax_crud\resources\views/student.blade.php ENDPATH**/ ?>