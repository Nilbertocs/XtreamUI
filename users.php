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
                            <h4 class="page-title">Users</h4>
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
                                            <th class="text-center">ID</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Owner</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Online</th>
                                            <th class="text-center">Expiration</th>
                                            <th class="text-center">Connections</th>
                                            <th class="text-center">Last Connection</th>
                                            <th class="text-center">Actions</th>
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
            <div class="modal fade downloadModal" tabindex="-1" role="dialog" aria-labelledby="downloadLabel" aria-hidden="true" style="display: none;" data-username="" data-password="">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="downloadModal">Download Playlist</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <select id="download_type" class="form-control" data-toggle="select2">
                                    <option value="">Select an ouput format: </option>
                                    <optgroup label="M3U Plus">
                                        <option value="type=m3u_plus&amp;output=hls">M3U Plus - HLS </option>
                                        <option value="type=m3u_plus&amp;output=mpegts">M3U Plus - MPEGTS</option>
                                    </optgroup>
                                    <optgroup label="Standard M3U">
                                        <option value="type=m3u&amp;output=hls">Standard M3U - HLS </option>
                                        <option value="type=m3u&amp;output=mpegts">Standard M3U - MPEGTS</option>
                                    </optgroup>
                                    <optgroup label="Enigma 2 OE 1.6">
                                        <option value="type=enigma16&amp;output=hls">Enigma 2 - HLS </option>
                                        <option value="type=enigma16&amp;output=mpegts">Enigma 2 - MPEGTS</option>
                                    </optgroup>
                                    <optgroup label="DreamBox OE 2.0">
                                        <option value="type=dreambox&amp;output=hls">DreamBox - HLS </option>
                                        <option value="type=dreambox&amp;output=mpegts">DreamBox - MPEGTS</option>
                                    </optgroup>
                                    <optgroup label="Giga Blue">
                                        <option value="type=gigablue&amp;output=hls">Giga Blue - HLS </option>
                                        <option value="type=gigablue&amp;output=mpegts">Giga Blue - MPEGTS</option>
                                    </optgroup>
                                    <optgroup label="Simple List">
                                        <option value="type=simple&amp;output=hls">Simple List - HLS </option>
                                        <option value="type=simple&amp;output=mpegts">Simple List - MPEGTS</option>
                                    </optgroup>
                                    <optgroup label="Octagon">
                                        <option value="type=octagon&amp;output=hls">Octagon - HLS </option>
                                        <option value="type=octagon&amp;output=mpegts">Octagon - MPEGTS</option>
                                    </optgroup>
                                    <optgroup label="Starlive v3 / Star Sat HD6060 / AZ Class">
                                        <option value="type=starlivev3&amp;output=hls">Starlive v3 - HLS </option>
                                        <option value="type=starlivev3&amp;output=mpegts">Starlive v3 - MPEGTS</option>
                                    </optgroup>
                                    <optgroup label="Starlive v5">
                                        <option value="type=starlivev5&amp;output=hls">Starlive V5 - HLS </option>
                                        <option value="type=starlivev5&amp;output=mpegts">Starlive V5 - MPEGTS</option>
                                    </optgroup>
                                    <optgroup label="MediaStar / StarLive / Geant / Tiger">
                                        <option value="type=mediastar&amp;output=hls">MediaStar - HLS </option>
                                        <option value="type=mediastar&amp;output=mpegts">MediaStar - MPEGTS</option>
                                    </optgroup>
                                    <optgroup label="Web TV List">
                                        <option value="type=webtvlist&amp;output=hls">Web TV List - HLS </option>
                                        <option value="type=webtvlist&amp;output=mpegts">Web TV List - MPEGTS</option>
                                    </optgroup>
                                    <optgroup label="Ariva">
                                        <option value="type=ariva&amp;output=hls">Ariva - HLS </option>
                                        <option value="type=ariva&amp;output=mpegts">Ariva - MPEGTS</option>
                                    </optgroup>
                                    <optgroup label="Spark">
                                        <option value="type=spark&amp;output=hls">Spark - HLS </option>
                                        <option value="type=spark&amp;output=mpegts">Spark - MPEGTS</option>
                                    </optgroup>
                                    <optgroup label="Geant / Starsat / Tiger / Qmax / Hyper / Royal (OLD)">
                                        <option value="type=gst&amp;output=hls">Geant - HLS </option>
                                        <option value="type=gst&amp;output=mpegts">Geant - MPEGTS</option>
                                    </optgroup>
                                    <optgroup label="Fortec 999 / Prifix 9400 / Starport">
                                        <option value="type=fps&amp;output=hls">Fortec 999 - HLS </option>
                                        <option value="type=fps&amp;output=mpegts">Fortec 999 - MPEGTS</option>
                                    </optgroup>
                                    <optgroup label="Revolution 60/60 | Sunplus">
                                        <option value="type=revosun&amp;output=hls">Revolution 60/60 - HLS </option>
                                        <option value="type=revosun&amp;output=mpegts">Revolution 60/60 - MPEGTS</option>
                                    </optgroup>
                                    <optgroup label="Zorro">
                                        <option value="type=zorro&amp;output=hls">Zorro - HLS </option>
                                        <option value="type=zorro&amp;output=mpegts">Zorro - MPEGTS</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="col-12" style="margin-top:10px;">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="download_url" value="">
                                    <div class="input-group-append">
                                        <button class="btn btn-warning waves-effect waves-light" type="button" onClick="copyDownload();"><i class="mdi mdi-content-copy"></i></button>
                                        <button class="btn btn-info waves-effect waves-light" type="button" onClick="doDownload();"><i class="mdi mdi-download"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
        <!-- end wrapper -->
        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 copyright text-center"><?=getFooter()?></div>
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
        
        function api(rID, rType) {
            if (rType == "delete") {
                if (confirm('Are you sure you want to delete this user?') == false) {
                    return;
                }
            } else if (rType == "kill") {
                if (confirm('Are you sure you want to kill all connections for this user?') == false) {
                    return;
                }
            }
            $.getJSON("./api.php?action=user&sub=" + rType + "&user_id=" + rID, function(data) {
                if (data.result === true) {
                    if (rType == "delete") {
                        $.toast("User has been deleted.");
                    } else if (rType == "enable") {
                        $.toast("User has been enabled.");
                    } else if (rType == "disable") {
                        $.toast("User has been disabled.");
                    } else if (rType == "unban") {
                        $.toast("User has been unbanned.");
                    } else if (rType == "ban") {
                        $.toast("User has been banned.");
                    } else if (rType == "kill") {
                        $.toast("All connections for this user have been killed.");
                    }
                    $.each($('.tooltip'), function (index, element) {
                        $(this).remove();
                    });
                    $("#datatable").DataTable().ajax.reload(null, false);
                } else {
                    $.toast("An error occured while processing your request.");
                }
            });
        }
        
        function download(username, password) {
            $("#download_type").val("");
            $('.downloadModal').data('username', username);
            $('.downloadModal').data('password', password);
            $('.downloadModal').modal('show');
        }
        
        $("#download_type").change(function() {
            if ($("#download_type").val().length > 0) {
                $("#download_url").val("http://<?=($rServers[$_INFO["server_id"]]["domain_name"] ? $rServers[$_INFO["server_id"]]["domain_name"] : $rServers[$_INFO["server_id"]]["server_ip"])?>:<?=$rServers[$_INFO["server_id"]]["http_broadcast_port"]?>/get.php?username=" + $('.downloadModal').data('username') + "&password=" + $('.downloadModal').data('password') + "&" + decodeURIComponent($('.downloadModal select').val()));
            } else {
                $("#download_url").val("");
            }
        });
        
        function doDownload() {
            if ($("#download_url").val().length > 0) {
                window.open($("#download_url").val());
            }
        }
        
        function copyDownload() {
            $("#download_url").select();
            document.execCommand("copy");
        }
        
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
            setTimeout(reloadUsers, 5000);
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
                        d.id = "users";
                    }
                },
                columnDefs: [
                    {"className": "dt-center", "targets": [0,4,5,6,7,8,9]}
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