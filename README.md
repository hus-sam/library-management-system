# Library Management System
> Full-stack web application built with PHP, MySQL & Bootstrap

## Overview
A complete library management system with two separate dashboards —
Admin and User — featuring secure authentication, book inventory
management, and a borrowing request system.

## Features
- Role-based access control (Admin / User)
- Secure login with bcrypt password hashing (`password_hash`)
- Session management and protected routes
- Books inventory with full CRUD operations
- Borrow request system with date tracking
- Admin dashboard with live statistics (books, users, requests)
- Responsive dark UI built with Bootstrap 5

## Tech Stack
| Layer | Technology |
|-------|-----------|
| Backend | PHP 8 |
| Database | MySQL / MariaDB |
| Frontend | HTML, CSS, Bootstrap 5 |
| Auth | PHP Sessions + bcrypt |

## Database Structure
3 relational tables with foreign keys:
- `user` — stores users with hashed passwords and roles
- `books` — inventory with availability tracking
- `metaphor1` — borrow requests linked to users and books

## Setup
```bash
# 1. Clone the repository
git clone https://github.com/hus-sam/library-management-system

# 2. Import the database
mysql -u root -p < library2.sql

# 3. Configure connection in library.php
$host = "localhost";
$db_name = "library1";

# 4. Run on localhost (XAMPP / WAMP)
```

## Screenshots
> Admin Dashboard — Books — Borrow Requests

## Security Notes
Identified and partially mitigated common web vulnerabilities:
- Passwords stored using bcrypt (not plaintext)
- Input sanitized with `mysqli_real_escape_string`
- Session-based route protection
- Known residual risk: SQL injection via unsanitized GET params
  (documented as a learning exercise in web security)

## Context
Built as a university web development project at
Al-Zaytoonah University of Jordan — Cybersecurity program.

---
**Author:** Hussam Neddal | [LinkedIn](https://linkedin.com/in/hussam-neddal)
```
