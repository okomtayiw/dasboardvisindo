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
                        <h3 class="card-title">Form <small>Transaction</small></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="quickForm" method="POST" action="<?php echo base_url('Transaction/saveDataTransaction') ?>">
                        <div class="card-body">
                            <div class="form-group">
                                <label>No. Pelanggan</label>
                                <input class="form-control" id="noCustomers" name="idCustomers" type="text" placeholder="Nomor Pelanggan" value="<?php echo $rows['number_customer'];?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Nama. Pelanggan</label>
                                <input class="form-control" id="nameCustomers" name="nameCustomers" type="text" placeholder="Nama Pelanggan" value="<?php echo $rows['name_customer'];?>" readonly>
                            </div>

                            <div class="form-group">
                                <label>Nama Paket Internet</label>
                                <input class="form-control" id="namePackage" name="namePackage" type="text" placeholder="Nama Paket" value="<?php echo $rows['name_package'];?> (<?php echo $rows['description'];?>)" readonly>
                            </div>

                            <div class="form-group">
                                <label>Tot. Tagihan</label>
                                <input class="form-control" id="abonemen" type="text" placeholder="Tot. Tagihan" value="<?php echo $rows['abonemen'];?>" readonly>
                            </div>


                            <div class="form-group">
                                <label>Alamat Pelanggan</label>
                                <input class="form-control" id="addressCustomers"  name="addressCustomers" type="text" placeholder="Alamat Pelanggan" value="<?php echo $rows['address_customers'];?>" readonly>
                            </div>
                            
                            
                            <div class="form-group">
                                <label>Tgl. Penagihan</label>
                                <input type="text"  name="dateInvoice" class="form-control" placeholder="Tgl. Penagihan" id="datepicker">
                            </div>
                            <div class="form-group">
                                <label>Jatuh Tempo</label>
                                <input type="text"  name="dueDate" class="form-control" placeholder="Jatuh Tempo" id="datepickertwo">
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="nmStatus" id="nmStatus">
                                    <?php
                                    foreach (array('Belum Lunas', 'Lunas') as $status) { ?>
                                        <option value="<?php echo $status; ?>"><?php echo $status ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" name="numberCustomer" value="<?php echo $rows['number_customer'];?>" />
                            <button type="submit" class="btn btn-primary btnsave">SIMPAN</button>
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
            if(nmStatus == '') {
                
            }
        });

    });
</script>