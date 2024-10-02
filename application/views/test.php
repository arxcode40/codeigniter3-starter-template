<?php $this->template->extend('layout/test') ?>

<?php
	$this->template->section(
		'content',
		array(
			TRUE ? $this->template->include('picsum') : '',
			html5('h1', array(), 'Hello World!'),
			html5('p', array(), 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
			html5(
				'ul', array(),
				array_map(
					function ($item)
					{
						return html5('li', array(), $item);
					},
					$name
				)
			),
			html5(
				'button',
				array(
					'class' => array('button', 'is-primary'),
					'type' => 'button'
				),
				'Primary'
			)
		)
	)
?>