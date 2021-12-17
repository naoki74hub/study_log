<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  
     /**
     * 状態定義
     */
    const STATUS = [
        1 => [ 'badge' => '未着手', 'class' => 'badge-danger rounded-pill'],
        2 => [ 'badge' => '着手中' , 'class' => 'badge-primary rounded-pill'],
        3 => [ 'badge' => '完了', 'class' => 'badge-success rounded-pill'],
    ];

    /**
     * 状態のラベル
     * @return string
     */
    public function getStatusBadgeAttribute()
    {
        // 状態値
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['badge'];
    }
    
    /**
     * 状態を表すHTMLクラス
     * @return string
     */
     public function getStatusClassAttribute()
     {
         // 状態値
         $status = $this->attributes['status'];
         // 定義されていなければ空文字を返す
         if (!isset(self::STATUS[$status])) {
             return '';
         }
         
         return self::STATUS[$status]['class'];
     }
}
