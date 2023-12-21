<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    public static function getText($locale) {
      $about_text = About::first();

      if ($locale == 'ja') {
        return $about_text->getAttribute('about-text-ja');
      } else {
        return $about_text->getAttribute('about-text-en');
      }

    }
}