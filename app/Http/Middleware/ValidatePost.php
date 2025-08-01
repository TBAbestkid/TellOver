<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidatePost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rules = [
            //'title' => 'nullable|string|max:255',
            'body' => 'required|string',
            'visibility' => 'required|in:public,friends,private',
            'images.*' => 'nullable|image|max:2048',
            'allow_comments' => 'sometimes|boolean',
        ];

        $validated = $request->validate($rules);

        return $next($request);
    }
}
