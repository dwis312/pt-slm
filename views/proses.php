<div class="container">
    <div class="row d-flex justify-content-between align-items-center mb-4">
        <h5 class="fs-6 col-auto">
            <small class="fw-normal text-secondary">Form Produksi</small>
        </h5>
        <form class="col-auto" action="/dashboard" method="GET">
            <button type="submit" class="btn btn-dark border-0 d-flex align-items-center"><i class='bx bxs-chevron-left'></i>kembali</button>
        </form>
    </div>
</div>

<form action="" method="POST" class="" autocomplete="off">
    <div class="row d-flex flex-row justify-content-between align-content-center gap-5 mx-auto">
        <div class="col-3">
            <div class="form-floating  mb-3">
                <input type="text" name="em_id" class="form-control <?= ($model->hasError('em_id')) ? 'is-invalid' : ''; ?>" id="em_id" placeholder="Nama Operator" value="<?= $model->em_id; ?>">
                <label for="em_id" class="form-label">Nama Operator</label>
                <div class="invalid-feedback text-end fst-italic">
                    <small><?= $model->getError('em_id'); ?></small>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="mb-3 row">
                <label for="in_item_id" class="col-sm-2 col-form-label">Kode Proses</label>
                <div class="col-8">
                    <input type="text" name="pr_item_id" class="form-control" id="in_item_id" value="<?= rand(rand(), (int) uniqid()); ?>" readonly>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="st_item_id" class="col-sm-2 col-form-label">Kode Barang</label>
                <div class="col-8">
                    <?php if (!empty($model->st_item_id) && !empty($model->item_name) && !empty($model->ct_item_name) && !$model->hasError('st_item_id')) : ?>
                        <div class="input-group">
                            <input type="text" name="st_item_id" value="<?= $model->st_item_id; ?>" class="w-25 form-control">
                            <input type="text" name="item_name" value="<?= $model->item_name; ?>" class="w-25 form-control">
                            <input type="text" name="ct_item_name" value="<?= $model->ct_item_name; ?>" class="w-50 form-control" style="font-size: .875rem;">
                        </div>
                    <?php else : ?>
                        <input type="text" name="st_item_id" class="form-control <?= ($model->hasError('st_item_id')) ? 'is-invalid' : ''; ?>" id="st_item_id" value="<?= $model->st_item_id; ?>">
                        <div class="invalid-feedback text-end fst-italic">
                            <small><?= $model->getError('st_item_id'); ?></small>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="pr_item_name" class="col-sm-2 col-form-label">Nama Produksi</label>
                <div class="col-8">
                    <input type="text" name="pr_item_name" class="form-control <?= ($model->hasError('pr_item_name')) ? 'is-invalid' : ''; ?>" id="pr_item_name" value="<?= $model->pr_item_name; ?>">
                    <div class="invalid-feedback text-end fst-italic">
                        <small><?= $model->getError('pr_item_name'); ?></small>
                    </div>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="ct_process_id" class="col-sm-2 col-form-label">Nama Proses</label>
                <div class="col-8">
                    <input type="text" name="ct_process_id" class="form-control <?= ($model->hasError('ct_process_id')) ? 'is-invalid' : ''; ?>" id="ct_process_id" value="<?= $model->ct_process_id; ?>">
                    <div class="invalid-feedback text-end fst-italic">
                        <small><?= $model->getError('ct_process_id'); ?></small>
                    </div>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="pr_item_value" class="col-sm-2 col-form-label">Jumlah Proses</label>
                <div class="col-8">
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-default w-0"><small>Qty</small></span>
                        <input type="number" name="pr_item_value" value="<?= $model->pr_item_value; ?>" aria-label="Jumlah" class="form-control w-50 text-center <?= ($model->hasError('pr_item_value')) ? 'is-invalid' : ''; ?>" placeholder="0" id="pr_item_value">

                        <select class="form-select w-25 form-select-sm  <?= ($model->hasError('ct_prUnit_id')) ? 'is-invalid' : ''; ?>" name="ct_prUnit_id" id="ct_prUnit_id">
                            <option class="text-center" value="<?= $model->ct_prUnit_id; ?>"><?= ($model->ct_prUnit_id === '') ? 'Satuan' : $model->ct_prUnit_name; ?></option>

                            <?php foreach ($categories_unit as $category_unit) : ?>
                                <option value="<?= $category_unit['ct_unit_id']; ?>"><?= $category_unit['ct_unit_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback text-end fst-italic">
                            <small><?= $model->getError('pr_item_value'); ?></small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-8">
                    <textarea name="pr_item_description" class="form-control form-control-sm" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px;"></textarea>
                </div>
            </div>
        </div>

    </div>



    <div class="row mt-5">
        <div class="col">
            <button type="submit" class="btn btn-success px-4 d-block mx-auto d-flex align-items-center gap-2"><i class='bx bxs-analyse'></i> Proses Barang</button>
        </div>
    </div>

</form>

<script src="/_assets/js/product.js"></script>