<?php

# Setup command: crontab -e
# Select editor (nano - recommanded)
# Put update day/time in crontab file.
# Eg: * * * * * /usr/bin/php /home/saadhoffl/WebApps/innovatement/lms-erp/lms-erp/lms-erp.com/lms-erp.com/lms-erp.com/htdocs/libs/includes/cronjobs/features/cronjobworker.php

# Final your task code write in your .php file:
file_put_contents('/home/saadhoffl/WebApps/innovatement/lms-erp/lms-erp/lms-erp.com/lms-erp.com/lms-erp.com/htdocs/libs/includes/features/cronjobs/crontabworker.txt', time(). "\n", FILE_APPEND);