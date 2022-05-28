<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Spatie\Multitenancy\Commands\TenantsArtisanCommand;
use App\Console\Commands\tenantMigrationCommand;

class tenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    //    $migration = TenantsArtisanCommand::artisan('migrate --database=tenant');
    //    $migration =  Artisan::tenants('migrate', array('--path' => 'app/migrations', '--force' => true));
    //    $migration =  Artisan::call('migrate', array('--path' => 'app/migrations'));
    // php artisan tenants:artisan "migrate --database=tenant"

    // $migration = Artisan::call('tenants:migrate', ['--tenants' => 63]);

    // $migration=  Artisan::call('tenants:artisan', [
    //     'tenantMigrationCommand' => 'migrate',
    //     '--tenant' => 63,
    // ]);
// $tenant = 63;
    $migration=  Artisan::command('tenants:artisan','migrate');

    // $migration = Artisan::call('tenantMigrationCommand', [
    //     '--database' => 'tenant'
    // ]);

        return $migration;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
