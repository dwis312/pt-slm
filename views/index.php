<header>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center py-3">
            <a href="/" class="text-decoration-none">
                <span class="fs-4 brand">Sinar Lautan Makmur</span>
            </a>

            <ul class="nav nav-pills">
                <li class="nav-item"><a href="#beranda" class="nav-link fw-semibold text-warning">Beranda</a></li>
                <li class="nav-item"><a href="#tentang" class="nav-link text-light">Tentang</a></li>
                <li class="nav-item"><a href="#produk" class="nav-link text-light">Produk</a></li>
                <li class="nav-item"><a href="#kontak" class="nav-link text-light">Kontak</a></li>
            </ul>

            <ul class="nav nav-pills">
                <?php

                use app\core\App;

                if (!App::isUser()) : ?>
                    <li class="nav-item"><a href="/login" class="nav-link text-light">Masuk</a></li>
                <?php else : ?>
                    <li><a class="nav-link text-light" href="/dashboard">Dashboard</a></li>
                    <li>
                        <form action="/logout" method="POST">
                            <button type="submit" class="nav-link text-light">Log out</button>
                        </form>
                    </li>

                <?php endif; ?>
            </ul>
        </div>
    </div>
</header>

<main>



    <!-- Section -->

    <!-- Beranda -->
    <section id="beranda">
        <div class="hero">
            <img src="/_assets/img/wh2a.jpg" alt="slm logo">
            <div class="title col-8">
                <h1 class="">PT Sinar Lautan Makmur</h1>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat tempora porro minima nemo perspiciatis inventore, nam doloribus recusandae explicabo sunt fuga, ipsa iste molestiae non consectetur error! Dignissimos, impedit at.</p>
            </div>
        </div>

        <div class="container mb-4 border-bottom">
            <div class="row py-5">
                <h1>Mendaur Ulang biji Plastik Untuk Memproduksi Plastik</h1>
                <p>Berdiri sejak tahun 2009, PT Sinar lautan makmur telah berkembang menjadi perusahan di bidang industri pengolahan barang dari plastik untuk didaur ulang, pemasaran biji plastik dan telah bertumbuh sebagai salah satu perusahaan yang mendaur ulang plastik dengan kualitas terbaik di Indonesia.</p>
            </div>
        </div>
    </section>
    <!-- End Beranda -->

    <!-- Tentang -->
    <section id="tentang" class="py-5 bg-info">
        <div class="container text-primary">
            <div class="row my-5 py-3 text-bg-warning  rounded-2">
                <h1 class="tentang-title">Tentang Kami</h1>
                <p>SLM Merupakan perusahaan yang mengolah dan mendistribusi barang plastik untuk kebutuhan masyarakat luas.</p>
            </div>
            <div class="row d-flex justify-content-around">
                <div class="col-6">
                    <h3 class="mb-3 py-2">Riwayat Singkat</h3>
                    <p class="text-lg-start">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio nam accusamus dolores repellendus consequuntur sint? Necessitatibus obcaecati doloremque nesciunt corporis velit cumque recusandae iusto, omnis labore aliquid nulla quae odio itaque porro natus id perspiciatis aspernatur? Labore praesentium officiis voluptatum repudiandae id? Nesciunt veniam voluptatum suscipit ullam expedita, fuga nostrum.</p>
                    <p class="text-lg-start">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit dolorum, velit nemo corporis assumenda porro dolor. Cumque non soluta aliquid neque, deserunt mollitia perspiciatis unde repellendus iusto quia repellat beatae!</p>
                </div>
                <div class="col-6">
                    <h3 class="mb-3 py-2">Visi & Misi</h3>
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item bg-transparent">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Visi
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body text-lg-start text-primary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo accusantium aliquid dignissimos, non officia tenetur autem repudiandae obcaecati, nobis quidem odio laboriosam ratione, possimus deserunt mollitia. Impedit nemo omnis quae.</div>
                            </div>
                        </div>
                        <div class="accordion-item bg-transparent">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Misi
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body text-lg-start text-primary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora autem in explicabo. Vel sequi praesentium, distinctio fugiat excepturi accusantium rem consectetur provident, ducimus numquam nobis quasi tenetur ullam voluptatum alias.</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Tentang -->

    <!-- Produk -->
    <section id="produk" class="py-5">
        <div class="container">
            <div class="row py-3">
                <h1 class="tentang-title">Produk Kami</h1>
            </div>

            <div class="row">
                <div class="row mb-4 row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card h-100">
                            <img src="/_assets/img/PMMA.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">PMMA hitam</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem odio at nam facilis voluptatem distinctio voluptas incidunt consectetur vel dolor iste dolores nulla accusamus dolore cum, dicta temporibus totam tempora.</p>
                            </div>

                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="/_assets/img/pcabs.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">PC Abs</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis mollitia fuga cupiditate ratione libero optio obcaecati. Labore quaerat sed dicta!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="/_assets/img/aris.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Produk 3</h5>
                                <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolorum modi quasi cumque nisi doloremque voluptates velit, sed sequi fugiat voluptas delectus. Qui quaerat quae beatae, eos ad quibusdam est doloribus?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </section>
    <!-- End produk -->

    <!-- Kontak -->
    <section id="kontak" class="mb-5">
        <div class="container">
            <div class="row py-5">
                <h1>Kontak kami</h1>
                <small>get in touch</small>
            </div>

            <div class="row d-flex justify-content-between align-items-start">
                <div class="col-4">
                    <ul class="list-group mb-5">
                        <h3 class="text-start m-3">Head office</h3>
                        <li class="list-group-item d-flex align-items-start gap-5">
                            <i class='bx bx-map mt-2'></i>
                            <small class="text-start fs-6">Jl. Kincan Raya No.RT.01, RT.001/RW.007, Jatibening Baru, Pondok Gede, Bekasi City, West Java 17412</small>
                        </li>
                        <li class="list-group-item d-flex align-items-center gap-5">
                            <i class='bx bxl-gmail'></i>
                            <small>sinarlautan9@gmail.com</small>
                        </li>
                        <li class="list-group-item d-flex align-items-center gap-5">
                            <i class='bx bx-phone'></i>
                            <small>(021) 86909620</small>
                        </li>
                    </ul>

                    <ul class="list-group">
                        <h3 class="text-start m-3">Ware house</h3>
                        <li class="list-group-item d-flex align-items-start gap-5">
                            <i class='bx bx-map mt-2'></i>
                            <small class="text-start fs-6">Jl. Sarongge, Cipeucang, Kec. Cileungsi, Kabupaten Bogor, Jawa Barat 16820</small>
                        </li>
                        <li class="list-group-item d-flex align-items-center gap-5">
                            <i class='bx bxl-gmail'></i>
                            <small>sinarlautan9@gmail.com</small>
                        </li>
                        <li class="list-group-item d-flex align-items-center gap-5">
                            <i class='bx bx-phone'></i>
                            <small>(021) 86909620</small>
                        </li>
                    </ul>
                </div>

                <div class="col-6">
                    <h3 class="contact-title mt-4 mb-3">Kirim pesan</h1>

                        <form action="" method="POST" autocomplete="off">
                            <div class="mb-3 row">
                                <label for="name" class="col-sm-2 col-form-label text-start">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label text-start">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="staticEmail">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="subject" class="col-sm-2 col-form-label text-start">Subject</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="subject">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="pesan" class="col-sm-2 col-form-label text-start">Pesan</label>
                                <div class="col-sm-10">
                                    <textarea name="pesan" class="form-control" id="pesan" cols="30" rows="5"></textarea>
                                </div>
                            </div>

                            <button class="btn btn-primary px-5 mt-4">Kirim</button>

                        </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Kontak -->

    <!-- End Section -->
</main>


<!-- Scroll top -->
<a href="#" class="scrollup" id="scroll-up">
    <!-- <i class="uil uil-arrow-up scrollup__icon"></i> -->
    <i class='bx bx-chevrons-up scrollup__icon'></i>
</a>

<footer class="bg-primary">
    <div class="container pt-4 pb-2">
        <div class="d-flex justify-content-around align-items-center mb-4">
            <div class="brand-footer d-flex align-items-center gap-3">
                <img src="/_assets/img/slm.png" alt="slm logo" width="80">
                <div class="text-light d-flex flex-column">
                    <h3 class="m-0 fs-3 fw-bold">PT SLM</h3>
                    <p class="m-0">Sinar Lautan Makmur</p>
                </div>
            </div>

            <div class="fw-bold">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a href="#beranda" class="nav-link text-light">Beranda</a></li>
                    <li class="nav-item"><a href="#tentang" class="nav-link text-light">Tentang</a></li>
                    <li class="nav-item"><a href="#produk" class="nav-link text-light">Produk</a></li>
                    <li class="nav-item"><a href="#kontak" class="nav-link text-light">Kontak</a></li>
                </ul>
            </div>
        </div>
        <div class="text-light">
            <p class="m-0">&copy; <small>Dwi Susilo. All right reserved. 2022</small></p>
            <small class="fst-italic">Demo</small>
        </div>
    </div>
</footer>


<script src="/_assets/js/scroll.js"></script>