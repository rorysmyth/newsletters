<?php

class Create_Initial_Tables_And_Relationships {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
			/*
			*	Sites
			*/
			Schema::create('sites', function($table)
			{
				$table->engine = 'InnoDB';
				$table->increments('id');
					$table->string('title');
				$table->timestamps();
			});

			/*
			*	Newsletter
			*/
			Schema::create('newsletters', function($table)
			{
				$table->engine = 'InnoDB';
				$table->increments('id');
					$table->string('title');
					$table->text('template');
					$table->integer('site_id')->unsigned();
					$table->foreign('site_id')->references('id')->on('sites');
				$table->timestamps();
			});

			/*
			*	Snippets
			*/
			Schema::create('snippets', function($table)
			{
				$table->engine = 'InnoDB';
				$table->increments('id');
					$table->string('title');
					$table->text('value');
					$table->string('type')->default('text');
					$table->integer('newsletter_id')->unsigned();
					$table->foreign('newsletter_id')->references('id')->on('newsletters')->on_delete('cascade');
				$table->timestamps();
			});

			/********************************************
			*	Data
			********************************************/
			DB::table('sites')->insert(
				array(
					array(
						'title' => 'Hostelworld'
					),
					array(
						'title' => 'Hostels.com'
					)
				)
			);

			DB::table('newsletters')->insert(
				array(
					array(
						'title'    => 'Hostelworld Monthly',
						'site_id'  => 1,
						'template' => '<!doctype html>
<html>
	<head>
		<title>Newsletter</title>
	</head>

	<body>
		<h1>{{title}}</h1>
		<p>{{blurb}}</p>
		<a href="{{url}}">{{cta}}</a>
	</body>
	
</html>'
					),
					array(
						'title'    => 'Hostels.com Monthly',
						'site_id'  => 2,
						'template' => '<h1>{{title}}</h1><p>{{blurb}}</p><a href="{{url}}">{{cta}}</a>'
					)
				)
			);

			DB::table('snippets')->insert(
				array(
					array(
						'title'         => 'title',
						'value'         => 'Book a trip in Rome',
						'type'          => 'text',
						'newsletter_id' => 1
					),
					array(
						'title'         => 'blurb',
						'value'         => 'Rome is an amazing city',
						'type'          => 'text',
						'newsletter_id' => 1
					),
					array(
						'title'         => 'cta',
						'value'         => 'learn more',
						'type'          => 'text',
						'newsletter_id' => 1
					),
					array(
						'title'         => 'url',
						'value'         => 'http://www.hostelworld.com/Rome',
						'type'          => 'text',
						'newsletter_id' => 1
					)
				)
			);

	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('snippets');
		Schema::drop('newsletters');
		Schema::drop('sites');
	}

}