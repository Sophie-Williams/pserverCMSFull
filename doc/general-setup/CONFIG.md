## PServerCMS basic configuration

 Go to the `config/autoload` directory and create `[GAME].local.php` with the content of `[GAME].example.php`. Now you have to edit the 
 configuration with the sql connect´s and other parts like mail and and and, you can find some other parts in [PServerCMS-Config](https://github.com/kokspflanze/PServerCore/blob/master/config/module.config.php)
 
 PS: You have to create the web-database by your self, the scripts of the p-server-cms will just add the tables, but will not create the database.
 
 For other games you can also use the `*.example.php`, but you have to change `gamebackend_dataservice`, if you only want to test you can
  use the Mocking-Class.
  
 ![BasicConfig](/doc/images/basic-config.gif?raw=true)
 
## Start with the PServerCMS ToDo-List

 Follow the link to the ToDo-List and start with `Generate the Database`.
 [ToDo-List](https://github.com/kokspflanze/PServerCMS/blob/master/README.md#generate-the-database)
 
 ![CreateDatabase](/doc/images/generate-the-database.gif?raw=true)
 
## Finished

 if everything done, the page works and you can start with [customize](https://github.com/kokspflanze/pserverCMSFull#customize-guides) the system.
