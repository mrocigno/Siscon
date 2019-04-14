<?php


namespace App\Utils;

use App\Status;

class StatusUltil
{
    public static function getStatus($status_id, $simple = false){
        if(!is_null($status_id)){
            $status = $simple? '' : Status::query()->findOrFail($status_id);
            switch ($status_id){
                case 1:{
                    return [
                        'id' => 1,
                        'class' => 'executed',
                        'icon' => '<i class="fas fa-check-circle"></i>',
                        'status' => $simple? '' : $status->status,
                        'description' => $simple? '' : $status->description
                    ];
                }
                case 2:{
                    return [
                        'id' => 2,
                        'class' => 'not-executed',
                        'icon' => '<i class="fas fa-times-circle"></i>',
                        'status' => $simple? '' : $status->status,
                        'description' => $simple? '' : $status->description
                    ];
                }
                case 3:{
                    return [
                        'id' => 3,
                        'class' => 'return',
                        'icon' => '<i class="fas fa-undo-alt"></i>',
                        'status' => $simple? '' : $status->status,
                        'description' => $simple? '' : $status->description
                    ];
                }
                case 4:{
                    return [
                        'id' => 4,
                        'class' => 'delivered',
                        'icon' => '<i class="fas fa-clock"></i>',
                        'status' => $simple? '' : $status->status,
                        'description' => $simple? '' : $status->description
                    ];
                }
                case 5:{
                    return [
                        'id' => 5,
                        'class' => 'ready',
                        'icon' => '<i class="fas fa-check-double"></i>',
                        'status' => $simple? '' : $status->status,
                        'description' => $simple? '' : $status->description
                    ];
                }
                case 6:{
                    return [
                        'id' => 6,
                        'class' => 'not-ready',
                        'icon' => '<i class="fas fa-check"></i>',
                        'status' => $simple? '' : $status->status,
                        'description' => $simple? '' : $status->description
                    ];
                }
            }
        }
    }
}