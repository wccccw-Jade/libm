# Manage Library Books

A simple CRUD web application built with CodeIgniter for managing library books.

## Features

- Add a new book
- View all books
- Edit an existing book
- Delete a book
- Server-side form validation
- Optional book cover image upload

## Tech Stack

- PHP
- CodeIgniter 4
- MySQL
- Git/GitHub

## Setup Instructions

1. Clone the repository
2. Run `composer install`
3. Copy `env` to `.env`
4. Configure database settings in `.env`
5. Create the database
6. Run `php spark migrate`
7. Start the local server with `php spark serve`
8. Open the website from `http://localhost:8080`

## Database Fields

- title
- author
- genre
- publication_year
- image (optional)

## Validation Rules

- title is required
- author is required
- publication_year is required and must be an integer

## Design Decisions

- Used MVC structure to separate logic, data access, and views
- Used migrations to simplify setup on a new machine
- Kept genre optional because the assignment only requires title, author, and publication year
- Used flash messages after create, update, and delete actions
- Added delete confirmation on the list page for safer record removal
- Stored only the image filename in the database for optional image upload
