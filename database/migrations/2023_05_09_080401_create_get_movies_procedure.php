<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      $procedure = "create procedure get_movies(rdate varchar(20) ,gen int , act int)
	                  select m.id, m.name, m.description, m.image, m.release_date, m.rating,m.award_winning,GROUP_CONCAT(distinct g.name) as genre, GROUP_CONCAT(distinct a.name) as actor from movies m
                     inner join movie_actors ma on ma.movie_id = m.id
                     inner join actors a on a.id = ma.actor_id
                     inner join entity_genres eg on eg.entity_id = m.id
                     inner join genres  g on g.id = eg.genre_id
                     inner join entities e on e.id = eg.entity_type_id
                       where
                      (NULLIF(rdate, ' ') IS NULL OR FIND_IN_SET(release_date, rdate)) AND
                      (NULLIF(gen, ' ') IS NULL OR FIND_IN_SET(g.id, gen)) AND
                      (NULLIF(act, ' ') IS NULL OR FIND_IN_SET(a.id, act)) AND

                     e.entityType = 'movies' group by m.id,m.name, description,m.release_date, m.rating,m.award_winning" ;

              DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('get_movies_procedure');
    }
};
