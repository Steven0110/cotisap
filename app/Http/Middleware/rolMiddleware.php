<?php

namespace App\Http\Middleware;

use App\Rol;
use Closure;

class rolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //$rol = auth()->user()->U_admin;
        // $rol = auth()->user()->U_admin;

        // if(empty($rol)){
        //     $rol = 'V';
        // }

        // $role = Rol::where('rol', $rol)->get();
        // $JSON = $role[0]->dataConfig;

        $JSON = [
            [
                'name' => 'Cotizaciones',
                'status' => true,
                'children' => [
                    [
                        'name' => 'Nueva',
                        'status' => true,
                    ],
                ],
            ]
        ];


        \View::share('rolUserConfig', $JSON  );

        return $next($request);
    }
}
