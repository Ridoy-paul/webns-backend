# WebNS Application Backend

This is the **backend** for the **WebNS Application**, built with **Laravel 11**.

## Features

- ✅ **User Authentication System**: Login, Registration.
- ✅ **Database Seeder**: Preloads Category and Ticket Status data.
- ✅ **Create Ticket System**: Supports file attachment uploads.
- ✅ **Admin Controls**: Only Admin can edit ticket information.
- ✅ **Role-Based Ticket View**:
  - Admin can see all user tickets.
  - Users can only see their own tickets.
- ✅ **Live Chat System**: Ticket-wise real-time chat using WebSockets.
- ✅ **Dashboard Reports**: Simple ticket status overview.

---

## Getting Started

### Prerequisites

Ensure you have the following installed:
- **PHP 8.3+**
- **Composer**
- **MySQL (or your preferred database)**
- **Laravel 11**

### Installation

1. **Clone the repository**
   ```sh
   git clone https://github.com/Ridoy-paul/webns-backend.git
   cd webns-backend
   ```

2. **Install dependencies**
   ```sh
   composer install
   ```

3. **Set up environment variables**
   Create a `.env` file in the root directory and copy the code from .env.example and update the DB_DATABASE same as your database name.

4. **Import the database**
   ```sh
   Go to the phpmyadmin and import the  database.sql from the root folder.
   ```

5. **Start the development server**
   ```sh
   php artisan serve
   ```

6. **Start the Reverb websocket server for Live Chat**
   ```sh
   php artisan reverb:start
   ```

7. **Start the Laravel queue worker** (for background tasks)
   ```sh
   php artisan queue:work
   ```

The backend should now be running at **http://localhost:8000** 🚀.

---

## Deployment

For production, set up a web server (Nginx/Apache) and run:
```sh
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Technologies Used

- **Laravel 11** (Backend Framework)
- **MySQL** (Database)
- **WebSockets** (Live chat feature)
- **Laravel Queue** (Background task processing)

---
