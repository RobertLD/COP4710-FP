# COP4710-FP


## Setting up your development enviroment

You can follow this tutorial, note that some steps are outdated and a bit of due diligence may be required: [link](https://www.shayanderson.com/microsoft-windows/install-lamp-on-windows-10-with-wsl.htm).

### Installing WSL
 Install WSL on your windows machine
This step should be fairly simple, if you run into errors more than likely you have virtualization turned off in your bios. To fix this: [link](https://docs.microsoft.com/en-us/windows/wsl/troubleshooting)

### Installing MYSQL
 Install mysql on your ubuntu WSL
This tutorial worked for me, it's not incredibly complicated: [link](https://pen-y-fan.github.io/2021/08/08/How-to-install-MySQL-on-WSL-2-Ubuntu/)
If you run into issues, the most likely thing to have happened is that MYSQL created a new MYSQL user and it's directories can only be accessed by this user.
You can either follow the part in the tutorial about setting root access or use:
```
su mysql
```
to change users.


### Installing Apache
Install apache2 with the following command

```
apt install apache2
```
After apache has installed, you can replace the configuration files with the config files we have here in the repo. These located in
```
/etc/apache2/apache2.conf
```
and
```
/etc/apache2/sites-available/000-default.conf
```
Apache is a service meaning you will use the service utility to start it, or restart it. You can do this as follows
```
sudo service apache2 start
```
Note: The config files require this repo to do cloned into:
```
/var/www
```
### Installing PHP
You can install all of the PHP tools with one command, this command being:
```
sudo apt install phpmyadmin php-mbstring php-zip php-gd php-json php-curl
```
