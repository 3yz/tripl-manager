Tripl Manager
==============

A kohana module to make easier to build a content manager.

Installation
------------

**1st step**

Clone the module to the "modules" folder

**2nd step**

Execute de file auth-schema-mysql.sql in your database (it will create the basic table structure to the manager)

**3nd step**

Create a admin user to access the manager:

./minion admin:users --method=add --name=Admin --username=admin --password=admin123 --email='admin@admin.com' --role=admin

**4nd step**

Head to the manager url http://websiteurl.com/manager and use the credentials to grant permission to the system.

