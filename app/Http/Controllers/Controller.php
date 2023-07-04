<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function confirmDeleteSweetalert(): Void
    {
        $title = 'Are you sure?';
        $text = "You won't be able to revert this!";
        confirmDelete($title, $text);
    }
}
