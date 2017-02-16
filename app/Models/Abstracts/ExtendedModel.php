<?php namespace App\Models\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class ExtendedModel extends Model {

    protected $appends = ['uid'];

    protected static $tableName;
    public static function tableName(){
        return static::$tableName;
    }

    /**
     * Hago el hash de todos las id de todos los modelos.
     * @param $value
     * @return mixed
     */
    public function getUidAttribute() {
        try{
            return Hashids::encode($this->attributes['id']);
        }catch (\Exception $e){
            return null;
        }
    }

    /**
     * Elimina las llaves foraneas que aparecen en la table pivote.
     * @param $response
     * @param $relation_name
     * @param $id1
     * @param $id2
     * @return mixed
     */
    protected function removePivotIds($response,$relation_name, $id1, $id2){
        foreach($response[$relation_name] as $key => $value) {
            unset($value['pivot'][$id1]);
            unset($value['pivot'][$id2]);
            $attributes[$relation_name][$key] = $value;
        }
        return $response;
    }
}