## Git-Client download and install

 - http://git-scm.com/download/win

Install the downloaded Git-Client

## Clone the repository

 Open the Git-Bash (installed above) and change the directory to the place, where the page should be stay, the command is something 
 like `cd /c/Apache24/htdocs`.
 Than type `git clone https://github.com/kokspflanze/pserverCMSFull.git`, if you later want to update the Full-System, you can easy type 
 `git pull` [That only work in the pserverCMS-Directory, `cd /c/Apache24/htdocs/pserverCMSFull`].
 
 ![GitClone](https://github.com/kokspflanze/pserverCMSFull/blob/master/doc/images/git-clone.gif?raw=true)
 
## Download all other parts with composer
 
 Go wit the Git-Bash or WindowsCommandLine to the cloned page like `cd /c/Apache24/htdocs/pserverCMSFull` and type the following commands
  
  ```shell
  php composer.phar self-update
  php composer.phar update
  ```
  
  That can take some minutes.
  
### Info API rate limit

 If you have a problem like that please create a GitHub account and follow the link after "Head to" in the message.
 If you later input the token, it is hidden, so you dont see a input, that is normal. 
 
Continue with [configuration for Apache](https://github.com/kokspflanze/pserverCMSFull/master/doc/windows-setup/APACHE-CONFIG.md)