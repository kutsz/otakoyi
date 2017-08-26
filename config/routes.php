<?php

return array(
	'test/page-([0-9]+)' => 'book/json/$1',
	// 'ajax/page-([0-9]+)' => 'book/json/$1',
	//'ajax/page-([0-9]+)' => 'book/ajax/$1',
	'view/page-([0-9]+)' => 'book/view/$1',
	'book' => 'book/addcomment',
	'ajax' => 'book/ajax',
	'view' => 'book/view',
	//'' => 'home/view',
	'admin' => 'admin/form',
	'login' => 'admin/login',
	'cabinet' => 'admin/cabinet',
	'delete' => 'admin/delete',
	'edit' => 'admin/edit',
	'total' => 'book/totalcomments',
	'update' => 'admin/update',

);
