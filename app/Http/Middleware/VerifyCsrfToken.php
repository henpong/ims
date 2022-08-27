<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //Add URL Exceptions
        '*',
        '/admin/check_current_pswd','/admin/update_branch_status','/admin/update_section_status','/admin/update_category_status','/admin/append_categories_level',
        '/admin/update_bank_status','/admin/update_branches','/admin/update_supplier_status','/admin/update_mainwarehouse_status','/admin/update_products_in_branches_status',
        '/admin/lowstock_request_decision/','/sales/check_current_pswd','/admin/update_users_status',
    ];
}
