Lex Bot Deployment:
Create all amazon resources required for cBot project using cloudformation template in virginia region.
When client signup into IOS App ,every developer will get an Email with content of Lex to Facebook integration steps.Developer needs to follow those steps to integrate Bot to client Facebook page.
UI Deployment for OnlineOrder:
Create an Ec2 instance Linux server to get online order page.In that server needs to set up an Apache web server by following steps:
1)Attach a Role with Permissions to S3 access.
2)Connect to your EC2 instance and install the Apache web server.
yum install httpd
3)Start the service.
service httpd start
4)Create a mount point.
First note that the DocumentRoot in the /etc/httpd/conf/httpd.conf file points to /var/www/html (DocumentRoot "/var/www/html").
i)Create a sub-directory OnlineOrder under /var/www/html.
mkdir /var/www/html/OnlineOrder
5)Test the setup.
Add a rule in the EC2 instance security group, to allow HTTP traffic on TCP port 80 from anywhere.
6)Get a cart.html file.
First step upload OnlineOrder.zip file to one S3 bucket and copy file to /var/www/html path in linux.
aws s3 cp s3://BucketName/OnlineOrder.zip  /var/www/html
unzip OnlineOrder.zip
7)change the ownership.
chown  ec2-user OnlineOrder
chmod -R o+r OnlineOrder
8)Open a browser window and enter the URL to access the file (it is the public DNS name of the EC2 instance followed by the file name). 
For example:
http://EC2-instance-public-DNS/OnlineOrder/cart.html






UI Deployment for SITARA Website:
Create an Ec2 instance Linux server to get SITARA Website. In that server needs to set up Xampp server by following steps:
1)Attach a Role with Permissions to S3 access.
2)First you need to download xampp package in your Linux machine.
 
#yum install wget
#wget http://downloads.sourceforge.net/project/xampp/XAMPP%20Linux/1.8.3/xampp-linux-x64-1.8.3-3-installer.run 
xampp-linux-x64-1.8.3-3-installer.runxampp-linux-x64-1.8.3-3-installer.run
3)Give the executable permission on script. 
#chmod +x xampp-linux-x64-1.8.3-3-installer.run
xampp-linux-x64-1.8.3-3-installer.runxampp-linux-x64-1.8.3-3-installer.runxampp-linux-x64-1.8.3-3-installer.run
4)Run XAMPP installer script.
./xampp-linux-x64-1.8.3-3-installer.run 
 
5)After allow ALL network to access XAMPP Server.
Edit the last section of file called httpd-xampp.conf.Add new line Require all granted and comment the line Require local by using # sign
#vi /opt/lampp/etc/extra/httpd-xampp.conf
<LocationMatch "^/(?i:(?:xampp|security|licenses|phpmyadmin|webalizer|server-status|server-info))">
    # Require local
    Require all granted
    ErrorDocument 403 /error/XAMPP_FORBIDDEN.html.var
</LocationMatch>
6)Get SITARA website.
First step upload sitaracuisine.zip file to one S3 bucket and copy to path /opt/lampp/htdocs.
aws s3 cp s3://BucketName/sitaracuisine.zip <LocationMatch "^/(?i:(?:xampp|security|licenses|phpmyadmin|webalizer|server-status|server-info))">
    # Require local
    Require all granted
    ErrorDocument 403 /error/XAMPP_FORBIDDEN.html.var
</LocationMatch>
cd /opt/lampp/htdocs/
mkdir sitaracuisine
cd sitaracuisine
unzip /opt/lampp/htdocs/sitaracuisine.zip
7)Restart service.
#/opt/lampp/lampp restart
8)Test the setup.
Add a rule in the EC2 instance security group, to allow HTTP traffic on TCP port 80 from anywhere.
9)Now open the XAMPP in Web browser.
http://EC2-instance-public-DNS/sitaracuisine/index.php


UI Deployment for Web Bot:
1)Create an Ec2 instance Linux server to get online order page.In that server needs to set up an Apache web server by following steps:
( Can launch in same instance where Online Order was deployed)
1)Get a index.html file.
First step upload lex-web-ui.zip file to one S3 bucket and copy file to /home/ec2-user path in linux.
aws s3 cp s3://BucketName/lex-web-ui.zip  /home/ec2-user
Mkdir WebBot
Cd WebBot
unzip /home/ec2-user/lex-web-ui.zip
2)Test the setup.
Add a rule in the EC2 instance security group, to allow HTTP traffic on TCP port 8080 from anywhere.
3)Install npm and run files.
# install dependencies
curl --silent --location https://rpm.nodesource.com/setup_7.x | bash -
yum install -y nodejs
npm install
# serve with hot reload at localhost:8080
npm run dev &
