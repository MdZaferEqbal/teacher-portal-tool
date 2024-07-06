# Teacher Portal

Upon logging into the Teacher Portal, you will be redirected to the Student Management Dashboard. This central hub provides a comprehensive view of all students, displaying their names, subjects, and marks. From this dashboard, you can easily manage student information by editing their details or removing student records as needed. The intuitive interface ensures that you can efficiently navigate through the student list, update relevant data, and maintain an organized overview of your class’s progress.

## Table of Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Running the Application](#running-the-application)
- [Features](#features)

## Installation

1. **Clone the repository:**
    ```sh
    git clone git@github.com:MdZaferEqbal/teacher-portal-tool.git
    cd teacher-portal-tool
    ```

2. **Install dependencies:**
    Make sure you have [Composer](https://getcomposer.org/) installed. Then run:
    ```sh
    composer install
    ```

3. **Install Node.js dependencies:**
    Make sure you have [Node.js](https://nodejs.org/) and npm installed. Then run:
    ```sh
    npm install
    ```

## Configuration

1. **Copy the example environment file and modify the configuration:**
    ```sh
    cp .env.example .env
    ```

2. **Set up your database:**
    Open the `.env` file and configure your database settings. For example:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_db_name
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

3. **Run the database migrations:**
    ```sh
    php artisan migrate
    ```

4. **(Optional) Seed the database with sample data:**
    ```sh
    php artisan db:seed
    ```

## Running the Application

1. **Start the local development server:**
    ```sh
    php artisan serve
    ```

    By default, the application will be accessible at [http://localhost:8000](http://localhost:8000).

## Features

- **Student Management Dashboard:** View all students, their names, subjects, and marks.
- **Edit Student Details:** Easily update student information.
- **Remove Student Records:** Delete student records when necessary.
- **Intuitive Interface:** Navigate through the student list efficiently.
