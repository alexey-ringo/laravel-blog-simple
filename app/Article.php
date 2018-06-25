<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Article extends Model
{
    // Mass assigned
    protected $fillable = ['title', 'slug', 'description_short', 'description', 'image', 'image_show', 
    'meta_title', 'meta_description', 'meta_keyword', 'published', 'created_by', 'modified_by'];
    
    // Mutators - преобразователь значения полей перед записью в БД
    //автоматическое формирование уникального значения поля slug из title
    //'set' - установить наименование, 'Slug' - название поля и Attribute. В соответсвии со стандартом
    public function setSlugAttribute($value) {
        //Второй параметр для Str::slug - что будем использовать вместо пробелов при генерации Slug
        $this->attributes['slug'] = Str::slug( mb_substr($this->title, 0, 40) . "-" . \Carbon\Carbon::now()->format('dmyHi'), '-');
    }
    
    //Polimorphic relations with categories
    public function morphCategoriesToMany() {
        //'categoriable' - префикс для связных таблиц в названии полей таблицы categoryables
        return $this->morphToMany('App\Category', 'categoryable');
    }
}
