# LinkUP

LinkUP is a modern social media platform built with Laravel, inspired by Instagram's aesthetic and functionality. This application provides a complete social networking experience with a beautiful, responsive UI and comprehensive features for connecting and sharing with friends.

## 🌟 Features

### Core Features
- **User Authentication & Profiles**: Secure user registration and login powered by Laravel Jetstream
- **Post Management**: Create, edit, and delete posts with image support
- **Social Interactions**:
  - Comment on posts
  - React to posts (likes/reactions)
  - Follow/unfollow users
  - Friendship management
- **Search Functionality**: Discover and connect with other users
- **User Profiles**: View detailed user profiles and their posts
- **Real-time Feed**: Dynamic dashboard with posts from friends and followed users

### UI/UX Features
- **Instagram-inspired Design**: Modern, clean interface with familiar social media patterns
- **Dark Mode Support**: Fully functional dark theme across all pages
- **Responsive Layout**:
  - Desktop: Sidebar navigation
  - Mobile: Bottom navigation bar
- **Interactive Elements**: Smooth animations and hover effects

### Additional Pages
- Explore page for discovering new content
- Notifications center
- Messages (coming soon)
- Reels (coming soon)

## 🛠️ Tech Stack

- **Framework**: Laravel 12.x
- **Frontend**: Blade Templates, Tailwind CSS, Livewire
- **Authentication**: Laravel Jetstream with Sanctum
- **Database**: MySQL/PostgreSQL (configurable)
- **Build Tools**: Vite, PostCSS

## 📋 Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & npm
- MySQL or PostgreSQL database

## 🚀 Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd LinkUP
```

2. Install dependencies and set up the project:
```bash
composer run setup
```

This will:
- Install PHP dependencies
- Copy `.env.example` to `.env`
- Generate application key
- Run database migrations
- Install npm packages
- Build frontend assets

3. Configure your database in the `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=linkup
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

4. Run the development server:
```bash
composer run dev
```

This will concurrently start:
- Laravel development server
- Queue worker
- Log viewer (Pail)
- Vite dev server

The application will be available at `http://localhost:8000`

## 🧪 Testing

Run the test suite:
```bash
composer run test
```

## 📁 Project Structure

```
LinkUP/
├── app/
│   ├── Http/Controllers/
│   │   ├── DashboardController.php
│   │   ├── PostController.php
│   │   ├── CommentController.php
│   │   ├── ReactionController.php
│   │   ├── FriendshipController.php
│   │   ├── UserController.php
│   │   └── SearchController.php
│   └── Models/
│       └── User.php
├── resources/views/
│   ├── layouts/
│   │   └── app.blade.php
│   ├── auth/
│   ├── dashboard.blade.php
│   └── ...
└── routes/
    └── web.php
```

## 🎨 Design Philosophy

LinkUP follows modern web design principles:
- **Clean & Intuitive**: Familiar social media patterns for easy navigation
- **Responsive**: Seamless experience across all device sizes
- **Accessible**: Support for dark mode and keyboard navigation
- **Performance**: Optimized loading and smooth interactions

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🙏 Acknowledgments

Built with [Laravel](https://laravel.com) - The PHP Framework for Web Artisans
