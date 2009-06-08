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
require_once(STARTPATH.DATAMODELPATH.'comment.php');

session_start();

function index() {
    $out = array();

    $comm = new Comment();
    $out['comm'] = $comm;

    $comms = Comment::findAll();
    $out['comms'] = $comms;

    return $out;
}

function edit($id) {
    $out = array();

    $comm = Comment::findById($id);
    $out['comm'] = $comm;

    $comms = Comment::findAll();
    $out['comms'] = $comms;

    return $out;
}

function delete($id) {
    $out = array();

    $comm = Comment::findById($id);
    $comm->delete();
    $comm = new Comment();
    $out['comm'] = $comm;

    $comms = Comment::findAll();
    $out['comms'] = $comms;

    return $out;
}

function save($toSave) {
    $out = array();

    if (!isset($toSave['Published'])) { $toSave['Published'] = 0; }
    
    $comm = new Comment(
        $toSave['id'],
        $toSave['article_id'],
        $toSave['Title'],
        $toSave['Published'],
        $toSave['Body'],
        $toSave['Signature'],
        $toSave['created'],
        $toSave['updated']);
    $comm->save();
    if (isset($files['Image']) && $files['Image']['size'] > 0) {
        $comm->deleteImg();
        $comm->saveImg($files['Image']);
    }
    $out['comm'] = $comm;

    $comms = Comment::findAll();
    $out['comms'] = $comms;

    return $out;
}

if (!isset($_GET["action"])) { $out = index(); }
else {
	switch ($_GET["action"]) {
		case  'index':             $out = index(); break;
		case  'save':              $out = save($_POST); break;
		case  'edit':              $out = edit($_GET['id']); break;
		case  'delete':            $out = delete($_GET['id']); break;
	}
}

$comms = $out['comms'];
$comm = $out['comm'];

include('../../view/publisher/comments.php');

?>