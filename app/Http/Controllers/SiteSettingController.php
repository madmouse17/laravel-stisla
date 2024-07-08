<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Repositories\settingRepository\SettingInterface;

class SiteSettingController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function show(SiteSetting $siteSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteSetting $siteSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SiteSetting  $sitesetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteSetting $sitesetting)
    {

        //  dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'favicon' => 'image|max:2000',
            'logo' => 'image|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->has('logo')  && $request->has('favicon')) {
            $this->Ubah($sitesetting, [
                    'title' => $request->title,
                    'description' => $request->description,
                    'logo' => ($request->logo) ? $request->logo : null,
                    'favicon' => ($request->favicon) ? $request->favicon : null,
                ])->storeMultipleMedia($request, 'logo', 'favicon');
        } else if ($request->has('favicon')) {
            // dd($request->all());
            $aa = $this->Ubah($sitesetting, [
                    'title' => $request->title,
                    'description' => $request->description,
                    'logo' => ($request->logo) ? $request->logo : null,
                    'favicon' => ($request->favicon) ? $request->favicon : null,
                ])->storeMediaDynamic($request, 'favicon', 'favicon');
        } else if ($request->has('logo')) {
            $this->Ubah($sitesetting, [
                    'title' => $request->title,
                    'description' => $request->description,
                    'logo' => ($request->logo) ? $request->logo : null,
                    'favicon' => ($request->favicon) ? $request->favicon : null,
                ])->storeMediaDynamic($request, 'logo', 'logo');
        } else {
            // dd($request->all());
            $this->Ubah($sitesetting, [
                    'title' => $request->title,
                    'description' => $request->description,
                    'logo' => ($request->logo) ? $request->logo : null,
                    'favicon' => ($request->favicon) ? $request->favicon : null,
                ]);
        }


        return redirect()
            ->route('setting.index')
            ->with('message', 'Data Berhasil DiUbah');
    }

    private function Ubah(SiteSetting $setting, array $data)
    {

        switch ($data) {
            case $data['favicon'] != null && $data['logo'] != null:
                $setting->update(
                    [
                        'title' => $data['title'],
                        'description' => $data['description'],
                        'favicon' => $data['favicon'],
                        'logo' => $data['logo'],
                    ]
                );

                // dd($setting);
                return  $setting;
                break;
            case $data['favicon'] != null:

                $setting->update(
                    [
                        'title' => $data['title'],
                        'description' => $data['description'],
                        'favicon' => $data['favicon'],
                    ]
                );
                return $setting;
                break;
            case $data['logo'] != null:

                $setting->update(
                    [
                        'title' => $data['title'],
                        'description' => $data['description'],
                        'logo' => $data['logo'],
                    ]
                );
                return $setting;
                break;

            default:

                $setting->update(
                    [
                        'title' => $data['title'],
                        'description' => $data['description'],

                    ]
                );
                return $setting;
                break;
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SiteSetting  $siteSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteSetting $siteSetting)
    {
        //
    }
}
