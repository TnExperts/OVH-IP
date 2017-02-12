# OVH-IP

We were in need of a Script to fetch the OVH API for available IP Subnets, cause we don't want to search manual for available alternatives. 

The PHP-OVH Repo ( https://github.com/ovh/php-ovh ) throws too much errors, we didn't want to debug at the moment. 

So we wrote a little Script without any dependencies which does the job giving us a table with available IP Space for all regions and all sizes. 

Examples: 

OVH:  https://servergurus.de/ovh/ovhip.php

SYS:  https://servergurus.de/ovh/sysip.php

Please keep in mind that this was written quick and dirty for the moment. Sometimes the OVH API gets in trouble which results in errors within the table or a complete timeout. 

