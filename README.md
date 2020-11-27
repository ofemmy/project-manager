This is a basic docker container network for developing in a php environment without having any dependency locally installed.

#### List of services
* PHP
* Nginx
* mysql
* Composer



#### Todo
* Create mysql folder as volume mount to save database even after container shutdown.
* Configure database login details in your own .env file.
* Start development in the *app* folder.
* You can reconfigure the volume mounts as you see fit.

The nginx root folder is by default in the */var/www/html/public* folder but you can always edit this.