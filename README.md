# Task Management App

## 🚀 Deployment

1. Clone the repository:

   ```bash
   git clone https://github.com/jmaresp673/taskManager.git
   cd taskManager
   ```
2. Install PHP dependencies via Composer:

   ```bash
   composer install
   ```
3. Copy `.env.example` to `.env` and configure your environment variables (database, mail, etc.):

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Run database migrations and seeders:

   ```bash
   php artisan migrate --seed
   ```
5. Create storage symlink:

   ```bash
   php artisan storage:link
   ```
6. (Optional) Install and build frontend assets:

   ```bash
   npm install
   npm run build
   ```
7. Serve the application locally:

   ```bash
   php artisan serve
   ```

Visit `http://127.0.0.1:8000` in your browser, change to localhost to make reCaptcha work properly.

## 🛠️ Dependencies

* **PHP**: ^8.1
* **Laravel**: 11.x
* **Database**: MySQL 5.7+
* **Composer**: ^2.0
* **Node.js & NPM** (optional, for frontend assets)
* **Storage Link**: `php artisan storage:link`

## 🔑 Features

### Authentication & Profiles

* User registration with reCaptcha, login, email verification, and password reset (Laravel Breeze/Jetstream).
* Profile management with photo upload and update, password, name and email change.
* Soft-delete lockout (`is_locked` flag) for blocked users.

### Categories

* CRUD operations on categories.
* Nested subcategories (parent/child relationship).
* Color-coded categories.
* Drag-and-drop reordering with persistent `position` field.
* Inline expand/collapse of subcategory lists.

### Tasks

* CRUD operations on tasks: title, description, due date, priority, status, category, assigned user.
* Soft deletes for tasks (trashed view + restore capability).
* Task filtering (status, priority, category, due date), search, and sorting (title, due date, priority).
* Pagination with persistent query parameters across pages.

### Task Attachments

* Upload multiple file attachments per task (max 5 files, 5MB each).
* Stored in `storage/app/public/attachments` with symlink to `public/storage`.
* Soft deletes on attachments when tasks are deleted. Attachments are restored with the task.

### Task History

* Auditing of task changes: whenever a task is updated, only changed fields are logged.
* Stored history records: `task_id`, `user_id`, `action`, `old_value`, `new_value`, timestamps.
* History view in task details, including user name.

### Task Comments

* Users can add comments on tasks.
* Comments are listed in task detail view, sorted by most recent first.

## ⚙️ Configuration

* Set your database credentials in `.env`.
* Configure `FILESYSTEM_DRIVER=public` for attachment storage.
* Mail configuration for user verification/password resets.

## 📂 Directory Structure

```
app/
├── Http/Controllers/
│       ├── Auth/
│       │   ├── AuthenticatedSessionController.php
│       │   ├── ConfirmablePasswordController.php
│       │   ├── EmailVerificationNotificationController.php
│       │   ├── EmailVerificationPromptController.php
│       │   ├── NewPasswordController.php
│       │   ├── PasswordController.php
│       │   ├── PasswordResetLinkController.php
│       │   ├── RegisteredUserController.php
│       │   └── VerifyEmailController.php
│       │
│       ├── CategoryController.php
│       ├── ProfileController.php
│       ├── TaskAttachmentController.php
│       ├── TaskCommentController.php
│       ├── TaskController.php
│       └── TaskHistoryController.php
│
├── Models/
│   ├── Category.php
│   ├── User.php
│   ├── Task.php
│   ├── TaskAttachment.php
│   ├── TaskComment.php
│   └── TaskHistory.php
...
```

## 📄 License

This project is licensed under the MIT License.
