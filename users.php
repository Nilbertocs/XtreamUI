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
                                            <th class="text-center">Notes</th>
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
                            <select id="download_type" class="form-control" data-toggle="select2"><optgroup label="Smart TV/ Kodi/ Android With Logo/Kategori"><option value="type=m3u_plus&amp;output=hls">HLS </option><option value="type=m3u_plus&amp;output=mpegts">MPEGTS  - Default</option></optgroup><optgroup label="Smart TV, Kodi, Android"><option value="type=m3u&amp;output=hls">HLS </option><option value="type=m3u&amp;output=mpegts">MPEGTS  - Default</option></optgroup><optgroup label="Enigma 2 OE 2.0 Auto Script"><option value="wget -O /etc/enigma2/iptv.sh &quot;type=enigma22_script&amp;output=hls&quot; &amp;&amp; chmod 777 /etc/enigma2/iptv.sh &amp;&amp; /etc/enigma2/iptv.sh">HLS </option><option value="wget -O /etc/enigma2/iptv.sh &quot;type=enigma22_script&amp;output=mpegts&quot; &amp;&amp; chmod 777 /etc/enigma2/iptv.sh &amp;&amp; /etc/enigma2/iptv.sh">MPEGTS  - Default</option></optgroup><optgroup label="Enigma 2 OE 1.6 Auto Script"><option value="wget -O /etc/enigma2/iptv.sh &quot;type=enigma216_script&amp;output=hls&quot; &amp;&amp; chmod 777 /etc/enigma2/iptv.sh &amp;&amp; /etc/enigma2/iptv.sh">HLS </option><option value="wget -O /etc/enigma2/iptv.sh &quot;type=enigma216_script&amp;output=mpegts&quot; &amp;&amp; chmod 777 /etc/enigma2/iptv.sh &amp;&amp; /etc/enigma2/iptv.sh">MPEGTS  - Default</option></optgroup><optgroup label="Enigma 2 OE 1.6"><option value="type=enigma16&amp;output=hls">HLS </option><option value="type=enigma16&amp;output=mpegts">MPEGTS  - Default</option></optgroup><optgroup label="DreamBox OE 2.0"><option value="type=dreambox&amp;output=hls">HLS </option><option value="type=dreambox&amp;output=mpegts">MPEGTS  - Default</option></optgroup><optgroup label="Octagon Auto Script"><option value="wget -qO /var/bin/iptv &quot;type=octagon_script&amp;output=hls&quot;">HLS </option><option value="wget -qO /var/bin/iptv &quot;type=octagon_script&amp;output=mpegts&quot;">MPEGTS  - Default</option></optgroup><optgroup label="Giga Blue"><option value="type=gigablue&amp;output=hls">HLS </option><option value="type=gigablue&amp;output=mpegts">MPEGTS  - Default</option></optgroup><optgroup label="Simple List"><option value="type=simple&amp;output=hls">HLS </option><option value="type=simple&amp;output=mpegts">MPEGTS  - Default</option></optgroup><optgroup label="Octagon"><option value="type=octagon&amp;output=hls">HLS </option><option value="type=octagon&amp;output=mpegts">MPEGTS  - Default</option></optgroup><optgroup label="Starlive v3/ Star Sat HD6060/ AZ Class"><option value="type=starlivev3&amp;output=hls">HLS </option><option value="type=starlivev3&amp;output=mpegts">MPEGTS  - Default</option></optgroup><optgroup label="Star Live v5"><option value="type=starlivev5&amp;output=hls">HLS </option><option value="type=starlivev5&amp;output=mpegts">MPEGTS  - Default</option></optgroup><optgroup label="MediaStar / StarLive / Geant / Tiger"><option value="type=mediastar&amp;output=hls">HLS </option><option value="type=mediastar&amp;output=mpegts">MPEGTS  - Default</option></optgroup><optgroup label="Web TV List"><option value="type=webtvlist&amp;output=hls">HLS </option><option value="type=webtvlist&amp;output=mpegts">MPEGTS  - Default</option></optgroup><optgroup label="Ariva"><option value="type=ariva&amp;output=hls">HLS </option><option value="type=ariva&amp;output=mpegts">MPEGTS  - Default</option></optgroup><optgroup label="Spark"><option value="type=spark&amp;output=hls">HLS </option><option value="type=spark&amp;output=mpegts">MPEGTS  - Default</option></optgroup><optgroup label="Geant/ Starsat/ Tiger/ Qmax/ Hyper/ Royal (OLD)"><option value="type=gst&amp;output=hls">HLS </option><option value="type=gst&amp;output=mpegts">MPEGTS  - Default</option></optgroup><optgroup label="Fortec 999/ Prifix 9400/ Starport"><option value="type=fps&amp;output=hls">HLS </option><option value="type=fps&amp;output=mpegts">MPEGTS  - Default</option></optgroup><optgroup label="Revolution 60/60 | Sunplus"><option value="type=revosun&amp;output=hls">HLS </option><option value="type=revosun&amp;output=mpegts">MPEGTS  - Default</option></optgroup><optgroup label="Starsat 7000"><option value="type=starsat7000&amp;output=hls">HLS </option><option value="type=starsat7000&amp;output=mpegts">MPEGTS  - Default</option></optgroup></select>
                            <div align="center" style="margin-top:25px;">
                                <button class="btn btn-info waves-effect waves-light" type="button" onClick="doDownload();">Download</button>
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
        
        function api(rID, rType) {
            if (rType == "delete") {
                if (confirm('Are you sure you want to delete this user?') == false) {
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
            $('.downloadModal').data('username', username);
            $('.downloadModal').data('password', password);
            $('.downloadModal').modal('show');
        }
        
        function doDownload() {
            window.open("http://<?=$rServers[$_INFO["server_id"]]["server_ip"]?>:<?=$rServers[$_INFO["server_id"]]["http_broadcast_port"]?>/get.php?username=" + $('.downloadModal').data('username') + "&password=" + $('.downloadModal').data('password') + "&" + decodeURIComponent($('.downloadModal select').val()));
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