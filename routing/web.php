<?php

use app\core\Router;
use app\controllers\SiteController;

Router::get('/', [SiteController::class, 'index']);

Router::get('/login', [SiteController::class, 'login']);

Router::post('/login', [SiteController::class, 'login']);

Router::get('/register', [SiteController::class, 'register']);

Router::post('/register', [SiteController::class, 'register']);

Router::get('/logout', [SiteController::class, 'logout']);

Router::post('/logout', [SiteController::class, 'logout']);

Router::get('/dashboard', [SiteController::class, 'dashboard']);

Router::get('/input', [SiteController::class, 'input']);

Router::post('/input', [SiteController::class, 'input']);

Router::get('/barang', [SiteController::class, 'barang']);

Router::post('/barang', [SiteController::class, 'barang']);

Router::post('/barang/hapus', [SiteController::class, 'hapus']);

Router::get('/barang/edit', [SiteController::class, 'edit']);

Router::post('/barang/edit', [SiteController::class, 'editSave']);

Router::get('/product', [SiteController::class, 'data_product']);

Router::get('/product/item', [SiteController::class, 'form_product']);

Router::post('/product/item', [SiteController::class, 'form_product']);
