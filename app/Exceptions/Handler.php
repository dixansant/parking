<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        return parent::render($request, $exception);


        $parse = parse_url(url()->full());
        //$ref = $parse['path'];
        $ref = strtolower('/'.$request->path());


        if ($this->isHttpException($exception) && $exception->getStatusCode() == 404) {
            if ($request->ajax()) {


                return response()->view(
                    'errors.json',
                    [
                        'details'=>'Link',
                        'ref' => $ref,

                    ],
                    200
                );
            }

            $home=substr($ref,0,5)=='/home'?'':'/home';
            return response()->redirectTo("/#!$home".$ref);

            /* Este error ocurre cuando el modelo que se busca no esta asociado*/
        } elseif ($exception instanceof ModelNotFoundException) {
            return response()->view(
                'errors.json',
                [
                    'details'=>'Info at',
                    //'ref' => $ref,
                    // 'path' => '/home',
                    'type_error'=>'error406'
                ],
                200
            );
        } elseif ($exception instanceof TokenMismatchException) {
            return response()->view(
                'errors.json',
                [
                    //'details'=>'The request at',
                    'ref' => '/home',
                    'desc_error'=> __('The session has expired'),
                    //'type_error'=>'error707',
                    'description' => 'errors.session_expired_information',
                    'homepath'=>'!/home'
                ],
                200
            );
        }




        return parent::render($request, $exception);
    }
}
