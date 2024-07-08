<?php

namespace App\Helper;

use Carbon\Carbon;
use App\Models\Kalender;
use Illuminate\Support\Facades\Http;

class helper
{

    public static function timeToSeconds($time)
    {
        $time =  explode(':', $time);
        return $time[0] * 3600 + $time[1] * 60;
    }

    public static function timeToString($int)
    {
        $h = floor($int / 3600); //Get whole hours
        $int -= $h * 3600;
        $m = floor($int / 60); //Get remaining minutes
        $int -= $m * 60;
        // $int =  explode(':', $int);
        // dump($h,$m);
        return ($h < 10 ? '0' . $h : $h) . ":" . ($m < 10 ? '0' . $m : $m) . ":00";
    }

    public static function setIstirahat($data)
    {
        $collect = collect($data)->map->only('mulai', 'selesai');
        //convert string to seconds
        $time = [];
        foreach ($collect as $val) {
            $time[] = [Helper::timeToSeconds($val['mulai']), Helper::timeToSeconds($val['selesai'])];
        }

        //flatten
        $result = collect($time)->flatten(1);
        //ambil jam yang kosong
        $flat = [];
        for ($i = 0; $i < count($result); $i++) {
            if ($i < count($result) - 2) {
                for ($y = $i += 1; $y < $i + 1; $y++) {

                    if ($result[$i] != $result[$y + 1]) {
                        // dump($result[$i],$result[$y+1]);

                        $flat[] = [$result[$i], $result[$y + 1]];
                    }
                }
                // $i += 1;
            }
        }

        //second to time string
        $timeToString = [];
        for ($i = 0; $i < count($flat); $i++) {
            // dd());
            for ($j = 0; $j < count($flat[$i]); $j++) {
                $d = [

                    'mulai' => Helper::timeToString($flat[$i][$j]), 'selesai' => Helper::timeToString($flat[$i][$j += 1]), 'mapel' => 'Istirahat', 'guru' => 'Istirahat'
                ];
                $timeToString[] = $d;
            }
        }
        //gabungkan dataawal dan data istirahat
        $push = $data;
        if ($timeToString) {
            $push = collect($data)->merge(collect($timeToString));
        }

        return $push;
    }

    public static function DecodeImage($nameDir, $imageName)
    {
        $path = public_path('storage/' . $nameDir . '/' . $imageName);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $dataimage = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($dataimage);
        return $base64;
    }

    public static function getApiLibur()
    {
        $date = Carbon::now();
        $year = $date->format('Y');
        // dd($date->format('m'));
        for ($i = 0; $i <= 12; $i++) {
            $response =  Http::get('https://api-harilibur.vercel.app/api?month=' . $i . '&year=' . $year);
            $res = json_decode($response->getBody()->getContents());
            if ($response->getStatusCode() == 200) {
                foreach ($res as  $r) {
                    if ($r->is_national_holiday) {
                        $eventExist =  Kalender::query()
                            ->where('start', Carbon::parse($r->holiday_date))
                            ->where('end', Carbon::parse($r->holiday_date))
                            ->first();
                        if (!$eventExist) {
                            Kalender::create([
                                'title' => $r->holiday_name,
                                'start' => Carbon::parse($r->holiday_date),
                                'end' => Carbon::parse($r->holiday_date),
                            ]);
                        }
                    }
                }
            } else {
                throw new \Exception("Gagal Ambil Data Libur", 500);
            }
        }
    }

    public  static function pushFCM(array $recipients, array $notification, array $data)
    {
        // $recipients = [
        //     'caHT8m68SKOF****'
        // ];
        return  fcm()
            // ->toTopic('all') // $topic must an string (topic name)
            ->to($recipients)
            ->priority('high')
            ->timeToLive(0)
            ->notification($notification)
            ->data($data)
            ->enableResponseLog()
            ->send();
    }

    public static function generateInvoice($inv, $index, $nis, $kelas, $taja)
    {

        // if (! $latest) {
        //     return 'arm0001';
        // }

        // $string = preg_replace("/[^0-9\.]/", '', $latest->invoice_number);

        return $inv . sprintf('%04d', $index + 1) . '/' . $nis . '/' . $kelas . '/' . $taja;
    }
}
