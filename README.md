## How to Use

1. **Clone the repository**

   ```bash
   git clone https://github.com/AlexARNcode/music-database.git
   cd music-database
    ```

2. **Install dependencies**

    ```bash
    composer install
    ```

3. **Launch containers**
   ```bash
    ./vendor/bin/sail up -d
    ```

4. **Setup environment**

    ```bash
    cp .env.example .env
    ./vendor/bin/sail artisan key:generate
    ```

5. **Run migrations and seeders**

    ```bash
    ./vendor/bin/sail artisan migrate --seed
    ```
    
6. **Install frontend dependencies**
     ```bash
    ./vendor/bin/sail npm install
    ./vendor/bin/sail npm run dev
   ```
     
7. **Access the application**

    Open your browser at http://localhost/login
   Login with default user test@test.com and password test
