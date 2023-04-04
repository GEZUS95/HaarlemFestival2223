<?php
include_once __DIR__ . '/../admin-header.php';
?>

<h1>Update Content Page</h1>
<form method="post" action="/admin/events/update/<?= $event->getId() ?>" class="form-horizontal">
    <div class="form-group">
        <label for="title" class="col-4 col-form-label">Title</label>
        <div class="col-8">
            <input id="title" name="title"
                   placeholder="Please fill in the title of this page"
                   type="text" aria-describedby="titleHelpBlock"
                   class="form-control" required="required" value="<?= $event->getTitle() ?>">
            <span id="titleHelpBlock" class="form-text text-muted">Please fill in the title of this event</span>
        </div>
    </div>
    <div class="form-group">
        <label for="body" class="col-4 col-form-label">Body</label>
        <div class="col-8">
            <textarea id="body"
                      name="body"
                      cols="40" rows="25"
                      class="form-control"
                      aria-describedby="bodyHelpBlock"
                      required="required">
                <?= $event->getDescription() ?>
            </textarea>
            <span id="bodyHelpBlock" class="form-text text-muted">Please put the content of the event here</span>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Update Page</button>
            <a href="/admin/events" class="btn btn-danger">Go back</a>
        </div>
    </div>
</form>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#body',
        plugins: 'image',
        menubar: 'insert',
        image_uploadtab: 'upload',
        images_upload_url: '/upload/uploadImage',
    });
</script>
