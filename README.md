# 🚀 Laravel Task Management System

A web-based project and task management application built with Laravel. This system enables project creation, task assignments, member collaboration, and automatic email reminders for unfinished tasks using queue workers and scheduler.

---

## ✅ Key Features

- 📁 Project Management (CRUD)
- ✅ Task Management (CRUD)
- 👥 User Management (CRUD)
- 🔒 Role-Based Access Control (Admin & Member)
- 🧑‍🤝‍🧑 Project Member Assignment
- 🔔 Email Reminders for Pending Tasks
- ⏳ Queue & Scheduler Integration
- 🔐 Authentication & Profile Management

---

## 🧩 Entity Relationship Diagram (ERD)

**Main Tables:**

- `users`: stores user data (admin and member roles)
- `projects`: stores project information
- `tasks`: stores individual tasks
- `project_user`: pivot table for many-to-many relationship between users and projects

<p align="center">
    <img src="https://github.com/user-attachments/assets/ef9793ab-c446-40db-b75f-882007986ec1" width="700" alt="Entity Relationship Diagram (ERD)"/>
</p>

---

## 🔄 Application Flowchart

- Login → Dashboard  
- Admin: manage users, projects, tasks, and reminders  
- Member: view assigned projects, task lists, and update task progress

<p align="center">
    <img src="https://github.com/user-attachments/assets/d3186b1d-8e98-4ece-8584-9a66c6e2922b" width="400" alt="Flowchart"/>
</p>

---

## ⚙️ Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/task-manager.git
cd task-manager
```

### 2. Install Dependencies

```bash
composer install
npm install && npm run build
```

### 3. Environment Configuration

Copy and configure `.env` file:

```bash
cp .env.example .env
```

Edit `.env`:

```env
APP_NAME="Laravel Task Manager"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

---

## 📦 Migrations & Seeder

Run the following to migrate and seed the database:

```bash
php artisan migrate --seed
```

This will generate required tables and populate initial admin and member accounts.

---

## 🔐 Default Login Accounts

| Role   | Email                | Password |
|--------|----------------------|----------|
| Admin  | admin001@gmail.com   | password |
| Member | member001@gmail.com  | password |

---

## 👮‍♂️ Roles & Permissions

| Feature                  | Admin | Member                   |
|--------------------------|-------|--------------------------|
| Create/Edit/Delete Projects | ✅    | ❌                       |
| Create/Edit/Delete Tasks    | ✅    | ❌                       |
| View Projects/Tasks         | ✅    | ✅                       |
| Update Own Task Progress    | ✅    | ✅                       |
| Manage Project Members      | ✅    | ❌                       |
| Manage Users                | ✅    | ❌                       |

---

## 📬 Email Reminder System

### Artisan Command

The following command sends reminder emails for unfinished tasks:

```bash
php artisan reminder-tasks
```

### Scheduling the Command

In `app/Console/Kernel.php`:

```php
$schedule->command('reminder-tasks')->dailyAt('08:00')->timezone('Asia/Jakarta');
```

For testing purposes:

```php
$schedule->command('reminder-tasks')->everyMinute();
```

### Queue Worker (Required for Async Mail)

```bash
php artisan queue:work
```

### Manually Trigger Scheduler

```bash
php artisan schedule:run
```

### Cron Job Setup (Linux)

Add this line to your system crontab:

```
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

> ⚠️ On Windows, use Task Scheduler or run `schedule:run` manually for testing.

---

## 📁 Important Folder Structure

```
app/
├── Console/
│   └── Commands/ReminderTasks.php   // Custom command
├── Mail/
│   └── TaskReminderMail.php         // Email template
routes/
│   └── web.php                      // Route definitions
resources/
│   └── views/                       // Blade templates
database/
├── migrations/                      // Table definitions
├── seeders/                         // Initial data
```

---

## 🧪 Testing the Reminder Feature

```bash
php artisan reminder-tasks
```

---

## 🖼️ Screenshots

- **Dashboard**  
<p align="center">
    <img src="https://github.com/user-attachments/assets/8c891fe7-ff2b-4e72-938f-61e2f81fdafd" width="700" alt="Dashboard"/>
</p>

- **User Management**
<p align="center">
    <img src="https://github.com/user-attachments/assets/55840270-2965-4a8e-9359-927fa332364e" width="700" alt="User Management"/>
</p>

- **Project Management**  
<p align="center">
    <img src="https://github.com/user-attachments/assets/de810150-55d4-4aff-9014-aa99b547b0f2" width="700" alt="Project Management"/>
</p>

- **Task Management**  
<p align="center">
    <img src="https://github.com/user-attachments/assets/6d0fd1ad-f872-4e4c-b294-3d9c0ed5f067" width="700" alt="Task Management"/>
</p>

---

## 🧰 Tech Stack

- Laravel 12
- Tailwind CSS
- MySQL
- Blade Templates
- Laravel Queue (Database Driver)
- Laravel Artisan Scheduler
- SMTP Email Integration

---

## 📃 License

This project is open-source and available under the MIT License.

---

## 👨‍💻 Developer

**Himawan Kurnia Eli Santo**  
📧 [himawanelisanto@gmail.com](mailto:himawanelisanto@gmail.com)  
📍 Temanggung, Central Java, Indonesia

---
