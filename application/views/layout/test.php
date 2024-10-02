<?= html5('doctype') ?>
<?=
	html5(
		'html',
		array(
			'lang' => 'id'
		),
		array(
			html5(
				'head', array(),
				array(
					html5(
						'meta',
						array(
							'charset' => 'utf-8'
						)
					),
					html5(
						'meta',
						array(
							'content' => 'initial-scale=1.0, width=device-width',
							'name' => 'viewport'
						)
					),
					html5(
						'meta',
						array(
							'content' => 'ie=edge',
							'http-equiv' => 'X-UA-Compatible'
						)
					),
					html5('title', array(), 'Template Test'),
					html5(
						'link',
						array(
							'href' => 'https://cdn.jsdelivr.net/npm/bulma/css/bulma.min.css',
							'rel' => 'stylesheet'
						)
					)
				)
			),
			html5(
				'body',
				array(
					'class' => 'content',
					'style' => array(
						'margin' => '1rem'
					)
				),
				$this->template->render_section('content')
			)
		)
	)
?>