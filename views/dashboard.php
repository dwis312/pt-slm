<div class="container">

    <?php if (!$barang) : ?>
        <h5 class="text-center fst-italic text-secondary mt-5 p-4 border-bottom border-top">Record data barang masih kosong</h5>
    <?php endif; ?>
    <?php if ($barang > 0) : ?>
        <?php foreach ($barang as $data) : ?>
            <div class="row">
                <div class="col">
                    <ul>
                        <li>
                            <?= $data['st_item_id']; ?>
                        </li>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <?= $barang; ?>
    <?php endif; ?>





</div>