<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="page-container">
        <div class="card">
            <h1>Edit Book</h1>

            <?php if (isset($validation)): ?>
                <div class="message error validation-errors">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>

            <form action="/books/update/<?= $book['id'] ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="<?= old('title', $book['title']) ?>">
                </div>

                <div class="form-group">
                    <label>Author</label>
                    <input type="text" name="author" value="<?= old('author', $book['author']) ?>">
                </div>

                <div class="form-group">
                    <label>Genre</label>
                    <input type="text" name="genre" value="<?= old('genre', $book['genre']) ?>">
                </div>

                <div class="form-group">
                    <label>Publication Year</label>
                    <input type="number" name="publication_year" value="<?= old('publication_year', $book['publication_year']) ?>">
                </div>

                <div class="form-group">
                    <label>Current Cover</label>
                    <div class="current-cover">
                        <?php if (!empty($book['image'])): ?>
                            <img src="<?= base_url('uploads/books/' . $book['image']) ?>" alt="Book Cover" class="cover-img">
                        <?php else: ?>
                            <img src="<?= base_url('images/placeholder.png') ?>" alt="Placeholder" class="cover-img">
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label>Upload New Cover</label>
                    <input type="file" name="image" accept="image/*">
                </div>

                <button type="submit">Update</button>
            </form>

            <a href="/books" class="back-link">← Back to List</a>
        </div>
    </div>
</body>
</html>