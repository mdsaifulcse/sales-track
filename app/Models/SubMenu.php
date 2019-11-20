<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    protected $table='sub_menu';
    protected $fillable=['name','url','name_bn','status','serial_num','fk_menu_id','slug','icon','big_icon','type'];

    public function subSubMenu(){
        return $this->hasMany(SubSubMenu::class,'fk_sub_menu_id','id')->orderBy('serial_num','ASC')->where(['status'=>1,'type'=>1]);
    }
}
