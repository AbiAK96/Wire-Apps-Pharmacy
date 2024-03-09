# Wire-Apps-Pharmacy

01. Save the Application file into the server directory.

02. Create a Database as 'pharmacy_portal'.(utf8_unicode_ci)

03. open the cmd in file directory and run the command as i mentioned below.
   
    a. 'composer install'  

    b. 'php artisan migrate' 
	(you can see tables migrating)

    c. 'php artisan db:seed --class=DatabaseSeeder'
	(you can see admin user and roles seeded into database)

    d. 'php artisan serve'
	(now you can run this command and test the application)

owner credentials.
username - 'owner@gmail.com'
password - '12345678'

manager credentials.
username - 'manager@gmail.com'
password - '12345678'

cashier credentials.
username - 'cashier@gmail.com'
password - '12345678'

04. Test Api

   a. Open "Guides" folder in project folder,then import Api collection & environment variables file into postman.

   b. Change the BASE_URL and BEARER_TOKEN.

if you have any trouble contact me - '+94752938243'

Thank you!