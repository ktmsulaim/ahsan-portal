<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sponsor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public static function totalAmountByBatch($camp, $batch, $received = null)
    {
        $data = DB::table('sponsors')
            ->select("users.batch", DB::raw('SUM(sponsors.amount) as amount'))
            ->join('users', 'sponsors.user_id', '=', 'users.id')
            ->where('users.batch', $batch)
            ->where('sponsors.campaign_id', $camp);

        if ($received !== null) {
            $data->where('sponsors.amount_received', $received);
        }

        $data = $data->groupBy('users.batch')
            ->first();

        return $data;
    }

    public static function batchWiseAmount($camp)
    {
        // return DB::table('users')
        //         ->select("users.batch", DB::raw('SUM(sponsors.amount) as amount'))
        //         ->leftJoin('sponsors', 'users.id', '=', 'sponsors.user_id')
        //         ->where('sponsors.campaign_id', $camp)
        //         ->groupBy('users.batch')
        //         ->orderBy('amount', 'desc')
        //         ->get();
        $batches = User::select('batch')->groupBy('batch')->orderBy('batch')->get();

        $data = [];

        if ($batches) {
            foreach ($batches as $key => $batch) {
                $batchAmount = collect(self::totalAmountByBatch($camp, $batch->batch));
                array_push($data, $batchAmount && count($batchAmount) ? $batchAmount : ['batch' => $batch->batch, 'amount' => 0]);
            }

            $data = collect($data)->sortBy('amount')->reverse()->toArray();
            return $data;
        }
    }

    public function refNo()
    {
        $ahsan = 'AHN';
        $camp = $this->code_gen($this->campaign->name);
        $id = sprintf("%04d", $this->id);

        return $ahsan . '/' . $camp . '/' . $id;
    }

    private function code_gen($string, $l = 3)
    {
        $results = ''; // empty string
        $vowels = array('a', 'e', 'i', 'o', 'u', 'y'); // vowels
        preg_match_all('/[A-Z][a-z]*/', ucfirst($string), $m); // Match every word that begins with a capital letter, added ucfirst() in case there is no uppercase letter
        foreach ($m[0] as $substring) {
            $substring = str_replace($vowels, '', strtolower($substring)); // String to lower case and remove all vowels
            $results .= preg_replace('/([a-z]{' . $l . '})(.*)/', '$1', $substring); // Extract the first N letters.
        }
        return strtoupper($results);
    }
}
