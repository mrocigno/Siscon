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
                        'class' => 'executed',
                        'icon' => '<i class="fas fa-check-circle"></i>',
                        'status' => $simple? '' : $status->status,
                        'description' => $simple? '' : $status->description
                    ];
                }
                case 2:{
                    return [
                        'class' => 'not-executed',
                        'icon' => '<i class="fas fa-times-circle"></i>',
                        'status' => $simple? '' : $status->status,
                        'description' => $simple? '' : $status->description
                    ];
                }
                case 3:{
                    return [
                        'class' => 'return',
                        'icon' => '<i class="fas fa-undo-alt"></i>',
                        'status' => $simple? '' : $status->status,
                        'description' => $simple? '' : $status->description
                    ];
                }
                case 4:{
                    return [
                        'class' => 'delivered',
                        'icon' => '<i class="fas fa-clock"></i>',
                        'status' => $simple? '' : $status->status,
                        'description' => $simple? '' : $status->description
                    ];
                }
                case 5:{
                    return [
                        'class' => 'ready',
                        'icon' => '<i class="fas fa-check-double"></i>',
                        'status' => $simple? '' : $status->status,
                        'description' => $simple? '' : $status->description
                    ];
                }
                case 6:{
                    return [
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