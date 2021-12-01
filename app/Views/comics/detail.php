<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-2">Detail Comic</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0 py-2">
                    <div class="col-md-4">
                        <img src="/img/<?= $comic['sampul']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $comic['title']; ?></h5>
                            <p class="card-text"><b>Penulis : </b><?= $comic['penulis']; ?></p>
                            <p class="card-text"><small class="text-muted"><b>Penerbit : </b><?= $comic['penerbit']; ?></small></p>

                            <a href="" class="btn btn-success">Edit</a>
                            <a href="" class="btn btn-danger">Hapus</a>
                            <a href="/comics" class="btn btn-warning">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>