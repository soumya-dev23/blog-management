I used a existing frontend template, where I added everything necessary to the database, created relations between the tables, and did the backend in Laravel 9.


### Requirements ####
PHP 8.0 and above

#### Installation ######

Install Composer dependencies running the command :   composer install

Copy .env.example file into .env file and configure the database other driver

Migrate the database   <command>      php artisan migrate 

Seed database           <command>      php artisan db:seed


Default Admin User credentail :  admin@gmail.com  ||  password 
 Note: Admin user seeded using UserFactory and faker helper 


 php artisan serve   to Run the project 

 #### Features  ######

 There are two roles:  administrator and subscriber

 administrator can see all posts and edit and delete then where suscriber can edit and the posts only created by own but not others but can view others post 

 Used Laravel Sluggable in Post tiltle for better SEO

 after login you would be redirected to a Homepage

 Inside your profile settings you can edit your name, email address, picture, password

 user authentication middleware added to protect certain routes.

 blog details page : http://localhost:8000/post/mr-harvey-leannon-dvm    (elick on blog title , you will be redirected to blog deatils page, here you will find list of all comments related to that perticular blog and user can post comments on the blog )

  
