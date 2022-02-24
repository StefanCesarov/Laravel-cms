<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Category;

class CheckCategoryCcreated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(Category::all()->count()<1)
        {
            session()->flash('error', "Must create category before post!");
            return redirect('categories/create');
        }

        return $next($request);
    }
}
