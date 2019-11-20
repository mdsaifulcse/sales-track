<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table='menu';
    protected $fillable=['name','url','status','serial_num','slug','icon_class','icon','big_icon','type'];

    public function subMenu(){
        return $this->hasMany(SubMenu::class,'fk_menu_id','id')->orderBy('serial_num','ASC')->where(['status'=>1,'type'=>1]);
    }
}
