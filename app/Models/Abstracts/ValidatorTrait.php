<?php namespace App\Models\Abstracts;

use App\Exceptions\ValidationException;
use Vinkla\Hashids\Facades\Hashids;
use Validator;

trait ValidatorTrait
{
    /**
     * @param bool $req si hay valores obligatorios
     * @param bool $unique si hay valores unicos
     * @return array con los valores obligatorios marcados
     */
    public function getRules($req = false, $unique = false){
        if(!$req && !$unique){
            return $this->rules;
        }

        $ret = array();
        foreach ($this->rules as $key => $value){
            //Valores requeridos
            if($this->reqRules != NULL && $req) {
                if (in_array($key, $this->reqRules)) {
                    $ret[$key] = $value . "|required";
                } else if(!array_key_exists($key, $ret)){
                    $ret[$key] = $value;
                }
            }
            //Llaves unicas
            if($this->uniqueRules != NULL && $unique){
                if (array_key_exists($key, $this->uniqueRules)) {
                    if(array_key_exists($key, $ret)){
                        $ret[$key] = $ret[$key] . "|".$this->uniqueRules[$key];
                    }else{
                        $ret[$key] = $value . "|".$this->uniqueRules[$key];
                    }

                } else if(!array_key_exists($key, $ret)){
                    $ret[$key] = $value;
                }
            }

        }

        return $ret;
    }


    /**
     * Valida los datos del modelo
     * @param bool $required
     * @param bool $unique
     * @throws ValidationException
     */
    public function validate($required = true, $unique = true){
        $validator = Validator::make($this->toArray() , $this->getRules($required, $unique));
        if($validator->fails()){
            throw new ValidationException($validator->errors()->messages());
        }

    }

    /**
     * Validate model before save
     *
     * @param array $options
     *
     * @see Illuminate\Database\Eloquent\Model->save()
     */
    public function save(array $options = array()) {
        $this->validate(true, true);
        return parent::save($options);
    }

    /**
     * Validate model before update
     *
     * @param array $attributes
     * @param array $options
     *
     * @see Illuminate\Database\Eloquent\Model->update()
     * @return bool
     */
    public function update(array $attributes = array(), array $options = array()) {
        $this->fill($attributes);
        $this->validate(true, false);

        if (!$this->exists) {
            return false;
        }

        return parent::save($options);
    }
}