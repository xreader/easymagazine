<?php

/*
    Copyright (C) 2009-2012  Fabio Mattei <burattino@gmail.com>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

class ConfigWriter {

    /*
     * This method generates a gonfig file for the applications and save it
     * in the "system" folder.
     *
     * no return
     */
    public static function writeConfigFile($dbName, $dbuser, $dbpassword, $dbhost, $tbprefix, $folder) {
        $filename = '../system/config.php';

        $handle = fopen($filename, 'w');
        if (!$handle) {
            echo "Cannot open file ($filename)";
            exit;
        }

        ConfigWriter::write($handle, '<?PHP ');

        $toWrite = ' define(\'FOLDER\', \''.$folder.'\'); ';
        ConfigWriter::write($handle, $toWrite);
        $toWrite = ' define(\'DB_NAME\', \''.$dbName.'\'); ';
        ConfigWriter::write($handle, $toWrite);
        $toWrite = ' define(\'DB_USER\', \''.$dbuser.'\'); ';
        ConfigWriter::write($handle, $toWrite);
        $toWrite = ' define(\'DB_PASSWORD\', \''.$dbpassword.'\'); ';
        ConfigWriter::write($handle, $toWrite);
        $toWrite = ' define(\'DB_HOST\', \''.$dbhost.'\'); ';
        ConfigWriter::write($handle, $toWrite);
        $toWrite = ' define(\'TBPREFIX\', \''.$tbprefix.'\'); ';
        ConfigWriter::write($handle, $toWrite);

        ConfigWriter::write($handle, ' ?>');

        fclose($handle);
    }

    private static function write($handle, $toWrite) {
        if (fwrite($handle, $toWrite) === FALSE) {
            echo "Cannot write to file ($filename)";
            exit;
        }
    }

}

?>