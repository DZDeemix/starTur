<?php

namespace App\Http\Middleware;

use Closure;

class SkiReformatData
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
        if (!empty($request)) {
            $data =[];
            foreach ($request->all() as $item) {
                $data[$item['label']] = $item['value'];
            }
            $request->replace($data);
        }
        return $next($request);
    }
}
