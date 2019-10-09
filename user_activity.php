<?php
include "functions.php";
if (!isset($_SESSION['user_id'])) { header("Location: ./login.php"); exit; }
include "header.php";
?>        <div class="wrapper">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li>
                                        <?php if (!$detect->isMobile()) { ?>
                                        <a href="#" onClick="toggleAuto();" style="margin-right:10px;">
                                            <button type="button" class="btn btn-dark waves-effect waves-light btn-sm">
                                                <i class="mdi mdi-refresh"></i> <span class="auto-text">Auto-Refresh</span>
                                            </button>
                                        </a>
                                        <?php } else { ?>
                                        <a href="javascript:location.reload();" onClick="toggleAuto();" style="margin-right:10px;">
                                            <button type="button" class="btn btn-dark waves-effect waves-light btn-sm">
                                                <i class="mdi mdi-refresh"></i> Refresh
                                            </button>
                                        </a>
                                        <?php } ?>
                                    </li>
                                    <li>
                                        <a href="user.php">
                                            <button type="button" class="btn btn-success waves-effect waves-light btn-sm">
                                                <i class="mdi mdi-plus"></i> Add User
                                            </button>
                                        </a>
                                    </li>
                                </ol>
                            </div>
                            <h4 class="page-title">User Activity</h4>
                        </div>
                    </div>
                </div>     
                <!-- end page title --> 
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-warning" role="alert">
                            <i class="mdi mdi-alert-outline mr-2"></i> Search functionality is very limited in the <strong>BETA</strong>. This will be replaced and refined shortly. Also pagination speed will improve.
                        </div>
                        <div class="card">
                            <div class="card-body" style="overflow-x:auto;">
                                <table id="datatable" class="table dt-responsive nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Channel</th>
                                            <th class="text-center">Server</th>
                                            <th class="text-center">IP</th>
                                            <th class="text-center">Connections</th>
                                            <th class="text-center">Country</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <!-- end row-->
            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12  text-center">Xtream Codes - Admin UI</div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>
        <script src="assets/libs/jquery-toast/jquery.toast.min.js"></script>
        
        <!-- third party js -->
        <script src="assets/libs/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables/dataTables.bootstrap4.js"></script>
        <script src="assets/libs/select2/select2.min.js"></script>
        <script src="assets/libs/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables/responsive.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables/buttons.flash.min.js"></script>
        <script src="assets/libs/datatables/buttons.print.min.js"></script>
        <script src="assets/libs/datatables/dataTables.keyTable.min.js"></script>
        <script src="assets/libs/datatables/dataTables.select.min.js"></script>
        <script src="assets/libs/pdfmake/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/vfs_fonts.js"></script>
        <!-- third party js ends -->

        <!-- Datatables init -->
        <script>
        var autoRefresh = true;
        
        function toggleAuto() {
            if (autoRefresh == true) {
                autoRefresh = false;
                $(".auto-text").html("Manual Mode");
            } else {
                autoRefresh = true;
                $(".auto-text").html("Auto-Refresh");
            }
        }
        
        function reloadUsers() {
            if (autoRefresh == true) {
                $("#datatable").DataTable().ajax.reload(null, false);
            }
            setTimeout(reloadUsers, 2000);
        }
        $(document).ready(function() {
            $('select').select2({width: '100%'});
            $("#datatable").DataTable({
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    }
                },
                drawCallback: function() {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                    $('[data-toggle="tooltip"]').tooltip();
                },
                createdRow: function(row, data, index) {
                    $(row).addClass('user-' + data[0]);
                    if (data[5] == "ONLINE") {
                        $(row).addClass('user-online');
                    }
                },
                responsive: false,
                processing: true,
                serverSide: true,
                ajax: {
                    url: "./table.php",
                    "data": function(d) {
                        d.id = "user_activity";
                    }
                },
                columnDefs: [
                    {"className": "dt-center", "targets": [0,1,2,3,4,5]}
                ],
            });
            <?php if (!$detect->isMobile()) { ?>
            setTimeout(reloadUsers, 5000);
            <?php } ?>
        });
        </script>

        <!-- App js-->
        <script src="assets/js/app.min.js"></script>
    </body>
</html>