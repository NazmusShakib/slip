<?php 

/*

VS SCORM - clearDB.php 
Rev 1.0 - Tuesday, June 23, 2009
Copyright (C) 2009, Addison Robson LLC

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, 
Boston, MA	02110-1301, USA.

*/

//  database login information
require "config.php";

// connect to the database
$link = mysql_connect($dbhost,$dbuser,$dbpass);
mysql_select_db($dbname,$link);

// delete all variables
mysql_query("delete from scormvars",$link);

// display feedback to the user
print "Database Cleared";

?>