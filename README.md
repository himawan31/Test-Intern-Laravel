# 📝 Laravel Task Management System

Sistem manajemen proyek dan tugas berbasis web menggunakan Laravel. Aplikasi ini mendukung pengelolaan proyek, penugasan anggota, pembaruan status tugas, serta pengiriman email pengingat secara otomatis untuk tugas yang belum selesai.

---

## 📌 Fitur Utama

- ✅ Manajemen Proyek (CRUD)
- ✅ Manajemen Tugas (CRUD)
- ✅ Role-based Access (Admin & Member)
- ✅ Penugasan Member ke Tugas
- ✅ Email Pengingat Tugas
- ✅ Sistem Queue dan Scheduler
- ✅ Autentikasi & Manajemen Profil Pengguna

---

## 🧠 ERD (Entity Relationship Diagram)

**Tabel Utama:**

- `users`: menyimpan data pengguna (admin & member)
- `projects`: menyimpan data proyek
- `tasks`: menyimpan data tugas
- `project_user`: tabel pivot untuk relasi many-to-many antara users dan projects

> 💡 Simpan file gambar ERD di `public/images/erd.png`  
> ![ERD](public/images/erd.png)

---

## 🔁 Flowchart Aplikasi

- Login → Dashboard
- Admin: kelola user, proyek, tugas
- Member: lihat proyek yang diikuti, update status tugas

> 💡 Simpan file gambar flowchart di `public/images/flowchart.png`  
> ![Flowchart](public/images/flowchart.png)

---

## ⚙️ Instalasi & Konfigurasi

### 1. Clone Repository

```bash
git clone https://github.com/your-username/task-manager.git
cd task-manager
```

### 2. Install Dependencies

```bash
composer install
npm install && npm run build
```

### 3. Konfigurasi Environment

Salin file `.env`:

```bash
cp .env.example .env
```

Edit `.env`:

```
APP_NAME="Laravel Task Manager"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
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

### 4. Generate Key

```bash
php artisan key:generate
```

---

## 🗃️ Migrasi & Seeder

```bash
php artisan migrate --seed
```

Seeder akan membuat data admin dan user dummy.

---

## 🔑 Login Awal (Default User)

| Role   | Email              | Password |
| ------ | ------------------ | -------- |
| Admin  | admin@example.com  | password |
| Member | member@example.com | password |

---

## 📂 Struktur Role & Hak Akses

| Fitur                | Admin | Member                   |
| -------------------- | ----- | ------------------------ |
| CRUD Proyek          | ✅    | ❌                       |
| CRUD Tugas           | ✅    | ❌                       |
| Lihat Proyek & Tugas | ✅    | ✅                       |
| Update Status Tugas  | ✅    | ✅ (hanya tugas sendiri) |
| Kelola Member Proyek | ✅    | ❌                       |
| CRUD User            | ✅    | ❌                       |

---

## ✉️ Sistem Email Reminder

### Custom Command

Command: `reminder-tasks`  
Kirim email ke pengguna yang memiliki tugas yang belum selesai.

### Artisan Scheduler

```php
// App\Console\Kernel.php
$schedule->command('reminder-tasks')->dailyAt('08:00')->timezone('Asia/Jakarta');
```

Atau untuk development/test:

```php
$schedule->command('reminder-tasks')->everyMinute();
```

### Jalankan Queue Worker

```bash
php artisan queue:work
```

### Jalankan Scheduler Secara Manual

```bash
php artisan schedule:run
```

### Cron Job (Linux)

Tambahkan ke crontab:

```
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

---

## 📂 Struktur Direktori Penting

```
app/
├── Console/
│   └── Commands/ReminderTasks.php
├── Mail/
│   └── TaskReminderMail.php
routes/
│   └── web.php
resources/
│   └── views/
database/
├── migrations/
├── seeders/
```

---

## 🧪 Testing

Untuk menguji email reminder:

```bash
php artisan reminder-tasks
```

---

## 📸 Screenshots (Opsional)

> Simpan di `public/images/`

- Dashboard: ![Dashboard](public/images/dashboard.png)
- Manajemen Tugas: ![Tasks](public/images/tasks.png)

---

## 🧪 Tech Stack

- Laravel 12
- Tailwind CSS
- MySQL
- Laravel Queue (Database)
- SMTP Mail
- Blade Component
- Laravel Scheduler & Artisan Commands

---

## 📄 Lisensi

Proyek ini menggunakan lisensi MIT.

---

## 🙋‍♂️ Developer

Himawan Kurnia Eli Santo  
📧 himawanelisanto@gmail.com  
📍 Temanggung, Indonesia

---
