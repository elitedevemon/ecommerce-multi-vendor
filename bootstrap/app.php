<?php

use App\Http\Middleware\CartManagement;
use App\Http\Middleware\RoleManagement;
use App\Http\Middleware\WishlistManagement;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
  )
  ->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
      'role' => RoleManagement::class,
      'cart' => CartManagement::class,
      'wishlist' => WishlistManagement::class,
    ]);
  })
  ->withExceptions(function (Exceptions $exceptions) {
    //
  })->create();