# OVH-IP

We were in need of a Script to fetch the OVH API for available IP Subnets, cause we don't want to search manual for available alternatives. 

The PHP-OVH Repo ( https://github.com/ovh/php-ovh ) throws too much errors, we didn't want to debug at the moment. 

So we wrote a little Script without any dependencies which does the job giving us a table with available IP Space for all regions and all sizes. 

Example: 

OVH:  https://servergurus.de/ovh/

Please keep in mind that this was written quick and dirty for the moment! 

Sometimes the OVH API gets in trouble which results in errors within the table or a complete timeout. 

As you can see both files are nearly identical for now, as is the API for both. ;-) 

For outputting a snapshotted Version to your Webserver use crontab or a little Bash-Script like the example ovhip.bash 


