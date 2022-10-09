
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
![list](https://user-images.githubusercontent.com/30346330/194783172-b3ceb561-1d23-46e0-b4b0-f628bc9b9ca0.png)

#### Create/Edit
![edit](https://user-images.githubusercontent.com/30346330/194783202-4993805b-3f76-48be-a4d9-a2294d4d9e04.png)

#### Delete
![delete](https://user-images.githubusercontent.com/30346330/194783218-fe12ca64-9462-4d0e-837f-d6024ef2d030.png)


#### Shell Script
![command](https://user-images.githubusercontent.com/30346330/194783274-a0bf5519-633f-487c-ba66-a319f59d9f96.png)
![queue](https://user-images.githubusercontent.com/30346330/194783279-606b0582-f766-4769-a234-e4dd5d14b6dd.png)

