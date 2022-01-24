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
    <div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Add Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-insert" method="POST" action="<?php echo base_url('Customer/insertCustomer') ?>">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Number Pelanggan</label>
                            <div class="col-sm-10">
                                <input type="text" name="numberCustomer" class="form-control" placeholder="No. Pelanggan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Date </label>
                            <div class="col-sm-10">
                                <input type="text" name="dateInstallation" class="form-control" placeholder="Tgl. Pemasangan" id="datepicker">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Pelanggan</label>
                            <div class="col-sm-10">
                                <input type="text" name="nameCustomer" class="form-control" placeholder="Nama Pelanggan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">No. ID/KTP</label>
                            <div class="col-sm-10">
                                <input type="text" name="noId" class="form-control" placeholder="No. ID/KTP">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Alamat Pelanggan</label>
                            <div class="col-sm-10">
                                <textarea type="text" name="addressCustomer" class="form-control" placeholder="Alamat Pelanggan"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Paket Internet</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="nmPackage" id="nmPackage">
                                    <?php
                                    foreach ($package as $rowPackage) :
                                    ?>
                                        <option value="<?php echo $rowPackage['id_package']; ?>"><?php echo $rowPackage['name_package']; ?> (<?php echo $rowPackage['description']; ?>)</option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
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
                            <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#addCustomer">
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
                                        <th>No. Pelanggan</th>
                                        <th>Name</th>
                                        <th>Package</th>
                                        <th>Tgl. Pemasangan</th>
                                        <th>Alamat</th>
                                        <th>No. ID</th>
                                        <th colspan="1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $start = 1;
                                    foreach ($customers as $row) :
                                    ?>
                                        <tr>
                                            <td><?php echo $start++; ?>. </td>
                                            <td><?php echo $row['number_customer']; ?> </td>
                                            <td><?php echo $row['name_customer']; ?> </td>
                                            <td><?php echo $row['name_package']; ?> </td>
                                            <td><?php echo $row['date_installation']; ?> </td>
                                            <td><?php echo $row['address_customers']; ?> </td>
                                            <td><?php echo $row['no_id']; ?> </td>
                                            <td><button type="button" rel="tooltip" title="Edit <?php echo $row['name_customer']; ?>" class="btn btn-info btn-simple btn-xs">
                                                    <a href="<?php echo base_url('Customer/updateCustomer/' . $row['id_customers']); ?>"><i class="fa fa-edit"></i></a>
                                                </button>
                                                <button type="button" rel="tooltip" title="Remove" data-toggle="modal" data-target="#modalDelete<?php echo $row['id_customers']; ?>" class="btn btn-danger btn-simple btn-xs">
                                                    <i class="fa fa-times" onClick="return confirmDel();"></i>
                                                </button>
                                            </td>

                                        </tr>
                                        <!-- Modal HTML -->
                                        <div id="modalDelete<?php echo $row['id_customers']; ?>" class="modal fade">
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
                                                        <button type="button" class="btn btn-danger"><a href="<?php echo base_url('Customer/deleteCustomer/' . $row['id_customers']); ?>">Delete</a></button>
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