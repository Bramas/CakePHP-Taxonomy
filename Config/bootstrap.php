<?php

$default = array(
	'field' => 'name',
);
Configure::write('Taxonomy', array_merge($default,Configure::read('Taxonomy')?Configure::read('Taxonomy'):array()));
