# 🌿 GlowHabit — Healthy Lifestyle Platform

A full-stack PHP/MySQL web application for managing personal wellness habits including meal plans, workout programs, and daily wellness tips.

## Tech Stack
- **Frontend:** HTML5, CSS3 (custom design system), JavaScript
- **Backend:** PHP 8+ (PDO)
- **Database:** MySQL
- **Font:** Plus Jakarta Sans (Google Fonts)

## Features
- User registration & login with session management
- Remember me (cookie-based)
- BMI calculator (live update on profile page)
- Personalized dashboard
- Meal plans: Lose Weight & Gain Weight (3 meals/day, 4 recipes each)
- Workout programs: Gain & Lose weight exercises
- Wellness tips (6 categories)
- Role-based access: `user` / `admin`
- Admin panel: manage recipes, workouts, and wellness tips
- Contact form (stored in DB)
- Fully responsive (mobile, tablet, desktop)

## Setup

### 1. Place the project
```
htdocs/GlowHabit/
```

### 2. Create the database
Import `database.sql` in phpMyAdmin or run:
```bash
mysql -u root -p < database.sql
```

### 3. Configure DB credentials
Edit `includes/database.php`:
```php
private $host     = "localhost";
private $db_name  = "glowhabits";
private $username = "root";
private $password = "";
```

### 4. Access the app
```
http://localhost/GlowHabit/
```

## Default Admin Account
Create one via signup, then manually set `role = 'admin'` in the `users` table.

## Project Structure
```
GlowHabit/
├── includes/
│   ├── database.php     # PDO connection class
│   ├── navbar.php       # Sticky navbar + Google Fonts + CSS link
│   ├── footer.php       # Footer + closing tags
│   └── style.css        # Complete design system
├── classes/
│   └── user.php         # User CRUD class
├── pages/
│   ├── dashboard.php    # User dashboard (protected)
│   └── profile.php      # Profile + BMI editor (protected)
├── admin/
│   ├── index.php        # Admin dashboard with stats
│   ├── manage_recipes.php
│   ├── manage_workouts.php
│   └── manage_tips.php
├── pics/                # All images
├── index.php            # Home page
├── login.php
├── signup.php
├── logout.php
├── about.php
├── contact.php
├── fitness.php
├── wellness.php
├── recipes_lose.php
├── recipes_gain.php
└── database.sql
```
