<?php

use app\core\App;

?>
<div class="container">
    <div class="row d-flex justify-content-between align-items-center mb-3">
        <h5 class="fs-6 col-auto">
            <small class="fw-normal text-secondary">Data barang masuk :</small>
        </h5>

        <div class="pull-right col-auto">
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary d-flex justify-content-center align-items-center gap-2"><i class='bx bxs-spreadsheet'></i> excel</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary d-flex justify-content-center align-items-center gap-2"><i class='bx bx-printer'></i> pdf</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-between align-items-center mb-4">
        <div class="col-auto d-flex justify-content-center align-items-center gap-2">
            <small>Show</small>
            <form action="" method="POST" class="form-entry">
                <select class="form-select form-select-sm entry" name="limit">
                    <option value="<?= $limit; ?>"><?= ($limit === 5) ? '5' : $limit; ?></option>
                    <option value="5">5</option>
                    <option value="8">8</option>
                    <option value="10">10</option>
                    <option value="all">All</option>
                </select>
            </form>
            Entries of <b><?= $row; ?></b> row
        </div>
        <form class="form-cari col-auto d-flex gap-1" action="" method="POST">
            <div class="col-auto">
                <input type="text" name="cari" id="keyword-cari" class="form-control form-control-sm" placeholder="Cari..">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary btn-sm" id="cari"><i class='bx bx-search'></i></button>
            </div>
        </form>
    </div>

    <div class="row mb-4">
        <div class="col-auto d-flex justify-content-between align-items-center gap-3">
            <a href="/product/item" class="btn btn-primary btn-sm"><i class='bx bx-plus'></i> Input Produksi</a>
        </div>
    </div>

    <?php if (App::$app->session->getFlash('success')) : ?>
        <div class="row mb-3">
            <div class="col-8 mx-auto alert alert-warning alert-dismissible fade show" role="alert">
                <span class="d-block text-center text-dark"><?= App::$app->session->getFlash('success'); ?></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!$model) : ?>
        <h5 class="text-center fst-italic text-secondary mt-5 p-4 border-bottom border-top">Record data barang masih kosong</h5>
    <?php else : ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover table-sm">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Kode Produksi</th>
                        <th>Barang Produksi</th>
                        <th>Qty</th>
                        <th>Sat</th>
                        <th>Tanggal Produksi</th>
                        <th>Keteranggan</th>
                    </tr>
                </thead>
                <tbody class="body">
                    <span class="src">

                        <?php $i = $no + 1;
                        foreach ($model as $br) : ?>

                            <tr class="fw-light text-center">
                                <td>
                                    <div class="form-check d-flex justify-content-center gap-3">
                                        <input class="form-check-input checkbox" type="checkbox" id="<?= $br['pr_item_id']; ?>">
                                        <label class="form-check-label" for="<?= $br['pr_item_id']; ?>">
                                            <?= $i++; ?>.
                                        </label>
                                        <button type="submit" class="btn_delete"></button>
                                    </div>
                                </td>
                                <td><?= $br['pr_item_id']; ?></td>
                                <td><?= $br['pr_item_name']; ?></td>
                                <td><?= $br['pr_item_name']; ?></td>
                                <td><?= $br['pr_item_value']; ?></td>
                                <td><?= $br['ct_unit_name']; ?></td>
                                <td><?= date("d F Y", strtotime($br['pr_item_date'])) ?></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>

                </tbody>
            </table>
            <div class="d-flex mb-4">
                <form action="" method="GET" class="form d-flex justify-content-between w-75">
                    <input type="hidden" name="data[]" class="data">
                    <div class="d-flex justify-content-start gap-3">
                        <button type="submit" class="btn btn-sm btn-warning edit d-flex justify-content-center align-items-center gap-1 mx-auto text-primary"><i class='bx bx-pencil'></i><small>Edit</small> </button>
                        <button type="submit" class="btn btn-sm btn-danger" id="hapus"><i class='bx bx-trash'></i> Hapus</button>
                    </div>
                    <button type="submit" class="btn btn-sm btn-success px-5" id="proses"><i class='bx bx-cog'></i> Proses</button>
                </form>
            </div>
            </span>


        </div>


        <nav aria-label="Page navigation example">
            <ul class="mb-5 pagination pagination-sm justify-content-end">
                <li class="page-item">
                    <?php if ($active > 1) : ?>
                        <a class="page-link" href="?page=<?= $active - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    <?php endif; ?>
                </li>
                <?php if ($pageOf > 1) : ?>
                    <?php for ($p = 1; $p <= $pageOf; $p++) : ?>

                        <?php if ($p == $active) : ?>
                            <li class="page-item active"><a class="page-link" href="?page=<?= $p; ?>"><?= $p; ?></a></li>
                        <?php else : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $p; ?>"><?= $p; ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                <?php endif; ?>

                <li class="page-item">
                    <?php if ($active < $pageOf) : ?>
                        <a class="page-link" href="?page=<?= $active + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>

    <?php endif; ?>




</div>

<script src="/_assets/js/itemForm.js"></script>