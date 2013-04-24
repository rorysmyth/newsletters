<?php

class Create_Initial_Tables_And_Relationships {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{



			/********************************************
			*	Sites
			********************************************/
			Schema::create('sites', function($table)
			{
				$table->engine = 'InnoDB';
				$table->increments('id');
					$table->string('title');
				$table->timestamps();
			});
			/********************************************
			*	/Sites
			********************************************/


			/********************************************
			*	Templates
			********************************************/
			Schema::create('templates', function($table)
			{
				$table->engine = 'InnoDB';
				$table->increments('id');
					$table->string('title');
					$table->blob('code');
					$table->integer('site_id')->unsigned()->nullable();;
					$table->foreign('site_id')->references('id')->on('sites');
				$table->timestamps();
			});
			/********************************************
			*	/Templates
			********************************************/


			/********************************************
			*	Newsletters
			********************************************/
			Schema::create('newsletters', function($table)
			{
				$table->engine = 'InnoDB';
				$table->increments('id');
					$table->string('title');
					$table->blob('template');
					$table->integer('site_id')->unsigned();
					$table->foreign('site_id')->references('id')->on('sites');
					$table->integer('template_id')->unsigned()->nullable();
					$table->foreign('template_id')->references('id')->on('templates');
				$table->timestamps();
			});
			/********************************************
			*	/Newsletters
			********************************************/


			/********************************************
			*	Snippets
			********************************************/
			Schema::create('snippets', function($table)
			{
				$table->engine = 'InnoDB';
				$table->increments('id');
					$table->string('title');
					$table->text('value');
					$table->string('type')->default('text');
					$table->integer('newsletter_id')->unsigned()->nullable();;
					$table->foreign('newsletter_id')->references('id')->on('newsletters')->on_delete('cascade');
				$table->timestamps();
			});
			/********************************************
			*	/Snippets
			********************************************/


			/********************************************
			*	Sites data
			********************************************/
			// DB::table('sites')->insert(
			// 	array(
			// 		array(
			// 			'title' => 'Hostelworld'
			// 		),
			// 		array(
			// 			'title' => 'Hostels.com'
			// 		)
			// 	)
			// );
			/********************************************
			*	/Sites data
			********************************************/


			/********************************************
			*	Newsletters data
			********************************************/
			// DB::table('newsletters')->insert(
			// 	array(
			// 		array(
			// 			'title'    => 'Hostelworld Monthly',
			// 			'site_id'  => 1,
			// 			'template' => 'template'
			// 		),
			// 		array(
			// 			'title'    => 'Hostels.com Monthly',
			// 			'site_id'  => 2,
			// 			'template' => 'template'
			// 		)
			// 	)
			// );
			/********************************************
			*	/Newsletters data
			********************************************/


			/********************************************
			*	Snippets data
			********************************************/
			// DB::table('snippets')->insert(
			// 	array(
			// 		array(
			// 			'title'         => 'title',
			// 			'value'         => 'Book a trip in Rome',
			// 			'type'          => 'text',
			// 			'newsletter_id' => 1
			// 		),
			// 		array(
			// 			'title'         => 'blurb',
			// 			'value'         => 'Rome is an amazing city',
			// 			'type'          => 'text',
			// 			'newsletter_id' => 1
			// 		),
			// 		array(
			// 			'title'         => 'cta',
			// 			'value'         => 'learn more',
			// 			'type'          => 'text',
			// 			'newsletter_id' => 1
			// 		),
			// 		array(
			// 			'title'         => 'url',
			// 			'value'         => 'http://www.hostelworld.com/Rome',
			// 			'type'          => 'text',
			// 			'newsletter_id' => 1
			// 		)
			// 	)
			// );
			/********************************************
			*	/Snippets data
			********************************************/

			/********************************************
			*	Template data
			********************************************/
			// DB::table('templates')->insert(
			// 	array(
			// 		array(
			// 			'title'    => 'Hostelworld Monthly',
			// 			'site_id'  => 1,
			// 			'code' => '<h1>Title</h1>'
			// 		),
			// 		array(
			// 			'title'    => 'Hostels.com Monthly',
			// 			'site_id'  => 2,
			// 			'code' => '<h1>Title</h1>'
			// 		)
			// 	)
			// );
			/********************************************
			*	/Template data
			********************************************/


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
		Schema::drop('templates');
		Schema::drop('sites');
	}

}