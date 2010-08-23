<?php

$gdtt_config_extra = dirname(dirname(__FILE__))."/gdtt-config.php";
if (file_exists($gdtt_config_extra)) require_once($gdtt_config_extra);

/**
 * Full path to wp-load file. Use only if the location of wp-content folder is changed.
 *
 * example: define('GDTAXTOOLS_WPLOAD', '/home/path/to/wp-load.php');
 */
if (!defined('GDTAXTOOLS_WPLOAD')) define('GDTAXTOOLS_WPLOAD', '');

/**
 * Line ending used for generating the backup file.
 */
if (!defined('GDTAXTOOLS_EOL')) define('GDTAXTOOLS_EOL', "\r\n");

/**
 * Full path to a text file used to save debug info. File must be writeable.
 */
define('GDTAXTOOLS_LOG_PATH', dirname(__FILE__).'/debug.txt');

/**
 * Returns the path to wp-load.php file
 *
 * @return string wp-load.php path
 */
function get_gdtt_wpload_path() {
    if (GDTAXTOOLS_WPLOAD == '') {
        $d = 0;
        while (!file_exists(str_repeat('../', $d).'wp-load.php'))
            if (++$d > 16) exit;
        return str_repeat('../', $d).'wp-load.php';
    } else return GDTAXTOOLS_WPLOAD;
}

?>