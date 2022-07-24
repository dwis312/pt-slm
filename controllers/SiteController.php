<?php

namespace app\controllers;

use app\core\App;
use app\core\Controller;
use app\core\exception\ForbiddenException;
use app\core\Request;
use app\core\Response;
use app\models\Category_item;
use app\models\Category_unit;
use app\models\Data_item;
use app\models\EditModel;
use app\models\InputModel;
use app\models\ItemModel;
use app\models\LoginModel;
use app\models\Proses;
use app\models\ProsesModel;
use app\models\RegisterModel;
use app\models\Stock_itemModel;
use IntlChar;

class SiteController extends Controller
{
    public function index(Request $request, Response $response)
    {
        $this->setLayout('main');
        return $this->render('index');
    }

    public function dashboard(Request $request, Response $response)
    {
        if (!App::$app->user) $response->redirect('/login');
        $barang = new Stock_itemModel();

        $this->setLayout('dashboard');
        return $this->render('dashboard', [
            'barang' => $barang->stock()
        ]);
    }

    public function input(Request $request, Response $response)
    {
        $barang = new InputModel();
        $categories_item = new Category_item();
        $categories_unit = new Category_unit();

        if ($request->post()) {
            $barang->loadData($request->getData());

            if ($barang->valiadate() && $barang->insertData()) {
                App::$app->session->setFlash('success', 'Data berhasil ditambahkan');
                $response->redirect('/barang');
                return;
            }

            $this->setLayout('dashboard');
            return $this->render('input', [
                'barang' => $barang,
                'categories' => $categories_item->getKategori(),
                'categories_unit' => $categories_unit->getKategori()
            ]);
        }

        $this->setLayout('dashboard');
        return $this->render('input', [
            'barang' => $barang,
            'categories' => $categories_item->getKategori(),
            'categories_unit' => $categories_unit->getKategori()
        ]);
    }

    public function barang(Request $request, Response $response)
    {
        $barang = new InputModel();
        $row = count($barang->readPage());

        $limit = (isset($_COOKIE['limit'])) ? $_COOKIE['limit'] : 5;

        if ($request->post()) {
            unset($_COOKIE['limit']);
            setcookie('limit', $request->getData()['limit']);
            $response->redirect('/barang');
        }

        if ($limit === 'all') {
            setcookie('limit', '', time() - 1);
            unset($_COOKIE['limit']);
            $limit = $row;
        }

        $pageOf = ceil($row / $limit);
        $active = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $activePage = ($limit * $active) - $limit;


        $this->setLayout('dashboard');
        return $this->render('barang', [
            'barang' => $barang->readItems($activePage, $limit),
            'pageOf' => $pageOf,
            'active' => $active,
            'no' => $activePage,
            'limit' => $limit,
            'row' => $row,
        ]);
    }

    public function edit(Request $request, Response $response)
    {
        $model = new InputModel();
        $categories_item = new Category_item();
        $categories_unit = new Category_unit();

        if ($_GET['data'][0] !== '') {
            $this->setLayout('dashboard');
            return $this->render('edit', [
                'model' => $model->edit(),
                'categories' => $categories_item->getKategori(),
                'categories_unit' => $categories_unit->getKategori()
            ]);

            App::$app->session->setFlash('success', 'Data gagal dirubah');
            $response->redirect('/barang');
            return;
        } else {
            App::$app->session->setFlash('success', 'Ceklis data untuk merubah');
            $response->redirect('/barang');
            return;
        }
    }

    public function editSave(Request $request, Response $response)
    {
        $model = new InputModel();
        $categories_item = new Category_item();
        $categories_unit = new Category_unit();

        if ($request->post()) {
            $model->loadData($request->getData());

            if ($model->updateSave()) {

                App::$app->session->setFlash('success', 'Data berhasil dirubah');
                $response->redirect('/barang');
                return;
            }

            $this->setLayout('dashboard');
            return $this->render('edit', [
                'model' => $model,
                'categories' => $categories_item->getKategori(),
                'categories_unit' => $categories_unit->getKategori()
            ]);
        }

        $this->setLayout('dashboard');
        return $this->render('edit', [
            'model' => $model,
            'categories' => $categories_item->getKategori(),
            'categories_unit' => $categories_unit->getKategori()
        ]);
    }

    public function form_product(Request $request, Response $response)
    {
        $model = new ProsesModel();
        $categories_item = new Category_item();
        $categories_unit = new Category_unit();

        if ($request->post()) {
            $model->loadData($request->getData());

            if ($model->valiadate() && $model->startProses()) {
                App::$app->session->setFlash('success', 'Barang berhasil di proses');
                $response->redirect('/product');
                return;
            }

            $this->setLayout('dashboard');
            return $this->render('proses', [
                'model' => $model,
                'categories' => $categories_item->getKategori(),
                'categories_unit' => $categories_unit->getKategori()
            ]);
        }

        $this->setLayout('dashboard');
        return $this->render('proses', [
            'model' => $model,
            'categories' => $categories_item->getKategori(),
            'categories_unit' => $categories_unit->getKategori()
        ]);
    }

    public function data_product(Request $request, Response $response)
    {
        $model = new ProsesModel();

        $row = 5;
        $limit = (isset($_COOKIE['limit'])) ? $_COOKIE['limit'] : 5;


        $pageOf = ceil($row / $limit);
        $active = (isset($_GET['page'])) ? $_GET['page'] : 1;
        $activePage = ($limit * $active) - $limit;

        $this->setLayout('dashboard');
        return $this->render('data_proses', [
            'model' => $model->readProduct($activePage, $limit),
            'pageOf' => $pageOf,
            'active' => $active,
            'no' => $activePage,
            'limit' => $limit,
            'row' => $row,
        ]);
    }

    public function hapus(Request $request, Response $response)
    {
        $model = new InputModel();

        if ($_POST['data'][0] !== '') {
            $model->loadData($request->getData());
            if ($model->deleteItem()) {
                App::$app->session->setFlash('success', 'Data berhasil dihapus');
                $response->redirect('/barang');
                return;
            }
            App::$app->session->setFlash('success', 'Data gagal dihapus');
            $response->redirect('/barang');
            return;
        } else {
            App::$app->session->setFlash('success', 'Ceklis data untuk menghapus');
            $response->redirect('/barang');
            return;
        }
    }

    public function register(Request $request, Response $response)
    {
        if (App::isUser()) throw new ForbiddenException();

        $user = new RegisterModel;

        if ($request->post()) {
            $user->loadData($request->getData());

            if ($user->valiadate() && $user->newUser()) {
                $response->redirect('/login');
            }

            $this->setLayout('auth');
            return $this->render('register', [
                'user' => $user
            ]);
        }

        $this->setLayout('auth');
        return $this->render('register', [
            'user' => $user
        ]);
    }

    public function login(Request $request, Response $response)
    {
        if (App::isUser()) throw new ForbiddenException();

        $user = new LoginModel();

        if ($request->post()) {
            $user->loadData($request->getData());

            if ($user->valiadate() && $user->userLogin()) {
                $response->redirect('/dashboard');
                return;
            }

            $this->setLayout('auth');
            return $this->render('login', [
                'user' => $user
            ]);
        }

        $this->setLayout('auth');
        return $this->render('login', [
            'user' => $user
        ]);
    }

    public function logout()
    {
        App::$app->logout();
        App::$app->response->redirect('/');
    }
}
