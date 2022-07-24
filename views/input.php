<div class="container">
    <div class="row d-flex justify-content-between align-items-start mb-2">
        <h5 class="fs-6 col-auto">
            <small class="fw-normal text-secondary">Tambah Data barang</small>
        </h5>
        <form class="col-auto" action="/barang" method="GET">
            <button type="submit" class="btn btn-sm btn-dark"><i class='bx bxs-chevron-left'></i>kembali</button>
        </form>
    </div>

    <div class="row d-flex justify-content-center">
        <hr>
        <form class="col-8 my-4" action="" method="POST" autocomplete="off">
            <div class="mb-1 row justify-content-center align-items-start">
                <label for="item_name" class="col-sm-4 col-form-label">Nama Barang</label>
                <div class="col-sm-6 mt-2">
                    <input type="text" name="item_id" class="form-control form-control-sm <?= ($barang->hasError('item_id')) ? 'is-invalid' : ''; ?>" id="item_id" value="<?= $barang->item_id; ?>">
                    <div class="invalid-feedback text-end fst-italic">
                        <small><?= $barang->getError('item_id'); ?></small>
                    </div>
                </div>
            </div>
            <div class="mb-1 row justify-content-center align-items-start">
                <label for="ct_item_id" class="col-sm-4 col-form-label">Jenis Barang</label>
                <div class="col-sm-6 mt-2">
                    <select class="form-select form-select-sm <?= ($barang->hasError('ct_item_id')) ? 'is-invalid' : ''; ?>" name="ct_item_id">
                        <option value="<?= $barang->ct_item_id; ?>"><?= ($barang->ct_item_id === null) ? 'Pilih jenis barang' : $barang->ct_item_id; ?></option>

                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category['ct_item_id']; ?>"><?= $category['ct_item_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback text-end fst-italic">
                        <small><?= $barang->getError('ct_item_id'); ?></small>
                    </div>
                </div>
            </div>

            <div class="mb-1 row justify-content-center ">
                <label for="in_item_value" class="col-sm-4 col-form-label">Quantity</label>
                <div class="col-sm-6 mt-2">
                    <div class="row g-2">
                        <div class="col-md">
                            <div class="form-floating">
                                <input type="text" name="in_item_value" class="form-control form-control-sm <?= ($barang->hasError('in_item_value')) ? 'is-invalid' : ''; ?>" id="in_item_value" placeholder="contoh: 10" value="<?= $barang->in_item_value; ?>">
                                <label for="in_item_value">Jumlah</label>
                                <div class="invalid-feedback text-end fst-italic">
                                    <small><?= $barang->getError('in_item_value'); ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md">

                            <div class="form-floating">
                                <select class="form-select form-select-sm <?= ($barang->hasError('ct_unit_id')) ? 'is-invalid' : ''; ?>" id="floatingSelectGrid" name="ct_unit_id">
                                    <option value="<?= $barang->ct_unit_id; ?>"><?= ($barang->ct_unit_id === null) ? 'Pilih satuan' : $barang->ct_unit_id; ?></option>
                                    <?php foreach ($categories_unit as $category_unit) : ?>

                                        <option value="<?= $category_unit['ct_unit_id']; ?>"><?= $category_unit['ct_unit_name']; ?></option>
                                    <?php endforeach; ?>

                                </select>
                                <div class="invalid-feedback text-end fst-italic">
                                    <small><?= $barang->getError('ct_unit_id'); ?></small>
                                </div>
                                <label for="floatingSelectGrid">Satuan</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 row justify-content-center">
                <label for="in_item_description" class="col-sm-4 col-form-label">Keteranggan</label>
                <div class="col-sm-6 mt-2">
                    <textarea name="in_item_description" id="in_item_description" class="form-control form-control-sm <?= ($barang->hasError('in_item_description')) ? 'is-invalid' : ''; ?>" cols="30" rows="5"><?= $barang->in_item_description; ?></textarea>
                    <div class="invalid-feedback mb-2 text-end fst-italic">
                        <small><?= $barang->getError('in_item_description'); ?></small>
                    </div>
                </div>
            </div>

            <button class="btn btn-sm btn-primary d-block m-auto px-5 py-2 fw-semibold">Tambah</button>
        </form>
        <hr>
    </div>
</div>