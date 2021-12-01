<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <h2 class="mt-2 mb-5">Create new Data</h2>
    <form action="/comics/save" method="post">
        <?= csrf_field(); ?>
        <div class="mb-3 row">
            <label for="title" class="col-md-1 col-form-label">Title</label>
            <div class="col-md-6">
                <input type="text" name="title" class="form-control <?= ($validation->hasError('title')) ? 'is-invalid' : ''; ?>" id="title" value="<?= old('title'); ?>" autofocus>
                <div class="invalid-feedback">
                    <?= $validation->getError('title'); ?>
                </div>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="penulis" class="col-md-1 col-form-label">Penulis</label>
            <div class="col-md-6">
                <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('penulis'); ?>
                </div>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="penerbit" class="col-md-1 col-form-label">Penerbit</label>
            <div class="col-md-6">
                <input type="text" class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('penerbit'); ?>
                </div>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="sampul" class="col-md-1 col-form-label">sampul</label>
            <div class="col-md-6">
                <input type="input" class="form-control" id="sampul" name="sampul">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
<?= $this->endsection(); ?>