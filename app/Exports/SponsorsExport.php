<?php

namespace App\Exports;

use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SponsorsExport implements FromView
{
    protected $campaign;
    protected $mode;
    protected $user_id;

    public function __construct($campaign, $mode, $user_id = null) {
        $this->campaign = $campaign;
        $this->mode = $mode;
        $this->user_id = $user_id;

    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $sponsors = null;

        if($this->mode == 'all') {
            $sponsors = Sponsor::where(['campaign_id' => $this->campaign->id])->get();
        } elseif($this->mode == 'member') {
            $user = User::find(auth()->id());

            if($user) {
                $sponsors = Sponsor::where(['campaign_id' => $this->campaign->id, 'user_id' => $user->id])->get();
            }
        } elseif($this->mode == 'admin.member' && $this->user_id) {
            $user = User::find($this->user_id);


            if($user) {
                $sponsors = Sponsor::where(['campaign_id' => $this->campaign->id, 'user_id' => $user->id])->get();
            }
        }

        return view('export.sponsors', [
            'sponsors' => $sponsors,
            'mode' => $this->mode
        ]);
    }
}
