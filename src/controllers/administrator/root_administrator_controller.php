<?php
/**
 Copyright (C) 2018-2020 KANOUN Salim
 This program is free software; you can redistribute it and/or modify
 it under the terms of the Affero GNU General Public v.3 License as published by
 the Free Software Foundation;
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 Affero GNU General Public Public for more details.
 You should have received a copy of the Affero GNU General Public Public along
 with this program; if not, write to the Free Software Foundation, Inc.,
 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA
 */

/**
 * Load the main interface of the administrator panel, contains the study selector, the modify center list interface and will load the 
 * study specific administrator panel
 */

Session::checkSession();
$linkpdo=Session::getLinkpdo();

if ($_SESSION['admin']) {

	// Get all availables active studies
	$etudes=Global_Data::getAllStudies($linkpdo, true);
	require 'views/administrator/root_administrator_view.php';

}else {
	require 'includes/no_access.php';
}
