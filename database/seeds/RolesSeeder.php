<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouncer::role()->create([
            'name' => 'admin',
            'title' => 'Administrador',
        ]);

        Bouncer::role()->create([
            'name' => 'secre',
            'title' => 'Secretário',
        ]);

        Bouncer::role()->create([
            'name' => 'coord',
            'title' => 'Coordenador',
        ]);

        Bouncer::allow('admin')->to('request-always');
        Bouncer::allow('admin')->to('edit', \App\User::class);
        Bouncer::allow('admin')->to('create', \App\Request::class);
        Bouncer::allow('admin')->to('resolve', \App\Request::class);
        Bouncer::allow('admin')->to('resolve', \App\Requirement::class);
        Bouncer::allow('admin')->to('manage', \App\BlockedDate::class);

        Bouncer::allow('secre')->to('request-always');
        Bouncer::allow('secre')->to('create', \App\Request::class);
        Bouncer::allow('secre')->to('resolve', \App\Request::class);
        Bouncer::allow('secre')->to('resolve', \App\Requirement::class);
        Bouncer::allow('secre')->to('manage', \App\BlockedDate::class);

        Bouncer::allow('coord')->to('create', \App\Request::class);
    }
}
