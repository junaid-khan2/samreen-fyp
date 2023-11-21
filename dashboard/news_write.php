<?php

include("../init.php");
$page_title = "Write News - Dashboard"
?>

<html>

<?php include("../layout/head.php"); ?>

<body class="dashboard-layout">
    <?php include("../layout/dashboard_sidebar.php"); ?>
    <div class="page-content">
        <div class="page-header">
            <h2 class="page-title">Write a News</h2>
        </div>
              <!-- Bootstrap Alert for Success -->
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert" style="display: none;">
            <strong>Success!</strong> News created successfully.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="card">
            <div class="card-body">
                <form id="newsForm" action="./actions/news_publish.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" id="title" class="form-control">
                        <div id="titleError" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="description" id="description" class="form-control"></textarea>
                        <div id="descriptionError" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label>Cover</label>
                        <input type="file" name="cover" id="cover" class="form-control">
                        <div id="coverError" class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="content" id="content" style="display:none"></textarea>
                        <div id="editor"></div>
                        <div id="contentError" class="invalid-feedback"></div>
                    </div>
                    <div class="d-flex align-items-center justify-content-end">
                        <button type="button" class="btn btn-sm btn-primary" id="publishBtn">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        quill.on('text-change', function (delta, oldDelta, source) {
            document.querySelector("textarea[name=content]").innerHTML = quill.root.innerHTML;
        });

        // Event handler for the Publish button
        $('#publishBtn').click(function () {
            // Validate the form before submitting
            $.ajax({
                type: "POST",
                url: $("#newsForm").attr("action"),
                data: new FormData($("#newsForm")[0]),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json", // Expect JSON response from the server
                success: function (response) {
                    // Check for validation errors in the response
                    if (response.success) {
                        // If the form is valid, submit it
                       
                     
                        $("#success-alert").show();
                        // Reload the page after 3 seconds
                        setTimeout(function () {
                            window.location.href = './news.php';
                        }, 3000);

                    } else {
                        // Clear previous error messages and classes
                        $(".form-control").removeClass("is-invalid");
                        $(".invalid-feedback").empty();

                        // Display validation errors next to corresponding form fields
                        $.each(response.errors, function (key, value) {
                            if (value != null) {
                                $("#" + key).addClass("is-invalid");
                                $("#" + key + "Error").html(value);
                                $("#" + key + "Error").show(); // Show the invalid-feedback div
                            }
                        });

                        // Log the error messages to the console
                        console.error(response.errors);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX request failed:", status, error);
                }
            });
        });
    </script>
</body>

</html>
