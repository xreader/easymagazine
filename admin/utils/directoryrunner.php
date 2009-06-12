<?php

/*
    Copyright (C) 2009  Fabio Mattei

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

class DirectoryRunner {

    public static function retrivePlugInList() {
        $list = array();
        $dir = STARTPATH.'contents/plug_in/';

        if (is_dir($dir)) {
            $dh = opendir($dir);
            if ($dh) {
                while (($file = readdir($dh)) !== false) {
                    if ((filetype($dir.$file)=='dir') && ($file!='.') && ($file!='..')) {
                        $list["$file"] = $file;
                    }
                }
                closedir($dh);
            }
        }
        return $list;
    }

}

?>