<?php

namespace App\Helper;

trait ImageableMultiple
{
    public function storeMultipleMedia($request,$dirpath,$dirpath2)
    {
    //  dd($request->file('logo'));
        $path = storage_path('app/public/'.$dirpath);

        $path2 = storage_path('app/public/'.$dirpath2);

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        if (!file_exists($path2)) {
            mkdir($path2, 0777, true);
        }


            $file = $request->file($dirpath);
            $file2 = $request->file($dirpath2);

            $fileName = uniqid() . '_' . trim(str_replace(" ","_",$file->getClientOriginalName()));
            $fileName2 = uniqid() . '_' . trim(str_replace(" ","_",$file2->getClientOriginalName()));
            $this->$dirpath = $fileName;
            $this->$dirpath2 = $fileName2;
            $this->save();

            $file->move($path, $fileName);
            $file2->move($path2, $fileName2);

            return $this;

    }
}
