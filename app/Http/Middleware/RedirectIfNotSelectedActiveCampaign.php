<?php

namespace App\Http\Middleware;

use App\Models\Campaign;
use App\Models\UserCampaign;
use Closure;
use Illuminate\Http\Request;

class RedirectIfNotSelectedActiveCampaign
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $activeCampaign = Campaign::current();

        if($activeCampaign && !UserCampaign::where(['user_id' => $request->user()->id, 'campaign_id' => $activeCampaign->id])->exists()) {
            return redirect()->route('user.campaigns.chooseLocation');
        }

        return $next($request);
    }
}
