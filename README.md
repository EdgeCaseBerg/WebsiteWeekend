<<<<<<< HEAD
**Welcome to JoshFrame**
=========
----

JoshFrame is a simple PHP MVC framework developed at The University of Vermont by Joshua Dickerson


**Requirements:**

- apache

- php 5.3

- MySQL Database access

- php_curl

- apache mod_rewrite

**Installation:**

- Download and extract to a public folder (usually /var/www/) 

- Edit the /Configuration/config.php to add your database information, as well as your host folder structure

---

**Understanding joshFrame:**

Joshframe takes URL patterns as input, and returns a view as output. 

Regular expressions are used to parse the url in order to ascertain client intent. Rather than using the url to access a particular file structure, joshFrame views urls as commands issued to a particular controller 

Standard URL pattern: (http://hostname/root_folder/parent_folder/child_file.php), 
JoshFrame's URL: (http://hostname/sub_controller/?function=argument)

Login requests, for example, are made to http://website.com/User/?doLogin=true. 
This url generates an instance of the UserController object (/Controllers/UserController.php), which then interacts with the User data model (Models/User.php).
The way the controller interacts with the data model is defined by the ?doLogin=true string, which is compared to a list of allowed functions in UserController.php 
parseActions() method.

** To Create a New Module: **

Creating a new module is easy. First, create a new controller that is a sub-class of AbstractController and name it in the form: "Something"Controller.php.
Assuming you need access to the data-store, make a model in Models/ folder. 
Implement the parseAction($actions) function, and use the controller to interact with the model you created. 

=======
WebsiteWeekend
==============

Repository to hold the Events of 4/6 and 4/7 as CS Crew created the new CS Crew Website
>>>>>>> 8ad96e4acc76a55b06817236687f296d777144f7
