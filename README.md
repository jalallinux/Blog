## Laravel Blog

### Build Setup

```bash
# create .env file and fill database, url configs
$ cp .env.example .env

# install packages
$ composer install

# generate application key
$ php artisan key:generate

# generate jwt secret key
$ php artisan jwt:secret

# generate fake data
$ php artisan migrate:fresh --seed
```

### API
Postman collection exists root of project. you can import this in your postman and test this.

#### Create this for Trainee  application with [Samir](https://github.com/samsab1995)
