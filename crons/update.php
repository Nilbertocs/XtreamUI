<?php
// Xtream UI - Panel Update
$rPath = "/home/xtreamcodes/iptv_xtream_codes/adtools/settings.json";
$rSettings = json_decode(file_get_contents($rPath), True);

if (($rSettings) && ($rSettings["auto_update"])) {
    if (time() - $rSettings["auto_update_check"] > $rSettings["auto_update_periodicity"]) {
        $rSettings["auto_update_check"] = time();
        $rUpdate = json_decode(file_get_contents("https://raw.githubusercontent.com/".$rSettings["git_url"]."/master/adtools/settings.json"), True);
        if (($rUpdate["version"]) && (intval($rUpdate["version"]) > intval($rSettings["version"]))) {
            // New version available!
            exec($rUpdate["update_script"]);
            // Set changes to settings here then save.
            foreach (Array("auto_update", "auto_update_check", "auto_update_periodicity", "admin_username", "admin_password") as $rItem) {
                if (isset($rSettings[$rItem])) {
                    $rUpdate[$rItem] = $rSettings[$rItem];
                }
            }
            file_put_contents($rPath, json_encode($rUpdate));
        } else {
            file_put_contents($rPath, json_encode($rSettings));
        }
    }
}
?>