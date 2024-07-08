<?php

namespace App\Helper;

trait ImageableDynamic
{
    public function storeMediaDynamic($request,$dirpath,$name)
    {
// dd($request,$name);
        $path = storage_path('app/public/'.$dirpath);

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

         if ($request->hasfile($name)) {
            $file = $request->file($name);

            $fileName = uniqid() . '_' . trim(str_replace(" ","_",$file->getClientOriginalName()));

            $this->$name = $fileName;
            //  $this->title=$request->title;
            //  $this->description=$request->description;
            //  ($name == 'logo')?$this->favicon=$request->favicon:$this->logo=$request->logo;
            $this->save();

            $file->move($path, $fileName);

            return $this;
         }
    }
}
