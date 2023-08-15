# Laravel Project Installation Guide

This guide provides step-by-step instructions to set up and run the Laravel application.

## Prerequisites

Before you begin, make sure you have the following software installed:

- [PHP 8](https://www.php.net/downloads.php)
- [Redis](https://redis.io/download)
- [Node.js and NPM](https://nodejs.org/en/download/)

## Installation Steps

1. **Clone the Repository:**

   ```bash
   git clone git@github.com:HamadaEmpatLima/cc-hamada-wallet.git
   cd cc-hamada-wallet


2. **Install Composer Dependencies:**
   ```bash
   composer install
   
3. **Install NPM Dependencies and Build Assets:**

   ```bash
   npm install
   npm run build


4. **Database Setup and Seeding:**

   Run the following commands to set up the database and seed initial data:

   ```bash
   php artisan migrate
   php artisan db:seed
   
5. **Start the Development Server:**

   ```bash
   php artisan serve
   
### Usage

1. **Register or Login:**

   You can choose to register or log in using the seeded user's credentials:
   - Email: `hamada.undetected@gmail.com`
   - Password: `12345678`
   
2. **Access Dashboard and Wallet:**

   After logging in, head to the dashboard and navigate to the wallet section. Here you can perform the following actions:
   - Deposit funds
   - Withdraw funds
   - View your account balance information
   - See deposit and withdrawal history


## Conclusion

Congratulations! You've successfully set up and configured the Laravel application. If you encounter any issues or need further assistance, please don't hestiate to contact me.

