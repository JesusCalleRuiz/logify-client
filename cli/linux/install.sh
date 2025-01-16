#!/bin/bash
/usr/bin/wget -O /usr/bin/logify https://raw.githubusercontent.com/JesusCalleRuiz/logify-client/main/cli/linux/template
read -p "Logify Server (eg: https://logify.server.com): " host
sudo /usr/bin/sed -i "s|{{HOST}}|$host|gi" /usr/bin/logify
chmod +x /usr/bin/logify
