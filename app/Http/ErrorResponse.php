<?php namespace App\Http;

use App\Exceptions\ResponseException;
use Lang;

abstract class ErrorCode
{
    const e400 = 400;
    const MEDIUM = 'MEDIUM';
    const SMALL = 'SMALL';
}

class ErrorResponse {

    /**
     * Lazador de exepcion generico.
     *
     * @param int $code codigo del error
     * @param type $message mensaje del error
     * @trow JSON response
     */
    private static function genericThrow($code, $name, $message){
        $exception = new ResponseException();
        $exception->setResponse(response()->json(['errors' => array(['code' => $code, 'name' => $name, 'message' => $message])], $code, [] ,JSON_UNESCAPED_UNICODE));
        throw $exception;
    }

    /**
     * Lanzador de excepcion si la condición es valida
     */
    private static function genericThrowIf($code, $name, $message, $result){
        if($result){
            self::genericThrow($code, $name, $message);
        }
    }

    /**
     * 400 Bad Request – [Petición Errónea]
     * La petición está malformada, como por ejemplo, si el contenido no fue bien parseado.
     * El error se debe mostrar también en el JSON de respuesta.
     *
     * @param type $message
     * @trow JSON response
     */
    public static function throw400($message = null){
        self::genericThrow(400, 'Bad Request', $message == null ? Lang::get('responses.400') : $message);
    }

    /**
     *
     * @param boolean $result resultado de la condicón que hace que se lance la exepción o no.
     * @param type $message
     */
    public static function throw400If($result, $message = null){
        self::genericThrowIf(400, 'Bad Request', $message == null ? Lang::get('responses.400') : $message, $result);
    }

    /**
     * 401 Unauthorized – [Desautorizada]
     * Cuando los detalles de autenticación son inválidos o no son otorgados. También útil
     * para disparar un popup de autorización si la API es usada desde un navegador.
     *
     * @param type $message
     */
    public static function throw401($message = null){
        self::genericThrow(401, 'Unauthorized' , $message == null ? Lang::get('responses.401') : $message);
    }

    /**
     *
     * @param boolean $result resultado de la condicón que hace que se lance la exepción o no.
     * @param type $message
     */
    public static function throw401If($result, $message = null){
        self::genericThrowIf(401, 'Unauthorized', $message == null ? Lang::get('responses.401') : $message, $result);
    }

    /**
     * 403 Forbidden – [Prohibida]
     * Cuando la autenticación es exitosa pero el usuario no tiene permiso al recurso en cuestión.
     *
     * @param type $message
     */
    public static function throw403($message = null){
        self::genericThrow(403, 'Forbidden' , $message == null ? Lang::get('responses.403') : $message);
    }

    /**
     *
     * @param boolean $result resultado de la condicón que hace que se lance la exepción o no.
     * @param type $message
     */
    public static function throw403If($result, $message = null){
        self::genericThrowIf(403, 'Forbidden', $message == null ? Lang::get('responses.403') : $message, $result);
    }

    /**
     * 404 Not Found – [No encontrada]
     * Cuando un recurso se solicita un recurso no existente.
     * @param type $message
     */
    public static function throw404($message = null){
        self::genericThrow(404, 'Not Found' , $message == null ? Lang::get('responses.404') : $message);
    }

    /**
     *
     * @param boolean $result resultado de la condicón que hace que se lance la exepción o no.
     * @param type $message
     */
    public static function throw404If($result, $message = null){
        self::genericThrowIf(404, 'Not Found', $message == null ? Lang::get('responses.404') : $message, $result);
    }

    /**
     * 405 Method Not Allowed – [Método no permitido]
     * Cuando un método HTTP que está siendo pedido no está permitido para el usuario autenticado.
     *
     * @param type $message
     */
    public static function throw405($message = null){
        self::genericThrow(405, 'Method Not Allowed' , $message == null ? Lang::get('responses.405') : $message);
    }

    /**
     *
     * @param boolean $result resultado de la condicón que hace que se lance la exepción o no.
     * @param type $message
     */
    public static function throw405If($result, $message = null){
        self::genericThrowIf(405, 'Method Not Allowed', $message == null ? Lang::get('responses.405') : $message, $result);
    }

    /**
     * 409 Conflict - [Conflicto]
     * Cuando hay algún conflicto al procesar una petición, por ejemplo en PATCH, POST o DELETE.
     *
     * @param type $message
     */
    public static function throw409($message = null){
        self::genericThrow(409, 'Conflict' , $message == null ? Lang::get('responses.409') : $message);
    }

    /**
     *
     * @param boolean $result resultado de la condicón que hace que se lance la exepción o no.
     * @param type $message
     */
    public static function throw409If($result, $message = null){
        self::genericThrowIf(409, 'Conflict', $message == null ? Lang::get('responses.409') : $message, $result);
    }

    /**
     * 410 Gone – [Retirado]
     * Indica que el recurso en ese endpoint ya no está disponible. Útil como una respuesta en
     * blanco para viejas versiones de la API
     *
     * @param type $message
     */
    public static function throw410($message = null){
        self::genericThrow(410, 'Gone' , $message == null ? Lang::get('responses.4010') : $message);
    }

    /**
     *
     * @param boolean $result resultado de la condicón que hace que se lance la exepción o no.
     * @param type $message
     */
    public static function throw410If($result, $message = null){
        self::genericThrowIf(410, 'Gone', $message == null ? Lang::get('responses.410') : $message, $result);
    }

    /**
     * 415 Unsupported Media Type – [Tipo de contenido no soportado]
     * Si el tipo de contenido que solicita la petición es incorrecto
     *
     * @param type $message
     */
    public static function throw415($message = null){
        self::genericThrow(415, 'Unsupported Media Type' , $message == null ? Lang::get('responses.415') : $message);
    }

    /**
     *
     * @param boolean $result resultado de la condicón que hace que se lance la exepción o no.
     * @param type $message
     */
    public static function throw415If($result, $message = null){
        self::genericThrowIf(415, 'Unsupported Media Type', $message == null ? Lang::get('responses.415') : $message, $result);
    }

    /**
     * 422 Unprocessable Entity – [Entidad improcesable]
     * Utilizada para errores de validación, o cuando por ejemplo faltan campos en una petición.
     *
     * @param type $message
     */
    public static function throw422($message = null){
        self::genericThrow(422, 'Unprocessable Entity' , $message == null ? Lang::get('responses.422') : $message);
    }

    /**
     *
     * @param boolean $result resultado de la condicón que hace que se lance la exepción o no.
     * @param type $message
     */
    public static function throw422If($result, $message = null){
        self::genericThrowIf(422, 'Unprocessable Entity', $message == null ? Lang::get('responses.422') : $message, $result);
    }

    /**
     * 429 Too Many Requests – [Demasiadas peticiones]
     * Cuando una petición es rechazada debido a la tasa límite .
     *
     * @param type $message
     */
    public static function throw429($message = null){
        self::genericThrow(429, 'Unauthorized' , $message == null ? Lang::get('responses.429') : $message);
    }

    /**
     *
     * @param boolean $result resultado de la condicón que hace que se lance la exepción o no.
     * @param type $message
     */
    public static function throw429If($result, $message = null){
        self::genericThrowIf(429, 'Unauthorized', $message == null ? Lang::get('responses.429') : $message, $result);
    }

    /**
     * 500 – Internal Server Error – [Error Interno del servidor]
     * Los desarrolladores de API NO deberían usar este código. En su lugar se debería
     * loguear el fallo y no devolver respuesta.
     *
     * @param type $message
     */
    public static function throw500($message = null){
        self::genericThrow(500, 'Unauthorized' , $message == null ? Lang::get('responses.500') : $message);
    }

    /**
     *
     * @param boolean $result resultado de la condicón que hace que se lance la exepción o no.
     * @param type $message
     */
    public static function throw500If($result, $message = null){
        self::genericThrowIf(500, 'Unauthorized', $message == null ? Lang::get('responses.500') : $message, $result);
    }
}