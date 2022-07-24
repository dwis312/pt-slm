<div class="container">
    <div class="row d-flex justify-content-between align-items-center mb-2">
        <h5 class="fs-6 col-auto">
            <small class="fw-normal text-secondary">Merubah Data barang</small>
        </h5>
        <form class="col-auto" action="/barang" method="GET">
            <button type="submit" class="btn btn-sm btn-dark"><i class='bx bxs-chevron-left'></i>kembali</button>
        </form>
    </div>

    <div class="row d-flex justify-content-center">
        <hr>

        <?php if (is_array($model)) : ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-sm">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Qty</th>
                            <th>Sat</th>
                            <th>Keteranggan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="" method="POST">
                            <?php $i = 1;
                            foreach ($model as $br) : ?>
                                <tr class="fw-light text-center">
                                    <td><?= $i++; ?>.</td>
                                    <td><input type="hidden" name="item_id[]" value="<?= $br['item_id']; ?>"><?= $br['item_id']; ?></td>
                                    <td><input type="text" name="item_name[]" value="<?= $br['item_name']; ?>" class="text-center border-0 border-bottom bg-transparent" style="width: 120px;"></td>
                                    <td>
                                        <select class="text-center border-0 border-bottom bg-transparent" name="ct_item_id[]">
                                            <option value="<?= $br['ct_item_id']; ?>"><?= ($br['ct_item_name'] === '') ? '=== Pilih jenis barang ===' : $br['ct_item_name']; ?></option>

                                            <?php foreach ($categories as $category) : ?>
                                                <option value="<?= $category['ct_item_id']; ?>"><?= $category['ct_item_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><input type="text" name="in_item_value[]" value="<?= $br['in_item_value']; ?>" class="text-center border-0 border-bottom bg-transparent" style="width: 30px;"></td>
                                    <td>
                                        <select name="ct_unit_id[]" id="ct_unit_id" class="text-center border-0 border-bottom bg-transparent">
                                            <option value="<?= $br['ct_unit_id']; ?>"><?= ($br['ct_unit_id'] === '') ? 'Pilih satuan' : $br['ct_unit_name']; ?></option>
                                            <?php foreach ($categories_unit as $category_unit) : ?>
                                                <option value="<?= $category_unit['ct_unit_id']; ?>"><?= $category_unit['ct_unit_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td><input type="text" name="in_item_description[]" value="<?= $br['in_item_description']; ?>" class="text-center border-0 border-bottom bg-transparent" style="width: 150px;"></td>
                                </tr>
                                <input type="hidden" name="in_item_id[]" value="<?= $br['in_item_id']; ?>">
                            <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="d-flex mb-3">
                <button type="submit" class="btn btn-sm btn-success mx-auto px-4" id="update">Simpan perubahan</button>
                </form>
            </div>
        <?php else : ?>
            <form class="col-8 my-4" action="" method="POST" autocomplete="off">
                <div class="mb-1 row justify-content-center align-items-start">
                    <label for="item_name" class="col-sm-4 col-form-label">Nama Barang</label>
                    <div class="col-sm-6 mt-2">
                        <input type="text" name="item_name[]" class="form-control form-control-sm <?= ($model->hasError('item_name')) ? 'is-invalid' : ''; ?>" id="item_name" value="<?= $model->item_name; ?>">
                        <div class="invalid-feedback text-end fst-italic">
                            <small><?= $model->getError('item_name'); ?></small>
                        </div>
                    </div>
                </div>
                <div class="mb-1 row justify-content-center align-items-start">
                    <label for="ct_item_id" class="col-sm-4 col-form-label">Jenis Barang</label>
                    <div class="col-sm-6 mt-2">
                        <select class="form-select form-select-sm <?= ($model->hasError('ct_item_id')) ? 'is-invalid' : ''; ?>" name="ct_item_id[]">
                            <option value="<?= $model->ct_item_id; ?>"><?= ($model->ct_item_id === '') ? '=== Pilih jenis barang ===' : $model->ct_item_name; ?></option>

                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category['ct_item_id']; ?>"><?= $category['ct_item_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback text-end fst-italic">
                            <small><?= $model->getError('ct_item_id'); ?></small>
                        </div>
                    </div>
                </div>

                <div class="mb-1 row justify-content-center ">
                    <label for="in_item_value" class="col-sm-4 col-form-label">Quantity</label>
                    <div class="col-sm-6 mt-2">
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <input type="text" name="in_item_value[]" class="form-control form-control-sm <?= ($model->hasError('in_item_value')) ? 'is-invalid' : ''; ?>" id="in_item_value" placeholder="contoh: 10" value="<?= $model->in_item_value; ?>">
                                    <label for="in_item_value">Jumlah</label>
                                    <div class="invalid-feedback text-end fst-italic">
                                        <small><?= $model->getError('in_item_value'); ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">

                                <div class="form-floating">
                                    <select class="form-select form-select-sm <?= ($model->hasError('ct_unit_id')) ? 'is-invalid' : ''; ?>" id="floatingSelectGrid" name="ct_unit_id[]">
                                        <option value="<?= $model->ct_unit_id; ?>"><?= ($model->ct_unit_id === '') ? 'Pilih satuan' : $model->ct_unit_name; ?></option>
                                        <?php foreach ($categories_unit as $category_unit) : ?>

                                            <option value="<?= $category_unit['ct_unit_id']; ?>"><?= $category_unit['ct_unit_name']; ?></option>
                                        <?php endforeach; ?>

                                    </select>
                                    <div class="invalid-feedback text-end fst-italic">
                                        <small><?= $model->getError('ct_unit_id'); ?></small>
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
                        <textarea name="in_item_description[]" id="in_item_description" class="form-control form-control-sm <?= ($model->hasError('in_item_description')) ? 'is-invalid' : ''; ?>" cols="30" rows="5"><?= $model->in_item_description; ?></textarea>
                        <div class="invalid-feedback mb-2 text-end fst-italic">
                            <small><?= $model->getError('in_item_description'); ?></small>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="item_id[]" value="<?= $model->item_id; ?>">
                <input type="hidden" name="in_item_id[]" value="<?= $model->in_item_id; ?>">
                <button class="btn btn-sm btn-primary d-block m-auto px-5 py-2 fw-semibold">Simpan perubahan</button>
            </form>
        <?php endif; ?>
        <hr>
    </div>
</div>