# Exchange
Web application that acts as a foreign currency exchange. Please read [ADR.md](/ADR.md) for details on architecture and application structure.


# Requirements
1. PHP version 7.4
2. MySQL server running

# Installation instructions

1. Create new MySQL database ``` CREATE DATABASE exchange;```. Grant privilege to your user for new database ```GRANT ALL PRIVILEGES ON exchange.* TO 'username'@'localhost';```
2. Instal composer packages ```composer install```
3. Copy .env file from .env.example ```cp .env.example .env```
4. Define your database params in .env file (DB_DATABASE, DB_USERNAME, DB_PASSWORD, DB_HOST, DB_PORT)
5. Run migrations ```php artisan migrate```
6. Seed the default data ```php artisan db:seed```. Seeds supported currencies, default surcharges, discounts and default exchange rates
7. Generate application key ```php artisan key:generate```
8. Start local application server ```php artisan serve```

# Exchange Rates
Exchange rates are provided from Currency Layer API.
Please visit [currencylayer.com](https://currencylayer.com/) and register for an account in order to obtain an API key. Click Sign Up Free, login using Google, Github, or another third-party OAuth provider. Select Free Plan, copy API key that is presented to you.
Later, define your API key in .env file as `EXCHANGE_RATES_API_KEY='YOUR_API_KEY_HERE'`

## 1. Automatic Update of Exchange Rates
Exchange rates are automatically updated every night at 00:00. As defined in Task Scheduler.
To start the task scheduler, add the following cron entry.
Run ```crontab -e``` and add following line:
```* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1```

## 2. Manual Update of Exchange Rates
To update exchange rates by hand, send a GET request to ```api/update-exchange-rates```

# Emails
You can use any SMTP server, however, I suggest you use MailTrap, as it is a simple Email Sandbox that is great for testing purposes.
Create a free account on [mailtrap.io](https://mailtrap.io/). Go to Email Testing, My inbox. Open Integrations selectbox, and choose Laravel7 and copy configuration values to your .env file.

Email configuration will look something like this, but with your own mailtrap username and password.

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=abcde111111111
MAIL_PASSWORD=abcde111111111
MAIL_ENCRYPTION=tls
```

## Coding Style Guide
This project follows PSR-2 coding standard. For detailed specifications please visit [https://www.php-fig.org/psr/psr-2/](https://www.php-fig.org/psr/psr-2/)
