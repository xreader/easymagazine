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

define('STARTPATH', '../../../');

require_once(STARTPATH.'config.php');
require_once(STARTPATH.'costants.php');
require_once(STARTPATH.DATAMODELPATH.'option.php');
require_once(STARTPATH.DATAMODELPATH.'user.php');
require_once(STARTPATH.UTILSPATH.'fileWriter.php');
require_once(STARTPATH.UTILSPATH.'directoryrunner.php');

session_start();

function index() {
    $out = array();

    $activetemplate = Option::findByType('template');
    $out['activetemplate'] = $activetemplate[0];

    $templates = DirectoryRunner::retriveTemplatesList();
    $out['templates'] = $templates;

    return $out;
}

function activate($id) {
    $out = array();

    Option::cleanType('template');

    $toSave = new Option();
    $toSave->setName($id);
    $toSave->setType('template');
    $toSave->setValue('active');
    $toSave->save();

    FileWriter::writeTemplateIncluder($id);

    $activetemplate = Option::findByType('template');
    $out['activetemplate'] = $activetemplate[0];

    $templates = DirectoryRunner::retriveTemplatesList();
    $out['templates'] = $templates;

    return $out;
}

if (!isset($_GET["action"])) { $out = index(); }
else {
    switch ($_GET["action"]) {
        case  'index':         $out = index(); break;
        case  'activate':      $out = activate($_GET['id']); break;
    }
}

$templates = $out['templates'];
$activetemplate = $out['activetemplate'];

include('../../view/publisher/templates.php');

?>