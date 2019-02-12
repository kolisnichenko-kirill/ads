## Installation 
1) Download the repository
2) Install project dependencies using the command:
`composer i`
3) Create empty database.
4) Rename `.env.example` to `.env` and set up a database connection.
5) Generate an Encryption Key using the command:
`php artisan key:generate`
6) Create tables using the command:
`php artisan migrate`
