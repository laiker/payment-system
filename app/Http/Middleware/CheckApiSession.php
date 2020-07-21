<?
namespace App\Http\Middleware;
use Illuminate\Http\Request;

use Closure;

class CheckApiSession
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->exists('sum') && !$request->session()->exists('purpose')) {
            return redirect('/');
        }

        return $next($request);
    }
}
