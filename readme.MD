# Logify Client
## Composer package for Laravel
To use Logify from a Laravel project you just need to require the package using composer and set some environment variables to define the server location, the token of the application you want to log from and the behaviour of the library.
````
composer require jesus.calle/logify-client
````
Configure .env variables
````
LOGIFY_ACTIVE=true
LOGIFY_SERVER=https://logify.xxxxxxxxxx.xxx
LOGIFY_VERSION=v1
LOGIFY_TOKEN=xxxxxxxxxxxxxxxxxxxx
````
LOGIFY_TOKEN is the one specified in the client table of the Logify Server. This token is unique and identifies the client application to log it's entries separately of the rest.
This token is created by the Logify Server Administrator.

## Linux command line client
The linux command line utility is intended for sending log information to the Logify server from outside a Laravel application. Use it to log info/errors from inside cron jobs, automated tasks, etc
### Installation
````
mkdir temp
cd temp
wget -qO install.sh https://raw.githubusercontent.com/JesusCalleRuiz/logify-client/main/cli/linux/install.sh
chmod +x install.sh
sudo ./install.sh
````
When a Logify Server prompt appears, specify the protocol://hostname of the Logify Server:
````
Logify Server (eg: https://logify.server.com): https://logify...
````
Execute a test
````
logify prueba inf
````
Remove installation file
````
rm install.sh
````

The Client utility is deployed under /usr/bin folder and it is called logify
