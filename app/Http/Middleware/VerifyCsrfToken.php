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
        // 'api/*',
        '/admin/banners','/admin/banners/*', '/admin/banners/restore/*',
        '/admin/classes','/admin/classes/*', '/admin/classes/restore/*',
        '/admin/subjects','/admin/subjects/*', '/admin/subjects/restore/*',
        '/admin/chapters','/admin/chapters/*', '/admin/chapters/restore/*',
        '/admin/questions','/admin/questions/*', '/admin/questions/restore/*',
        '/admin/enrollments','/admin/enrollments/*', '/admin/enrollments/restore/*',
        '/admin/notes','/admin/notes/*', '/admin/notes/restore/*',
        '/admin/doubt-sessions','/admin/doubt-sessions/*', '/admin/doubt-sessions/restore/*',
        '/admin/tests','/admin/tests/*', '/admin/tests/restore/*',
        '/admin/written-submissions','/admin/written-submissions/*', '/admin/written-submissions/restore/*',
        '/admin/mcq-submissions','/admin/mcq-submissions/*', '/admin/mcq-submissions/restore/*',
        '/admin/written-results','/admin/written-results/*', '/admin/written-results/restore/*',
        '/admin/mcq-results','/admin/mcq-results/*', '/admin/mcq-results/restore/*',
        '/admin/notifications','/admin/notifications/*', '/admin/notifications/restore/*',
    ];
}
