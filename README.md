Notification System
===================

This is a notification system that receives a message and depending on the category and subscribers, sends notifications to those users in the channels they are registered.

The system does not actually send any messages or communicate with external APIs. Instead, it stores information about notifications in a log. The log includes details about the message, notification type, user data, time, and more.

Architecture
------------

The application uses a PHP backend with Laminas API Tools and a Next.js frontend. The backend is responsible for managing the logic of the notification system, while the frontend provides a user interface for submitting messages and viewing the log
history.

The system uses object-oriented programming (OOP) principles and is designed to be scalable, allowing for the addition of more types of notifications in the future.

Technology Stack
----------------

The project will use the following technology stack:

* Backend:
    * PHP 8.2 with Laminas API Tools
    * MariaDB 10.3 for data storage
* Frontend:
    * Next.js 13
    * React

Installation
------------

To install and run the application, follow these steps:

1. Clone the project repository to your local machine.
2. Navigate to the project directory in your terminal.
3. Run `docker-compose up -d` to start the Docker containers.
4. Run `docker exec -it gilanotification-php-apache php /var/www/html/vendor/bin/doctrine-migrations migration:migrate` to create and populate the database
5. Navigate to `http://localhost:3000` in your web browser to view the application.