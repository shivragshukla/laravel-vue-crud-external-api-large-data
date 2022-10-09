
## Installation

### Step 1
You can install the package via git:

```shell
git clone https://github.com/shivragshukla/laravel-vue-crud-external-api-large-data.git
```

#### Package install

Run the command : 

- The Laravel package will automatically register itself, so you can start using it immediately.

```shell
composer install
```

- The npm package will automatically register itself, so you can start using it immediately.

```shell
npm install
```

### Step 2 - Setup .env variables

- Create .env file from .env.example
- Open .env file set DB_DATABASE, DB_USERNAME, DB_PASSWORD, QUEUE_CONNECTION=database and Add VITE_API_URL="${API_URL}/api, PROPERTIES_API_URL, PROPERTIES_API_KEY"
- Run the command (key generate immediately): 

```shell
php artisan key:generate && composer dump-autoload
```

- Run migration

```shell
php artisan migrate
```

### Step 3 - Queue and sync database from external API

- Run the command on 1st shell: 

```shell
php artisan queue:work
```

- Run the command on 2nd shell: 

```shell
php artisan sync:properties
```

## Usage

- Run the command on 1st shell: 

```shell
php artisan serve
```

- Run the command on 2nd shell: 

```shell
npm run dev
```

- Application will run under http://127.0.0.1:8000/


## Screenshot

#### List

#### Create/Edit

#### Delete

#### Shell Script

