# Forum

A fully functional Forum webapp.

## Tech Stack

1. Laravel for backend.
1. Vuejs for frontend.
1. tailwindcss as a css framework.
1. axios for ajax requests.
1. Mysql as the main database.
1. redis for tracking trending threads.
1. phpunit for unit and feature tests (The project was built using TDD).

---

## Screenshots

![ezgif com-gif-maker](https://user-images.githubusercontent.com/39973541/93681424-760c6a00-faae-11ea-8320-01a15dfe206e.gif)
---
![Screenshot (122)](https://user-images.githubusercontent.com/39973541/93681812-9e946400-faae-11ea-8981-56cfa16d22e9.png)
---
![Screenshot (125)](https://user-images.githubusercontent.com/39973541/93681947-b966d880-faae-11ea-8814-a11a0fe30a48.png)
---
![Screenshot (126)](https://user-images.githubusercontent.com/39973541/93681981-bc61c900-faae-11ea-8f3c-82000bcff8df.png)

---

## Installation guide

1. clone this repo to your local machine
1. run `npm install && npm run dev`
1. run `composer install`
1. copy `.env.example` to `.env` and fill in the database credentials
1. add the email credentials to `.env` file for users email verification
1. run `php artisan key:generate`
1. to seed the database with dummy data run `php artisan db:seed`
1. create a folder named `purify` under `storage` folder
1. make sure you have a redis server installed on your machine (default port is `6397`)

