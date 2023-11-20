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
        <div class="card">
            <div class="card-body">
                <form action="./actions/news_publish.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea type="text" name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Cover</label>
                        <input type="file" name="cover" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="content" style="display:none"></textarea>
                        <div id="editor"></div>
                    </div>
                    <div class="d-flex align-items-center justify-content-end">
                        <button class="btn btn-sm btn-primary">Publish</button>
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
    quill.on('text-change', function(delta, oldDelta, source) {
        document.querySelector("textarea[name=content]").innerHTML = quill.root.innerHTML;
    });
    </script>
</body>

</html>