<?php
if (!defined('OK_LOADME')) {
    die('o o p s !');
}

$flcount = 0;
$dlfilelist = '';
$row = $db->getAllRecords(DB_TBLPREFIX . '_files', '*', " AND flname != '' AND flstatus = '1'");
$pgcntrow = array();
foreach ($row as $value) {

    if ($value['flavalto'] == 1 && $mbrstr['mbrstatus'] != 1) {
        continue;
    }
    if ($value['flavalto'] == 2 && $mbrstr['mpstatus'] != 1) {
        continue;
    }
    if ($value['flavalto'] == 3 && $mbrstr['mpstatus'] == 1) {
        continue;
    }

    $flhash = md5($cfgrow['dldir'] . $value['flid'] . date("md"));
    $flimgstr = ($value['flimage']) ? $value['flimage'] : DEFIMG_FILE;

    $extfile = pathinfo($value['flpath'], PATHINFO_EXTENSION);
    $dlfilename = strtolower($value['flname']);
    $dlfilename = preg_replace('/[\W]/', '_', $dlfilename) . '.' . $extfile;

    $dldlink = "index.php?dlfn={$dlfilename}&dlid={$value['flid']}&l={$flhash}";

    $dlfilelist .= <<<INI_HTML
    <div class="col-lg-6">
        <div class="card card-large-icons">
            <div class="card-icon bg-info text-white">
                <img src='{$flimgstr}'></i>
            </div>
            <div class="card-body">
                <h4>{$value['flname']} <small>{$value['flsize']}</small></h4>
                <p>{$value['fldescr']}</p>
                <a href="javascript:;" onclick="location.href = '{$dldlink}'" class="btn btn-sm btn-primary">Download</a>
            </div>
        </div>
    </div>
INI_HTML;
    $flcount++;
}

if ($flcount < 1) {
    $dlfilelist = <<<INI_HTML
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="empty-state">
                        <div class="empty-state-icon bg-info">
                            <i class="fas fa-question"></i>
                        </div>
                        <h2>{$LANG['m_nofile']}</h2>
                        <p class="lead">
                            {$LANG['m_nofilenote']}
                        </p>
                    </div>
                </div>
            </div>
        </div>
INI_HTML;
}
?>

<div class="section-header">
    <h1><i class="fa fa-fw fa-cloud-download-alt"></i> <?php echo myvalidate($LANG['m_digiload']); ?></h1>
</div>

<div class="section-body">
    <div class="row">
        <?php echo myvalidate($dlfilelist); ?>
    </div>
</div>
