<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authRepository;

    function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * This function registers a user and returns a response with the user's information or an error
     * message if something goes wrong.
     *
     * @param UserRequest request  is an instance of the UserRequest class, which is a custom
     * request class that contains validation rules and messages for registering a new user. It is used
     * to validate the incoming request data before processing it further.
     *
     * @return If the registration is successful, the function will return a response with the
     * registered user data and a status code of 200. If there is an exception thrown during the
     * registration process, the function will return an error response with a message indicating that
     * something went wrong, the error message, and the line number where the error occurred.
     */
    public function register(UserRequest $request)
    {
        try {
            $user = $this->authRepository->register($request);
            return response([$user], 200);
        } catch (\Exception $ex) {
            return  response([ "Algo salio mal al registrar el usuario", "error" => $ex->getMessage(), "line" => $ex->getCode()
            ]);
        }
    }


   /**
    * This function handles user login and returns a token if successful, otherwise it returns an error
    * message.
    *
    * @param Request request  is an object of the Request class which contains the data sent by
    * the client in the HTTP request. It can contain information such as form data, query parameters,
    * headers, and more. In this specific function, the  object is passed to the login method
    * of the authRepository to authenticate the
    *
    * @return a response with a token if the login is successful, or a response with an error message
    * and the exception details if there is an error during the login process.
    */
    public function login(Request $request)
    {
        try {
            $sesion = $this->authRepository->login($request);
            return response(["token" => $sesion]);
        } catch (\Exception $ex) {
            return  response(["message" => "Algo salio mal al registrar el usuario"] . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }


    /**
     * This function logs out a user and returns a response message.
     *
     * @param Request request  is an instance of the Request class, which contains the data and
     * information about the HTTP request made to the server. It includes information such as the
     * request method, headers, and any data sent in the request body. In this specific function, the
     *  parameter is used to pass the user's
     *
     * @return a response with a message indicating whether the logout was successful or not. If an
     * exception is caught, the message will indicate that something went wrong and will include the
     * error message and line number.
     */
    public function logout(Request $request)
    {
        try {
            $user = $this->authRepository->logout($request);
            return  response(["message" => "Cierre de sesión"]);
        } catch (\Exception $ex) {
            return  response(["message" => "Algo salio mal al registrar el usuario"]  . $ex->getMessage() . ' linea ' . $ex->getCode());
        }
    }
}
