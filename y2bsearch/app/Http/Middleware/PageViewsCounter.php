<?php

namespace App\Http\Middleware;


use Closure;

class PageViewsCounter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Closure|\Closure $next
     * @param  string|null $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $counter_name = "counter.txt";
        // Check if a text file exists. If not create one and initialize it to zero.
        if (!file_exists($counter_name)) {
            $f = fopen($counter_name, "w");
            fwrite($f, "0");
            fclose($f);
        }
        // Read the current value of our counter file
        $f = fopen($counter_name, "r");
        $counterVal = fread($f, filesize($counter_name));
        fclose($f);

        $counterVal++;
        $f = fopen($counter_name, "w");
        fwrite($f, $counterVal);
        fclose($f);

        view()->share(
            'pageViews', $counterVal
        );

        return $next($request);
    }

}
