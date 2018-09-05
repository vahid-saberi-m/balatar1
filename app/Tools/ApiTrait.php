<?php
/**
 * Created by PhpStorm.
 * User: vahid
 * Date: 9/1/2018
 * Time: 6:27 PM
 */

namespace App\Tools;


trait ApiTrait
{
    /**
     * Authorize a given action for the current user.
     *
     * @param  mixed $ability
     * @param  mixed|array $arguments
     * @return void
     *
     */
    public function authorizeApi($ability, $arguments)
    {
//        dd($ability,$arguments);
        if (!request()->user('api')->can($ability, $arguments)) {
            abort(403, 'This action is unauthorized.');
        }
    }
}