<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $title; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Modal Insert-->
    <div class="modal fade" id="addPackage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Add Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-insert" method="POST" action="<?php echo base_url('Package/insertPackage') ?>">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Paket Intenet</label>
                            <div class="col-sm-10">
                                <input type="text" name="namePackage" class="form-control" placeholder="Nama Paket">
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Keterangan Paket Internet</label>
                            <div class="col-sm-10">
                                <input type="text" name="descriptionPackage" class="form-control" placeholder="Ket. Paket">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Harga</label>
                            <div class="col-sm-10">
                                <input type="text" name="abonemen" class="form-control" placeholder="Harga">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn-insert">SIMPAN</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo $title; ?></h3><br>
                            <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#addPackage">
                                Add Pelanggan <span class="glyphicon glyphicon-plus"></span>
                            </button>
                            <p> <?php echo $this->session->flashdata('messageupdate'); ?></p>
                            <p> <?php echo $this->session->flashdata('message'); ?></p>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="viewDataTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name Paket</th>
                                        <th>Keterangan Paket</th>
                                        <th>Harga</th>
                                        <th colspan="1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $start = 1;
                                    foreach ($package as $row) :
                                    ?>
                                        <tr>
                                            <td><?php echo $start++; ?>. </td>
                                            <td><?php echo $row['name_package']; ?> </td>
                                            <td><?php echo $row['description']; ?> </td>
                                            <td><?php echo $row['abonemen']; ?> </td>
                                            <td><button type="button" rel="tooltip" title="Edit <?php echo $row['name_package']; ?>" class="btn btn-info btn-simple btn-xs">
                                                    <a href="<?php echo base_url('Package/updatePackage/' . $row['id_package']); ?>"><i class="fa fa-edit"></i></a>
                                                </button>
                                                <button type="button" rel="tooltip" title="Remove" data-toggle="modal" data-target="#modalDelete<?php echo $row['id_package']; ?>" class="btn btn-danger btn-simple btn-xs">
                                                    <i class="fa fa-times" onClick="return confirmDel();"></i>
                                                </button>
                                            </td>

                                        </tr>
                                        <!-- Modal HTML -->
                                        <div id="modalDelete<?php echo $row['id_package']; ?>" class="modal fade">
                                            <div class="modal-dialog modal-confirm">
                                                <div class="modal-content">
                                                    <div class="modal-header flex-column">
                                                        <div class="icon-box">
                                                            <i class="fa fa-times"></i>
                                                        </div>
                                                        <h4 class="modal-title w-100">Are you sure?</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-danger"><a href="<?php echo base_url('Package/deletePackage/' . $row['id_package']); ?>">Delete</a></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->