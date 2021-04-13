<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'admin/api/login',
        'admin/api/signup',
        'admin/api/edit_footer',
        'admin/api/add_exhibition',
        'admin/api/edit_exhibition',
        'admin/api/delete_exhibition',
        'admin/api/file',
        'admin/api/edit_contact',
        'admin/api/edit_news',
        'admin/api/add_exhibition_type',
        'admin/api/edit_exhibition_type',
        'admin/api/delete_exhibition_type',
        'admin/api/add_link',
        'admin/api/edit_link',
        'admin/api/delete_link',
        '/api/contact'
    ];
}
