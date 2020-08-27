# Fortigate-API

Setup an API user on the fortigate and get the key.  The user will need VPN Read/Write access.
- In the Fortigate go to System > Admin Profiles
- Create a new profile and set the VPN permissions to Read/Write.  Leave the others as None.
- Go to System > Administrators
- Create a REST API Admin and pick the group you just created. No PKI Group is needed.  It is always a good idea to setup trusted hosts to your webserver.


Edit the Configuration at the top of the file to add the api key and the ip address of the firewall.


Server will need to have PHP and php-curl package to successfully run.
