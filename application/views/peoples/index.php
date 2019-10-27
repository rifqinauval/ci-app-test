<div class="container">
    <h3 class="mt-3">List of Peoples</h3>

    <div class="row">
        <div class="col-md-5">
            <form action="<?= base_url('peoples');?>" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari...." name="keyword" autocomplete="off" autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" name="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>

  

    <div class="row">
    <div class="row">
  		<div class="col-md-6">
		<a href="<?php base_url(); ?>peoples/tambah" class="btn btn-primary">Tambah Data Mahasiswa</a>
	</div>
        <div class="col-md">
            <h5>Hasil : <?= $total_rows ?></h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($peoples)) : ?>
                    <tr>
                        <td colspan="4">
                            <div class="alert alert-danger" role="alert">
                                data tidak ditemukan!
                            </div>
                        </td>
                    </tr>
                    <?php endif ?>
                    <?php foreach($peoples as $people) : ?>
                    <tr>
                        <th><?= ++$start; ?></th>
                        <td><?= $people['name']; ?></td>
                        <td><?= $people['email']; ?></td>
                        <td>
                            <a href="<?= base_url(); ?>peoples/detail/<?= $people['id']; ?>" class="badge badge-primary float-right ml-1">Detail</a>
                            <a href="<?= base_url(); ?>peoples/ubah/<?= $people['id']; ?>" class="badge badge-success float-right ml-1">Edit</a>
                            <a href="<?= base_url(); ?>peoples/hapus/<?= $people['id']; ?>" class="badge badge-danger float-right ml-1" onclick="return confirm('apakah anda yakin ingin menghapus data ini ?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?= $this->pagination->create_links(); ?>
        </div>
    </div>
</div>