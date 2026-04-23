<?php

namespace App\Controllers;

use App\Models\BookModel;

class Books extends BaseController
{
    public function index()
    {
        $bookModel = new BookModel();
        $search = $this->request->getGet('q');

        if ($search) {
            $books = $bookModel
                ->like('title', $search)
                ->orLike('author', $search)
                ->findAll();
        } else {
            $books = $bookModel->findAll();
        }

        return view('books/index', [
            'books' => $books,
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('books/create');
    }

    public function store()
    {
        $rules = [
            'title' => 'required',
            'author' => 'required',
            'publication_year' => 'required|integer',
            'image' => 'permit_empty|is_image[image]|max_size[image,2048]',
        ];

        if (! $this->validate($rules)) {
            return view('books/create', [
                'validation' => $this->validator
            ]);
        }

        $imageName = null;
        $imageFile = $this->request->getFile('image');

        if ($imageFile && $imageFile->isValid() && ! $imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads/books', $imageName);
        }

        $bookModel = new BookModel();

        $bookModel->save([
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'genre' => $this->request->getPost('genre'),
            'publication_year' => $this->request->getPost('publication_year'),
            'image' => $imageName,
        ]);

        return redirect()->to('/books')->with('success', 'Book added successfully.');
    }

    public function edit($id)
    {
        $bookModel = new BookModel();
        $book = $bookModel->find($id);

        if (! $book) {
            return redirect()->to('/books')->with('error', 'Book not found.');
        }

        return view('books/edit', ['book' => $book]);
    }

    public function update($id)
    {
        $bookModel = new BookModel();
        $book = $bookModel->find($id);

        if (! $book) {
            return redirect()->to('/books')->with('error', 'Book not found.');
        }

        $rules = [
            'title' => 'required',
            'author' => 'required',
            'publication_year' => 'required|integer',
            'image' => 'permit_empty|is_image[image]|max_size[image,2048]',
        ];

        if (! $this->validate($rules)) {
            return view('books/edit', [
                'book' => $book,
                'validation' => $this->validator
            ]);
        }

        $imageName = $book['image'];
        $imageFile = $this->request->getFile('image');

        if ($imageFile && $imageFile->isValid() && ! $imageFile->hasMoved()) {
            $newImageName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'uploads/books', $newImageName);

            if (! empty($book['image']) && file_exists(FCPATH . 'uploads/books/' . $book['image'])) {
                unlink(FCPATH . 'uploads/books/' . $book['image']);
            }

            $imageName = $newImageName;
        }

        $bookModel->update($id, [
            'title' => $this->request->getPost('title'),
            'author' => $this->request->getPost('author'),
            'genre' => $this->request->getPost('genre'),
            'publication_year' => $this->request->getPost('publication_year'),
            'image' => $imageName,
        ]);

        return redirect()->to('/books')->with('success', 'Book updated successfully.');
    }

    public function delete($id)
    {
        $bookModel = new BookModel();
        $book = $bookModel->find($id);

        if (! $book) {
            return redirect()->to('/books')->with('error', 'Book not found.');
        }

        if (! empty($book['image']) && file_exists(FCPATH . 'uploads/books/' . $book['image'])) {
            unlink(FCPATH . 'uploads/books/' . $book['image']);
        }

        $bookModel->delete($id);

        return redirect()->to('/books')->with('success', 'Book deleted successfully.');
    }
}