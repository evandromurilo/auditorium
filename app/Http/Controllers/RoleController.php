<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bouncer;
use App\User;

class RoleController extends Controller
{
    public function setup()
    {
        Bouncer::allow('admin')->to('edit', User::class);
        Bouncer::allow('admin')->to('create', \App\Request::class);
        Bouncer::allow('admin')->to('resolve', \App\Request::class);
        Bouncer::allow('admin')->to('resolve', \App\Requirement::class);
        Bouncer::allow('admin')->to('manage', \App\BlockedDate::class);

        Bouncer::allow('secre')->to('create', \App\Request::class);
        Bouncer::allow('secre')->to('resolve', \App\Request::class);
        Bouncer::allow('secre')->to('resolve', \App\Requirement::class);
        Bouncer::allow('secre')->to('manage', \App\BlockedDate::class);

        Bouncer::allow('coord')->to('create', \App\Request::class);

        $user1 = User::find(1);
        $user2 = User::find(2);
        $user3 = User::find(3);

        $user1->assign('admin');
        $user2->assign('secre');
        $user3->assign('coord');

        return redirect()->route('home');
    }
}
