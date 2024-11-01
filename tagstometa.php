<?php
/*
	Plugin Name: Tags To Meta
	Plugin URI: http://www.murraypicton.com/plugins/tags-to-meta
	Description: Increase SEO by putting blog tags and categories into the meta keywords on each page
	Version: 1.0
	Author: Murray Picton
	Author URI: http://www.murraypicton.com
	License: GPL2
	Copyright 2010  MURRAY PICTON  (email : info@murraypicton.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
add_action('wp_head', 'tagstometa');

function tagstometa() {
	//Categories
	$cats = array();
	$categories = get_the_category(false);
	if(is_array($categories) && count($categories) > 0) {
		foreach ( $categories as $category ) {
			$cats[] = $category->name;
		}
	}
	//Tags
	$tagStr = implode(",",$cats).",";
	$tags = get_the_terms(0, 'post_tag');
	if(count($tags) == 0)
	$tags = get_tags();
	$tagList = array();
	if(is_array($tags) && count($tags) > 0) {
		foreach($tags as $tag) {
			$tagList[] = $tag->name;
		}
	}
	$tagStr .= implode(",", $tagList);
	//Output
	echo "\r\n<meta name='keywords' content='$tagStr' />";
}
?>