<?php
include("./init.php");


$event_id = $_GET["id"];

/// Fetch Event Detail
$event = $database->prepare("SELECT * FROM events WHERE id=:id");
$event->execute([':id' => $event_id]);
$event = $event->fetch();


$page_title = $event["title"]." - Events";


/// Fetch Event News
$news = $database->prepare("SELECT * FROM news WHERE event_id=:id");
$news->execute([':id' => $event_id]);
$news = $news->fetchAll();




?>

<html>

<?php include("layout/head.php"); ?>

<body class="home-layout">
    <?php include("layout/header.php"); ?>
    <div class="page-content">
        
        <section style="margin-top:1em">
            <h1><?= $event["title"]; ?></h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="./events.php">Events</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?= $event["title"]; ?></li>
                </ol>
              </nav>
            <div class="row align-items-center">
                <div class="col-md-6">
                    
                    
                    <p><?= $event["description"] ?></p>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#event-register">Register
                        Now</button>
                </div>
                <div class="col-md-6">
                    <img src="./assets/covers/<?= $event["cover"] ?>"
                        style="width:100%;height: 100%;border-radius:10px;">
                </div>
            </div>
        </section>


        <?php if (!empty($news)): ?>
        <section style="margin-top: 5em">
            <h3>Event News</h3>
            <div class="news-grid">
                <?php foreach ($news as $n): ?>
                <div class="news-card">
                    <img class="cover" src="./assets/covers/<?= $n["cover"] ?>" />
                    <h5 class="title">
                        <?= $n["title"] ?>
                    </h5>
                    <p><?= $n["description"] ?></p>
                    <a href="./news_view.php?id=<?= $n["id"]; ?>" class="btn btn-sm btn-primary">Read More</a>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

    </div>


   <!-- Modal -->
<div class="modal fade" id="event-register" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form id="registrationForm" action="./event_register.php?event_id=<?= $event_id ?>" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" id="name">
                    <div id="name-error" class="invalid-feedback" style="display: none;"></div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" id="email">
                    <div id="email-error" class="invalid-feedback" style="display: none;"></div>
                </div>
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" name="phone_number" class="form-control" id="phone_number">
                    <div id="phone_number-error" class="invalid-feedback" style="display: none;"></div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" id="registerBtn" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
</div>
</div>
<script>
    $(document).ready(function () {
        // Handle form submission via AJAX
        $("#registerBtn").on("click", function () {
            $.ajax({
                type: "POST",
                url: $("#registrationForm").attr("action"),
                data: $("#registrationForm").serialize(),
                dataType: "json", // Expect JSON response from the server
                success: function (response) {
                    // Check for validation errors in the response
                    if (response.success) {
                        // If registration is successful, close the modal or perform any other actions
                        $("#event-register").modal("hide");
                    } else {
                        // Clear previous error messages and classes
                        $(".form-control").removeClass("is-invalid");
                        $(".invalid-feedback").empty();

                        // Display validation errors next to corresponding form fields
                        $.each(response.errors, function (key, value) {
                            console.log(key +":"+ value);
                            if(value != null){
                                $("#" + key).addClass("is-invalid");
                                $("#" + key + "-error").html(value);
                                $("#" + key + "-error").show(); // Show the invalid-feedback div
                            }
                     
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX request failed:", status, error);
                }
            });
        });
    });
</script>



</body>


</html>