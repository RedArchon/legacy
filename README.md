## Setup

This project was built using [Laravel Sail](https://laravel.com/docs/9.x/sail#main-content). It's recommended that you have Docker installed before continuing.
- `git clone https://github.com/RedArchon/legacy.git`
- create a copy of `.env.example` and name the file `.env`
- cd into the new project's directory and run `composer install`
- `php artisan key:generate`
- `./vendor/bin/sail up` if you encounter any errors, use the step below to clear the cache.
- `./vendor/bin/sail build --no-cache` or use whichever alias you may have set for `./vendor/bin/sail` and then 
- Configure your MySQL connection using the credentials provided in `.env` and create a schema/database named `legacy`
- `php artisan sail:install` and choose `mysql`
- Run `./vendor/bin/sail artisan migrate`
- `./vendor/bin/sail npm install && npm run dev`
- Open your browser and head to `legacy.test` or `localhost`


Task: 
1. Create an endpoint called `api/reminders/schedule` 
2. Add a custom middleware for this endpoint that checks the header `X-SCHEDULER-HEADER` to be `secret!` otherwise do not allow the request to go through 
3. Create a controller and handler method 
4. Validate that the request has the correct payload: 

```
channel - should be string, required and in the list "mail, database"
message - should be string, required, max 256
time - should be a date time ISO
email - should be email and optional, required only if the `channel` is mail 
```

1. Create a migration for a new table called `schedulers` with the columns above. Add some more status columns to the migration (`sent_at` `failed_at` )
2. Create a model with the columns above 
3. Store the request payload into the database
4. Create a scheduler command that runs hourly and checks for unsent notifications the notifications to be sent this hour. The `unsent notifications` should be filtered using a model local scope called `scopeReady` and filter them there  
5. In the command check the `channel` type and send the notification using `Notification` facade
6. Create a generic mailable class that sends the email in case the channel is email. The email should be queued into the `emails` queue
7. Create a generic notification to send the notification into the database in case the channel requires that
8. Create a test using PHPUnit that ensures the notification is sent through.

