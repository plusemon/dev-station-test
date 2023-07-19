## **Installation Process:**

1. clone this GitHub repository:

```

git clone https://github.com/plusemon/dev-station-test.git


```

2. CD into project folder and run

```

composer install

npm install

```

3. Copy .env.example to .env

```

copy .env.example .env

```

5. Generate Key, Database, Email configuration and other environment variables as per you need.

```

php artisan key:generate

```

6. Migrate the database schema and seed some dummy products

```

php artisan migrate --seed

```

6. Build the assets

```

npm run dev

```

7. Serve the project and visit the APP_URL

```

php artisan serve

```

8. Register a new user, and it will reach you to the dashboard page, then you can test it out everything.

_Note: If you need any help or anything to ask, then feel free to contact with me. Also, I have developed it in a short time, more work/retouch could be done here._

WhatsApp: 01995329555

Thanks
