<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Gallery extends Model
{
    public static function getAll() {
        // return [json_decode(Storage::disk('local')->get('json/gallery.json'), true)];
        return Gallery::all();
    }

    public static function find($id) {
        $galleries = self::all();

        foreach($galleries as $gallery) {
            if($gallery['id'] == $id) {
                return $gallery;
            }
        } 
    }
}
