<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

</head>
<body>

    <div class="container">
        <h1 class="my-4">Student List</h1>
        <button id="add-student-btn" class="btn btn-primary mb-3">Add Student</button>

        <!-- DataTable -->
        <table id="students-table" class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be loaded here via AJAX -->
            </tbody>
        </table>

        <!-- Add/Edit Student Modal -->
        <div class="modal fade" id="student-modal" tabindex="-1" role="dialog" aria-labelledby="student-modal-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="student-modal-label">Add/Edit Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="student-form">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" id="student-id">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" name="address" id="address" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone:</label>
                                <input type="text" class="form-control" name="phone" id="phone" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#students-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '<?php echo e(route('students.index')); ?>', // Adjust route name as needed
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'address', name: 'address' },
                    { data: 'phone', name: 'phone' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ]
            });

            // Handle Edit and Delete button clicks
            $('#students-table').on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                alert('Edit student with ID: ' + id);
                // Add your edit logic here
            });

            $('#students-table').on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                alert('Delete student with ID: ' + id);
                // Add your delete logic here
            });
            $('#add-student-btn').on('click', function() {
                $('#student-id').val('');
                $('#student-form')[0].reset();
                $('#student-modal-label').text('Add Student');
                $('#student-modal').modal('show');
            });

            $('#student-form').on('submit', function(e) {
                e.preventDefault();
                var studentId = $('#student-id').val();
                var url = studentId ? `/students/${studentId}` : '<?php echo e(route('students.store')); ?>';
                var method = studentId ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#student-modal').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(response) {
                        console.error('Error:', response);
                    }
                });
            });

            $('#students-table').on('click', '.edit-btn', function() {
                var studentId = $(this).data('id');
                $.get(`/students/${studentId}`, function(data) {
                    $('#student-id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#address').val(data.address);
                    $('#phone').val(data.phone);
                    $('#student-modal-label').text('Edit Student');
                    $('#student-modal').modal('show');
                });
            });

            $('#students-table').on('click', '.delete-btn', function() {
                var studentId = $(this).data('id');
                if (confirm('Are you sure you want to delete this student?')) {
                    $.ajax({
                        url: `/students/${studentId}`,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                        },
                        success: function(response) {
                            table.ajax.reload();
                        },
                        error: function(response) {
                            console.error('Error:', response);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel_10_ajax_crud\resources\views/students/index.blade.php ENDPATH**/ ?>