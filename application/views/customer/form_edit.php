<?php
foreach ($customers as $rows) :
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">

                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Form <small>Edit Customer</small></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="form_edit" method="POST" action="<?php echo base_url('Customer/saveUpdateDataCustomer') ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label>No. Pelanggan</label>
                                <input class="form-control" id="numberCustomer" name="numberCustomer" type="text" placeholder="Nomor Pelanggan" value="<?php echo $rows['number_customer']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama. Pelanggan</label>
                                <input class="form-control" id="nameCustomer" name="nameCustomer" type="text" placeholder="Nama Pelanggan" value="<?php echo $rows['name_customer']; ?>">
                            </div>

                            <div class="form-group">
                                <label>No. ID/KTP</label>
                                <input class="form-control" id="noId" name="noId" type="text" placeholder="No. ID/KTP" value="<?php echo $rows['no_id']; ?>">
                            </div>


                            <div class="form-group">
                                <label>Alamat Pelanggan</label>
                                <input class="form-control" id="addressCustomer" name="addressCustomer" type="text" placeholder="Alamat Pelanggan" value="<?php echo $rows['address_customers']; ?>">
                            </div>


                            <div class="form-group">
                                <label>Tgl. Pemasangan</label>
                                <input type="text" name="dateInstallation" value="<?php echo $rows['date_installation']; ?>" class="form-control" placeholder="Tgl. Pemasangan" id="datepicker">
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="nmPackage" id="nmPackage">
                                    <?php
                                    foreach ($package as $rowPackage) :
                                    ?>
                                        <option value="<?php echo $rowPackage['id_package']; ?>"<?php if (!(strcmp($rows['id_package'], $rowPackage['id_package']))) {echo "selected=\"selected\"";} ?>><?php echo $rowPackage['name_package']; ?> (<?php echo $rowPackage['description']; ?>)</option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="idCustomer" value="<?php echo $rows['id_customers']; ?>" />
                            <button type="submit" class="btn btn-primary btnsave">UPDATE</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </section>
    </div>
<?php
endforeach;
?>
<script>
    $(document).ready(function() {

        $('').change(function() {
            var idTower = $(this).val();
            $.ajax({
                url: "<?= base_url(''); ?>",
                method: "POST",
                data: {
                    idTower: idTower
                },
                async: false,
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<option>' + data[i].lantai + '</option>';
                    }
                    $('#nmUnit').html(html);

                }
            });
        });
        $('.btnsave').click(function() {
            var nmStatus = $('#nmStatus').val();
            if (nmStatus == '') {

            }
        });

    });
</script>