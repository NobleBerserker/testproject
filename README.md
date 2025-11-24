## Introduction
This app creates tables (social_posts, social_reports) within a specified database (configured in .env). After the user logs in, they can view the posts of a specific facebook page (configured in .env). The metrics page will help analyze performance trends.

## Environment
PHP: 8.2
Laravel: 10.39
MariaDB: 10.4.28 (XAMPP)
Node: 22.x
NPM: 11.6
Tailwind CSS: 4.1.17
ApexCharts: 5.3.6
Facebook Graph API: v24.0

## Setup
1. Clone the repository
```
git clone "https://github.com/NobleBerserker/testproject.git"
cd testproject
```

2. Install PHP dependencies
```
composer install
```

3. Install Node dependencies (tailwind/vite)
```
npm install
npm run dev
```

4. Copy .env.example 
```
cp .env.example .env
```
Configure .env by adding your Database credentials and META_ACCESS_TOKEN

Also generate api key
```
php artisan key:generate
```

5. Run migrations and seeders in an empty database (as set in your .env).
```
php artisan migrate:fresh --seed
```

6. Serve the app
```
php artisan serve
```

7. For the app to work correctly you need to set up a schedule. 
For Dev:
```
php artisan schedule:work
```
For Production you need a CRON job

## Models
Laravel User 

social_posts
- created_time: datetime — required
- message: longText — nullable
- facebook_id: string — required
- created_at: timestamp
- updated_at: timestamp (Laravel default, if present)

social_reports
- social_post_id: integer — references social_posts.id
- likes: integer — nullable
- comments: integer — nullable
- shares: integer — nullable
- created_at: timestamp
- updated_at: timestamp

## Controllers
AuthController -> Handles login/logout
HomeController -> Fetches posts with the latest reports to make a list.
PostController -> Prepares data to use with ApexCharts

## Services
FacebookService -> Handles facebook endpoints

## Development Environment
For testing purposes the seeders add random users and a test user with these login credentials:
- test@example.com
- 123456

The seeders also add a facebook post with a full 10-day history of likes and comments to test the chart
