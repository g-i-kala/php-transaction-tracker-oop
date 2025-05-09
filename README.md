# Transaction File Importer

**Status: In Development**

Welcome to the **Transaction File Importer** project, which is currently in development. This
application aims to demonstrate my PHP OOP and MVC skills by allowing users to upload CSV files
containing financial transactions, store them in a database, and display them in a user-friendly
format.

## Overview

This application is being developed to allow users to upload CSV files containing financial
transactions. The transactions will be stored in a database and displayed on a webpage with
color-coded entries for easy identification of income and expenses.

## Features

- [ ] File Upload: Users can upload CSV files containing transaction data.
- [ ] Database Storage: Transactions are stored in a MySQL database for persistent storage.
- [ ] MVC Architecture: The project is structured using the Model-View-Controller pattern.
- [ ] OOP Principles: Demonstrates encapsulation, inheritance, and polymorphism.
- [ ] Transaction Display: Transactions are displayed with color-coded income and expenses.
- [ ] Date Formatting: Transaction dates are formatted for readability (e.g., "Jan 4, 2021").
- [ ] User Authentication: Implement user login and registration.
- [ ] Export Transactions: Allow users to export transactions to a CSV file.
- [ ] Multiple File Uploads: Supports uploading multiple CSV files simultaneously.

## Technical Details

- **PHP 8**: Utilizes the latest features and improvements in PHP 8.
- **MySQL**: Stores transaction data in a relational database.
- **Docker Support**: Easily set up and run the application using Docker.
- **Environment Configuration**: Utilizes a `.env` file for easy configuration of database
  connections and other environment-specific settings.

## Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/g-i-kala/php-transaction-tracker-oop.git
   ```
2. **Set Up Environment**:
   - Copy `.env.example` to `.env` and fill in the necessary details.
3. **Run the Application**:
   - Using Docker:
     ```bash
     cd docker
     docker-compose up -d
     ```
   - Using XAMPP or similar: Ensure Apache, PHP, and MySQL are running.
4. **Access the Application**:
   - Visit `http://localhost:8000` in your web browser.

## Learning Foundation

This project is based on the boilerplate from
[Gio Ggelashvili's PHP course](https://github.com/ggelashvili/learnphptherightway-project), which I
consider one of the best, if not the best, out there. The course provided an excellent foundation in
modern PHP practices and guided me through building this application.

## Why This Project is Impressive

- **Demonstrates Modern PHP Practices**: Utilizes PHP 8 features, OOP, and MVC architecture.
- **Full-Stack Development**: Involves both backend (PHP, MySQL) and frontend (HTML, minimal CSS)
  skills.
- **Real-World Application**: Simulates a practical scenario of handling financial data, relevant to
  many industries.
- **Extensible and Maintainable**: The use of OOP and MVC makes the project easy to extend and
  maintain.

## Conclusion

This project is a comprehensive showcase of my ability to build a full-stack application using PHP.
It reflects my understanding of modern development practices and my ability to deliver functional,
maintainable, and scalable solutions. Thank you for considering my work, and I look forward to
discussing how I can contribute to your team.

---

Feel free to explore the code, and if you have any questions or feedback, don't hesitate to reach
out to karocreativedesigns@gmail.com.
