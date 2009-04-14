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

class NumberTests extends UnitTestCase {

    private $db;

    public function __construct() {
        $this->db = new DbCreator();
        $this->db->connect();
    }

	function setUp() {
        $this->db->dropSchema();
        $this->db->createSchema();
        $this->db->populateSchema();
	}

	public function tearDown() {
        $this->db->dropSchema();
	}

    function testFindById() {
        $num = Number::findById(1);
		$this->assertPattern('(number)', $num->getTitle());
    }

    function testfindUpIndexNumber () {
        $num = Number::findUpIndexNumber(2);
		$this->assertPattern('(third)', $num->getTitle());
    }

    function testfindDownIndexNumber () {
        $num = Number::findDownIndexNumber(2);
		$this->assertPattern('(first)', $num->getTitle());
    }

    function testfindByTitle() {
        $num = Number::findByTitle('first');
		$this->assertPattern('(first)', $num[0]->getTitle());
    }

    function testfindLast() {
        $num = Number::findLast();
		$this->assertPattern('(second)', $num->getTitle());
    }

    function testfindAllPublished() {
        $num = Number::findAllPublished();
		$this->assertEqual(2, count($num));
    }

    function testfindAll() {
        $num = Number::findAll();
		$this->assertEqual(3, count($num));
    }

    function testfindAllOrderedByIndexNumber() {
        $num = Number::findAllOrderedByIndexNumber();
		$this->assertEqual(3, count($num));
		$this->assertPattern('(third)', $num[0]->getTitle());
    }

}

$test = new NumberTests();
$test->run(new HtmlReporter());

?>
