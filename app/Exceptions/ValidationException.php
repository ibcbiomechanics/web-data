<?php namespace App\Exceptions;

use App\Http\ErrorResponse;

class ValidationException extends \Exception
{
    private $errors;

    public function __construct($errors, $message = "Validation error", $code = 0, \Exception $previous = null) {
        $this->setErrors($errors);
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return \Validator
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param \Validator $validator
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }


    public function throwResponseException(){
        ErrorResponse::throw422($this->errors);
    }


}