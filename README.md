# To-Do List Dashboard

## Description

This is a **To-Do List Dashboard** application designed to help users efficiently manage their tasks. The app allows users to create, update, delete, and prioritize tasks. It's built with a clean and modern interface, using a combination of PHP, MySQL, and front-end technologies.

### Key Features:
- **User Authentication**: Secure sign-up and login functionalities.
- **Task Management**: Add, edit, delete, and prioritize tasks.
- **Responsive Design**: Fully responsive interface for use on mobile and desktop.
- **Search & Filter**: Quickly find tasks by name, priority, or due date.
- **Task Categories**: Organize tasks by different categories.
- **Data Persistence**: Tasks are stored securely in a MySQL database.

## Installation

### Prerequisites

Make sure you have the following software installed:
- **PHP** version 7.4 or higher
- **MySQL** or **MariaDB** for database management
- **Apache** or **Nginx** as your web server

### Steps to Set Up

1. **Clone the repository**:
   ```bash
   git clone https://github.com/Yacobel/todo-list.git
Navigate to the project directory:

bash
Copy
Edit
cd project-name
Create a .env file in the root directory for your environment variables (optional but recommended).

Set up the database:

Import the database schema using this command:

bash
Copy
Edit
mysql -u username -p < database.sql
Replace username with your MySQL username.

Configure the project:

Edit your database connection settings in config.php (or similar configuration file).

Run the application:

If you’re using Apache, navigate to the directory containing the project and run it with localhost/index.php.

Example Database Schema
sql
Copy
Edit
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE tasks (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    due_date DATE,
    priority ENUM('Low', 'Medium', 'High') DEFAULT 'Medium',
    user_id INT UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
Usage
Register: Create an account by filling in your details.

Log In: Use your credentials to access the dashboard.

Manage Tasks: Add, edit, or delete tasks. You can also set task priorities and categories.

Search and Filter: Easily search tasks by title, due date, or category.

Example PHP code for adding a task:

php
Copy
Edit
// Example: Add a new task
$task = new Task();
$task->create("Finish project", "2025-05-01", "High");
Contributing
We welcome contributions to improve this project. To contribute:

Fork the repository.

Create a new branch for your feature (git checkout -b feature-name).

Commit your changes (git commit -am 'Add feature').

Push your branch (git push origin feature-name).

Submit a Pull Request.

Code of Conduct
Please follow a respectful and collaborative approach when contributing.

License
This project is licensed under the MIT License - see the LICENSE file for details.

Acknowledgements
PHP - Server-side language for handling logic and database interaction.

MySQL - Database used to store user and task data.

Bootstrap and Tailwind CSS - Front-end frameworks used for responsive UI design.

FontAwesome - Icons used for the task dashboard.

Special thanks to contributors and community members who have helped improve the project.

Contact
For support or to reach the project maintainers:

Email: yacobelhaouarii@gmail.com

GitHub: github.com/yourusername

yaml
Copy
Edit

---

You can now simply copy the entire content of the **README.md** above and paste it into your repository's README file. Let me know if you need any adjustments!