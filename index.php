<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Bootstrap Modal CRUD</title>
    <!-- Botstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="completename" class="form-label">Name</label>
                        <input type="text" class="form-control" id="completename" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="completemail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="completemail" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="completemobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="completemobile" placeholder="Enter your mobile number">
                    </div>
                    <div class="mb-3">
                        <label for="completeplace" class="form-label">Place</label>
                        <input type="text" class="form-control" id="completeplace" placeholder="Enter your place">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="adduser()">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="updatename" class="form-label">Name</label>
                        <input type="text" class="form-control" id="updatename" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="updateemail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="updateemail" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="updatemobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="updatemobile" placeholder="Enter your mobile number">
                    </div>
                    <div class="mb-3">
                        <label for="updateplace" class="form-label">Place</label>
                        <input type="text" class="form-control" id="updateplace" placeholder="Enter your place">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark">Update</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <input type="hidden" id="hiddendata">
                </div>
            </div>
        </div>
    </div>

    <div class="container my-3">
        <h1 class="text-center">PHP CRUD operating using Bootstrap Modal</h1>
        <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#completeModal">
            Add new users
        </button>
        <div id="displayDataTable"></div>
    </div>
    <!-- bootstrap JavaScrip -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            displayData();
        })

        //display function
        function displayData() {
            var displayData = "true";
            $.ajax({
                url: "display.php",
                type: 'post',
                data: {
                    displaySend: displayData
                },
                success: function(data, status) {
                    $('#displayDataTable').html(data);
                }
            });
        };

        function adduser() {
            var nameAdd = $('#completename').val()
            var emailAdd = $('#completemail').val()
            var mobileAdd = $('#completemobile').val()
            var placeAdd = $('#completeplace').val()

            $.ajax({
                url: "insert.php",
                type: 'post',
                data: {
                    nameSend: nameAdd,
                    emailSend: emailAdd,
                    mobileSend: mobileAdd,
                    placeSend: placeAdd,
                },
                success: function(data, status) {
                    // function to display data;
                    displayData();
                }
            })
        }

        // Delete record

        function DeleteUser(deleteid) {
            $.ajax({
                url: "delete.php",
                type: 'post',
                data: {
                    deletesend: deleteid
                },
                success: function(data, status) {
                    displayData();
                }
            });
        }

        // Update function

        function GetDetails(updateid) {
            $('#hiddendata').val(updateid);

            $.post("update.php", {
                    updateid: updateid
                },
                function(data, status) {
                    var userid = JSON.parse(data);
                    $('#updatename').val(userid.name);
                    $('#updateemail').val(userid.email);
                    $('#updatemobile').val(userid.mobile);
                    $('#updateplace').val(userid.place);
                });
            $('#updateModal').modal('show');
        }
    </script>
</body>

</html>