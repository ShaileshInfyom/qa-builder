## How to Set up the project

- Create .env file if not exist into project's root.
- Run `composer install`
- Run `php artisan key:generate`
- Set up the DB configurations into `.env`

      DB_USERNAME=root (database username)
      DB_PASSWORD=root (database password)


- Run `php artisan migrate --seed`

## Import Postman Collection

Import postman collection from `project_root/postman/postman_collection.json`

### Default User Credentials

- Email : `zane_jakubowski@yahoo.com`
- Password : `7FvACPTtd9QgBua`

### Default Admin Credentials

- Email : `emilio88@gmail.com`
- Password : `VbGk16C6mVaQjml`

Note: you can change the admin / user credentials as you want and then again you have to run php artisan migrate:fresh --seed


#### Other Information :

- Role Admin will have all the permission by default.
- We are providing Roles / Permissions APIs from where you can create new role and assign permissions to related Role
- If You are assigning some Role to User then all permissions of that Role will be default assigned to that user.
