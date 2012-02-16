<?php

$default = array(
	'field' => 'name',
	'checkbox' => array('category')
);
Configure::write('Taxonomy', array_merge($default,Configure::read('Taxonomy')?Configure::read('Taxonomy'):array()));
