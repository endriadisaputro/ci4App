<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <h2 class="mt-2 mb-5">Edit Data Comic</h2>
    <form action="/comics/update/<?= $comic['id']; ?>" method="post">
        <?= csrf_field(); ?>
        <input type="hidden" name="slug" value="<?= $comic['slug']; ?>">
        <div class="mb-3 row">
            <label for="title" class="col-md-1 col-form-label">Title</label>
            <div class="col-md-6">
                <input type="text" name="title" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" id="title" value="<?= (old('title')) ? old('title') : $comic['title']; ?>" autofocus>
                <div class="invalid-feedback">
                    <?= $validation->getError('title'); ?>
                </div>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="penulis" class="col-md-1 col-form-label">Penulis</label>
            <div class="col-md-6">
                <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= (old('penulis')) ? old('penulis') : $comic['penulis']; ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('penulis'); ?>
                </div>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="penerbit" class="col-md-1 col-form-label">Penerbit</label>
            <div class="col-md-6">
                <input type="text" class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" value="<?= (old('penerbit')) ? old('penerbit') : $comic['penerbit']; ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('penerbit'); ?>
                </div>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="sampul" class="col-md-1 col-form-label">sampul</label>
            <div class="col-md-6">
                <input type="input" class="form-control" id="sampul" name="sampul" value="<?= (old('sampul')) ? old('sampul') : $comic['sampul']; ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
<?= $this->endsection(); ?>