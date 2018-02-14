INTRODUCTION
------------

This module is solely for styling calendar Sites created in UniCal. This module
is designed to be installed on the UniCal MASTER Site, and referenced by client
module or embed code. You should modify the SCSS of this file to theme your calendars
as it will then be available to all sites that reference it. This module is designed
merely as a starting point, and common path for CSS based customizations.

REQUIREMENTS
------------

This module requires the following modules:

* UniCal (https://github.com/idfive/UniCal)


INSTALLATION
------------

* Install as you would normally install a contributed Drupal module. See:
  https://drupal.org/documentation/install/modules-themes/modules-7
  for further information.
* Modify SCSS to fit your brand (see configuration).

CONFIGURATION
-------------

* This module is designed as a starting point for custom styles.
  - You will need to manually create any styles you wish your calendar to have.
  - You will then need to be sure the embed code, or client module references
    those styles.

This module is set up to use SCSS files compiled via gulp. All scss files are
located in assets/scss/calendar, with the assets/scss/styles-calendar.scss holding some config variables. To begin development, simply run the following
from the command line (inside the module folder):
* npm install
* gulp

This will compile all scss to css, and begin the watch function, so that changes are recompiled as they happen.

We here at idfive like to rename this module to something like "MYCLIENTNAME_unical_styles" to both avoid confusion, and minimize the chance of overriding any custom work/etc.


TROUBLESHOOTING
---------------

If you are running into errors, be sure to check that CORS is running on the
MASTER install, and that you can ping your stylesheet directly.

Be sure that you are referencing the stylesheet in the embed/client module.
