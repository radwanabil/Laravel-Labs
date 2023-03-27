# Laravel Labs

Laravel Labs is a blog website built using Laravel, allowing users to create, edit, and delete posts, add comments to posts, and log in and register using GitHub and Google. The website also features validation for post titles, descriptions, and image types.

## Features

- Users can add, delete, and restore posts
- Users can add comments to posts
- Users can edit their posts
- Validation for post title, description, and image type
- Login and registration using GitHub and Google
- Follows resource naming convention for routes

## Built with

- Laravel
- MySQL

## Installation

To install the project:

1. Clone the repository:

2. Install dependencies:

3. Set up a MySQL database and update the `.env` file with the database credentials:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=[database-name]
DB_USERNAME=[database-username]
DB_PASSWORD=[database-password]

4. Run migrations:
php artisan migrate

6. Access the website at `http://localhost:8000`.

## Usage

To use the website:

1. Register using GitHub or Google.

2. Add a new post by clicking the "Add Post" button.

3. Edit or delete a post by clicking the corresponding buttons.

4. Add a comment to a post by clicking the "Add Comment" button and filling out the form.

5. Restore a deleted post by clicking the "Restore" button on the "Deleted Posts" page.

## License

The project is licensed under the [MIT License](https://opensource.org/licenses/MIT).





