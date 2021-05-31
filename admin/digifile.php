<?php
if (!defined('OK_LOADME')) {
    die('o o p s !');
}

if ($FORM['folderfileloader']) {
    // start crawling files
    $fdate = date('Y-m-d', time() + (3600 * $cfgrow['time_offset']));
    $FORM['folderfileloader'] = str_replace("//", "/", $FORM['folderfileloader']);
    if ($dir = @opendir("{$FORM['folderfileloader']}/")) {
        $fhit = 0;
        while (false !== ($file = readdir($dir))) {
            if ($file != '.htaccess' && $file != 'index.php' && $file != 'index.html' && $file != 'php.ini' && $file != '.' && $file != '..' && $file != 'logs' && $file != 'images') {
                $fpathname = "{$FORM['folderfileloader']}/" . $file;
                if (!is_file($fpathname))
                    continue;
                if (is_dir($fpathname))
                    continue;
                $fsize = read_file_size(@filesize($fpathname));

                $data = array(
                    'flsize' => $fsize,
                );

                $condition = ' AND flpath LIKE "' . $fpathname . '" ';
                $sql = $db->getRecFrmQry("SELECT * FROM " . DB_TBLPREFIX . "_files WHERE 1 " . $condition . "");
                if (count($sql) > 0) {
                    $data = array_merge($data, array('flupdate' => $fdate));
                    $update = $db->update(DB_TBLPREFIX . '_files', $data, array('flpath' => $fpathname));
                } else {
                    $data = array_merge($data, array('fldate' => $fdate, 'flpath' => $fpathname, 'flname' => $file));
                    $insert = $db->insert(DB_TBLPREFIX . '_files', $data);
                }
                $fhit++;
            }
        }
        $toaststr = ($fhit > 0) ? 'Files loaded successfully!' : 'File not found!';
        $_SESSION['dotoaster'] = "toastr.success('{$toaststr}', 'Success');";
    } else {
        $_SESSION['dotoaster'] = "toastr.error('Files not loaded <strong>Please try again!</strong>', 'Warning');";
    }
    //header('location: index.php?hal=' . $hal);
    redirpageto('index.php?hal=' . $hal);
    exit;
}

$condition = '';

if (isset($FORM['flname']) and $FORM['flname'] != "") {
    $condition .= ' AND flname LIKE "%' . $FORM['flname'] . '%" ';
}
if (isset($FORM['fldescr']) and $FORM['fldescr'] != "") {
    $condition .= ' AND fldescr LIKE "%' . $FORM['fldescr'] . '%" ';
}
if (isset($FORM['fltoken']) and $FORM['fltoken'] != "") {
    $condition .= ' AND (flpath LIKE "%' . $FORM['flpath'] . '%" OR fltoken LIKE "%' . $FORM['fltoken'] . '%") ';
}

$condition = str_replace(array("'"), '', $condition);

$tblshort_arr = array("fldate", "flname", "fldlcount");
$tblshort = dborder_arr($tblshort_arr, $FORM['_stbel'], $FORM['_stype']);
if ($FORM['_stbel'] != '' && (in_array($FORM['_stbel'], $tblshort_arr))) {
    $sqlshort = ($FORM['_stype'] == 'up') ? " ORDER BY {$FORM['_stbel']} DESC " : " ORDER BY {$FORM['_stbel']} ASC ";
} else {
    $sqlshort = " ORDER BY flid DESC ";
}

//Main queries
$sql = $db->getRecFrmQry("SELECT * FROM " . DB_TBLPREFIX . "_files WHERE 1 " . $condition . "");
$pages->items_total = count($sql);
$pages->mid_range = 3;
$pages->paginate();

$userData = $db->getRecFrmQry("SELECT * FROM " . DB_TBLPREFIX . "_files WHERE 1 " . $condition . $sqlshort . $pages->limit . "");
?>

<div class="section-header">
    <h1><i class="fa fa-fw fa-cloud-download-alt"></i> File Download</h1>
</div>

<div class="section-body">

    <form method="get">
        <div class="card card-primary">
            <div class="card-header">
                <h4>
                    <i class="fa fa-fw fa-search"></i> Find File
                </h4>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>File Name</label>
                            <input type="text" name="flname" id="flname" class="form-control" value="<?php echo isset($FORM['flname']) ? $FORM['flname'] : '' ?>" placeholder="File name">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label><?php echo myvalidate($LANG['g_description']); ?></label>
                            <input type="text" name="fldescr" id="fldescr" class="form-control" value="<?php echo isset($FORM['fldescr']) ? $FORM['fldescr'] : '' ?>" placeholder="File description">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label><?php echo myvalidate($LANG['g_keyword']); ?></label>
                            <input type="fltoken" name="fltoken" id="fltoken" class="form-control" value="<?php echo isset($FORM['fltoken']) ? $FORM['fltoken'] : '' ?>" placeholder="Enter keyword">
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer bg-whitesmoke">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="float-md-right">
                            <a href="index.php?hal=digifile" class="btn btn-danger"><i class="fa fa-fw fa-redo"></i> Clear</a>
                            <button type="submit" name="submit" value="search" id="submit" class="btn btn-primary"><i class="fa fa-fw fa-search"></i> Search</button>
                        </div>
                        <div class="d-block d-sm-none">
                            &nbsp;
                        </div>
                        <div>
                            <a href="javascript:;" data-href="doupfile.php?redir=digifile" data-poptitle="<i class='fa fa-fw fa-plus-circle'></i> Upload File" class="openPopup btn btn-dark"><i class="fa fa-fw fa-upload"></i> Manual Upload</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <input type="hidden" name="hal" value="digifile">
    </form>

    <hr class="mt-4">
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger">
                <div class="card-header">
                    <h4>
                        <i class="fa fa-fw fa-question-circle"></i> Load Bulk Files
                    </h4>
                    <div class="card-header-action">
                        <a data-collapse="#blkfile-collapse" class="btn btn-icon btn-secondary" href="#"><i class="fas fa-minus"></i></a>
                    </div>
                </div>
                <div class="collapse" id="blkfile-collapse">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <blockquote>
                                    Upload the files to the folder as stated in the form, then click the Load button to update the file records. Make sure the displayed folder is the location where you uploaded the files.
                                </blockquote>
                            </div>
                            <div class="col-sm-6">
                                <?php
                                if (defined('ISDEMOMODE')) {
                                    ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="text-danger">Sorry, this feature is disabled in demo mode!</p>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <form method="post">
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="" aria-label="" value="<?php echo myvalidate($cfgrow['dldir']); ?>" name="folderfileloader">
                                                <div class="input-group-append">
                                                    <button type=submit" class="btn btn-primary" type="button">Load</button>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="hal" value="digifile">
                                    </form>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="clearfix"></div>

    <div class="row marginTop">
        <div class="col-sm-12 paddingLeft pagerfwt">
            <?php if ($pages->items_total > 0) { ?>
                <div class="row">
                    <div class="col-md-7">
                        <?php echo myvalidate($pages->display_pages()); ?>
                    </div>
                    <div class="col-md-5 text-right">
                        <span class="d-none d-md-block">
                            <?php echo myvalidate($pages->display_items_per_page()); ?>
                            <?php echo myvalidate($pages->display_jump_menu()); ?>
                            <?php echo myvalidate($pages->items_total()); ?>
                        </span>
                    </div>
                <?php } ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="clearfix"></div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" nowrap><?php echo myvalidate($tblshort['fldate']); ?>Date</th>
                    <th scope="col" nowrap><?php echo myvalidate($tblshort['flname']); ?>File Name</th>
                    <th scope="col" nowrap><?php echo myvalidate($tblshort['fldlcount']); ?>Download</th>
                    <th scope="col" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($userData) > 0) {
                    $pgnow = ($FORM['page'] > 1) ? $FORM['page'] - 1 : 0;
                    $s = ($FORM['ipp'] > 0) ? $pgnow * $FORM['ipp'] : $pgnow * $cfgrow['maxpage'];
                    foreach ($userData as $val) {
                        $s++;
                        $hasdel = md5($val['flid'] . date("dH"));

                        $strfname = basename($val['flpath']);
                        $overview = "<label>Info</label><div>" . $val['adminfo'] . "</div>";
                        $flimage = ($val['flimage']) ? $val['flimage'] : DEFIMG_FILE;
                        ?>
                        <tr>

                            <th scope="row"><?php echo myvalidate($s); ?></th>
                            <td>
                                <span data-toggle="tooltip" title="<?php echo myvalidate('Update: ' . $val['flupdate']); ?>">
                                    <?php echo myvalidate($val['fldate']); ?>
                                </span>
                            </td>
                            <td>
                                <span data-toggle="tooltip" title="<?php echo myvalidate($strfname); ?>">
                                    <?php echo myvalidate(substr($val['flname'], 0, 24)); ?>
                                </span>
                            </td>
                            <td class="text-right"><?php echo myvalidate($val['fldlcount']); ?></td>
                            <td align="center" nowrap>
                                <a href="javascript:;"
                                   class="btn btn-sm btn-secondary"
                                   data-html="true"
                                   data-toggle="popover"
                                   data-trigger="hover"
                                   data-placement="left" 
                                   title="<?php echo myvalidate($val['flid'] . '. ' . $val['flname'] . ' (' . $val['flsize'] . ')'); ?>"
                                   data-content="<div><img src='<?php echo myvalidate($flimage); ?>' class='mr-3 rounded' width='128'></div><div><?php echo myvalidate($val['fldescr']); ?></div>">
                                    <i class="far fa-fw fa-question-circle"></i>
                                </a>
                                <a href="javascript:;" data-href="doupfile.php?editId=<?php echo myvalidate($val['flid']); ?>&redir=digifile" data-poptitle="<i class='fa fa-fw fa-edit'></i> Update File Details" class="btn btn-sm btn-info openPopup" data-toggle="tooltip" title="Update <?php echo myvalidate($val['flname']); ?>"><i class="fa fa-fw fa-edit"></i></a>
                                <a href="javascript:;" data-href="doupfile.php?hash=<?php echo myvalidate($hasdel); ?>&delId=<?php echo myvalidate($val['flid']); ?>&redir=digifile" class="btn btn-sm btn-danger bootboxconfirm" data-poptitle="File: <?php echo myvalidate($val['flid'] . '. ' . $val['flname']); ?>" data-popmsg="Are you sure want to delete this file?<br /><span class='text-danger'><em>The file will also removed from the server!</em></span>" data-toggle="tooltip" title="Delete <?php echo myvalidate($val['flname']); ?>"><i class="far fa-fw fa-trash-alt"></i></a>
                            </td>

                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="6">
                            <div class="text-center mt-4 text-muted">
                                <div>
                                    <i class="fa fa-3x fa-question-circle"></i>
                                </div>
                                <div>No Record Found</div>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="clearfix"></div>

    <div class="row marginTop">
        <div class="col-sm-12 paddingLeft pagerfwt">
            <?php if ($pages->items_total > 0) { ?>
                <div class="row">
                    <div class="col-md-7">
                        <?php echo myvalidate($pages->display_pages()); ?>
                    </div>
                    <div class="col-md-5 text-right">
                        <span class="d-none d-md-block">
                            <?php echo myvalidate($pages->display_items_per_page()); ?>
                            <?php echo myvalidate($pages->display_jump_menu()); ?>
                            <?php echo myvalidate($pages->items_total()); ?>
                        </span>
                    </div>
                <?php } ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>

</div>

