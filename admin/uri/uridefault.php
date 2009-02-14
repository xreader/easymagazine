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

/*
 * possible URI(s) are:
 *
 * mysite.com/numbers/$number_title/$number_id
 * mysite.com/articles/$article_title/$article_id
 * mysite.com/comments/$article_title/$article_id
 * mysite.com/pages/$page_title/$page_id
 *
 */

include(URIPATH.'/uri.php');

class UriDefault extends URI {

    function evaluate(){
        $newArray = explode('/', $this->uri);

        switch ($newArray[0])
        {
            case 'numbers': $router = 'number'; $id = $newArray[2]; break;
            case 'articles': $router = 'article'; $id = $newArray[2]; break;
            case 'comments': $router = 'comments'; $id = $newArray[2]; break;
            case 'pages': $router = 'page'; $id = $newArray[2]; break;
            default: $router = 'index'; $id = 'not required';
        }

        $this->arrayURI = array(
            'Router' => $router,
            'id' => $id
        );
    }

}

?>
