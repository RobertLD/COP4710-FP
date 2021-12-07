# COP4710-FP

## Overview of tools
We are going to need a few tools to develop our project to completion, namely the invidiual components of the LAMP stack
1. Linux (Ubuntu via WSL)
2. Apache2 (Server)
3. MYSQL (SQL Server)
4. PHP (Middleware)

These tools will interface with one another to give the illusion of a seamless application. Generally this works as such:
Linux - Largely irrelevant in the physical aspect of the project, allows apache to make SystemCalls and more.
Apache2 - Allows access to files over different internet protocols
MYSQL - Provides database access and the query language to access them
PHP - Interface with API, MYSQL, and front-end information


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
## Configuration Required
1. MYSQL database must be configured with a root user, and you may (and probably should) add a personal user so not every use-case uses the Root user
2. The MYSQL database can me configured by running the create_schema.sql script
3. APACHE may require configuration to use PHP, but generally the PHP installation takes care of this for you.
4. Linux may require some minor permission management and service management to get everything running as intended
