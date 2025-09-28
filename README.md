## How to Use

1. **Clone the repository**

   ```bash
   git clone https://github.com/AlexARNcode/music-database.git
   cd your-repo
    ```

2. **Install dependencies**

    ```bash
    ./vendor/bin/sail up -d
    ./vendor/bin/sail composer install
    ./vendor/bin/sail npm install
    ./vendor/bin/sail npm run dev
    ```

3. **Setup environment**

    ```bash
    cp .env.example .env
    ./vendor/bin/sail artisan key:generate
    ```

4. **Run migrations and seeders**

    ```bash
    ./vendor/bin/sail artisan migrate --seed
    ```

5. **Access the application**

    Open your browser at http://localhost:8080