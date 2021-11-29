<?= $this->extend('layouts/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Contact Us</h2>
            <ul>
                <?php foreach ($alamat as $al) : ?>
                    <li><?= $al['tipe']; ?></li>
                    <li><?= $al['jalan']; ?></li>
                    <li><?= $al['kota']; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
<?= $this->endsection(); ?>