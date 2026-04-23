<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Books</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="page-container">
        <div class="card">
            <h1>List of Books</h1>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="message success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="message error">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div class="top-bar">
                <a href="/books/create" class="btn">+ Add Book</a>
            </div>

            <form method="get" action="/books" class="search-form">
                <input
                    type="text"
                    name="q"
                    class="search-input"
                    placeholder="Search by title or author"
                    value="<?= esc($search ?? '') ?>"
                >
                <button type="submit">Search</button>
            </form>

            <table>
                <tr>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Publication Year</th>
                    <th>Actions</th>
                </tr>

                <?php if (!empty($books)): ?>
                    <?php foreach ($books as $book): ?>
                        <tr>
                            <td>
                                <?php if (!empty($book['image'])): ?>
                                    <img src="<?= base_url('uploads/books/' . $book['image']) ?>" alt="Book Cover" class="cover-img">
                                <?php else: ?>
                                    <img src="<?= base_url('images/placeholder.png') ?>" alt="Placeholder" class="cover-img">
                                <?php endif; ?>
                            </td>
                            <td><?= esc($book['title']) ?></td>
                            <td><?= esc($book['author']) ?></td>
                            <td><?= esc($book['genre']) ?></td>
                            <td><?= esc($book['publication_year']) ?></td>
                            <td class="actions">
                                <a href="/books/edit/<?= $book['id'] ?>" class="edit-link">Edit</a>
                                <a href="/books/delete/<?= $book['id'] ?>"
                                   class="delete-link"
                                   onclick="return confirm('Delete this book? This action cannot be undone.');">
                                   Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="empty-state">
                            No books yet. Click "Add Book" to get started!
                        </td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>
</html>