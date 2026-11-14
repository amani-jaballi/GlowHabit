-- ============================================================
-- GlowHabit — Database Schema
-- ============================================================

CREATE DATABASE IF NOT EXISTS glowhabits CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE glowhabits;

-- Users
CREATE TABLE IF NOT EXISTS users (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(100) NOT NULL,
    email      VARCHAR(150) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    gender     VARCHAR(10)  NOT NULL DEFAULT '',
    height     FLOAT        NOT NULL DEFAULT 0,
    weight     FLOAT        NOT NULL DEFAULT 0,
    goal       VARCHAR(50)  NOT NULL DEFAULT '',
    role       VARCHAR(20)  NOT NULL DEFAULT 'user',
    created_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Contact messages
CREATE TABLE IF NOT EXISTS contact_messages (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    email      VARCHAR(150) NOT NULL,
    message    TEXT         NOT NULL,
    created_at TIMESTAMP    DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Recipes (admin-managed)
CREATE TABLE IF NOT EXISTS recipes (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(200) NOT NULL,
    description TEXT,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Workouts (admin-managed)
CREATE TABLE IF NOT EXISTS workouts (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(200) NOT NULL,
    description TEXT,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Tips (admin-managed)
CREATE TABLE IF NOT EXISTS tips (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    title      VARCHAR(200) NOT NULL,
    content    TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
