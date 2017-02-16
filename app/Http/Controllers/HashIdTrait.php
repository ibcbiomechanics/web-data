<?php  namespace App\Http\Controllers;

use Vinkla\Hashids\Facades\Hashids;
use App\Http\ErrorResponse;

trait HashIdTrait{
    /**
     * Transforms ID value
     *
     * @param int|string $value
     */
    public function id($value){
        try{
            return Hashids::decode($value)[0];
        }catch (\Exception $e){
            ErrorResponse::throw404();
        }

    }
}