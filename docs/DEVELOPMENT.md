# Development notes

Quick steps to run the app locally:

1. Install dependencies:
   - composer install
2. Configure database in `.env` (DATABASE_URL)
3. Create database and schema (if needed):
   - php bin/console doctrine:database:create
   - php bin/console doctrine:schema:update --force
4. Create a test user (already added in DB for this project):
   - **Email:** admin@example.test
   - **Password:** testpassword
   - To create your own user: `php bin/console security:hash-password "yourpassword"` and insert into `user` table.

Useful commands:
- Run server: `symfony server:start` or `php -S 127.0.0.1:8000 -t public`
- Clear cache: `php bin/console cache:clear`
- Validate schema: `php bin/console doctrine:schema:validate`
- Create migration: `php bin/console make:migration`

Notes:
- Login page available at `/login`.
- Listings at `/bien`, houses at `/bien/houses`, apartments at `/bien/apartments`.
- Creating/editing/deleting resources requires authentication.
