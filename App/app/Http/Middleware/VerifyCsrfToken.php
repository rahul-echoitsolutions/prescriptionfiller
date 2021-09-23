<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = ['user', 'register_pharm'
        //
    ];
	
	
	/*If you are using a route group:

	Route::group(array('prefix' => 'api/v2'), function()
	{
		Route::post('users/valid','UsersController@valid');
	});

	Your $except array looks like:

	protected $except = ['api/v2/users/valid'];

	2. If you are using a simple route

	Route::post('users/valid','UsersController@valid');

	Your $except array looks like:

	protected $except = ['users/valid'];

	3. If you want to exclude all routes under main route (users in this case)

	Your $except array looks like:

	protected $except = ['users/*'];



*/
}
