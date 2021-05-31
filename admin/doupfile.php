<?php
include_once('../common/init.loader.php');

if (verifylog_sess('admin') == '') {
    die('o o p s !');
}

$_SESSION['redirto'] = redir_to($FORM['redir']);

if (isset($FORM['delId']) and $FORM['delId'] != "") {
    $hasdel = md5($FORM['delId'] . date("dH"));
    if ($FORM['hash'] == $hasdel) {
        $db->delete(DB_TBLPREFIX . '_files', array('flid' => $FORM['delId']));
        $_SESSION['dotoaster'] = "toastr.success('File deleted successfully!', 'Success');";
    } else {
        $_SESSION['dotoaster'] = "toastr.error('File deleted failed!', 'Error');";
    }

    $redirto = $_SESSION['redirto'];
    $_SESSION['redirto'] = '';

    header('location: ' . $redirto);
    exit;
}

$editId = intval($FORM['editId']);

$filetypenow = 'file';
$avalpaymentopt_array = array(0 => "Public", 1 => "Registered Member", 2 => "Registered Member with Membership Active", 3 => "Registered Member with Membership Inactive");
$flavalto_menu = select_opt($avalpaymentopt_array);

if (isset($editId) and $editId != "") {
    $row = $db->getAllRecords(DB_TBLPREFIX . '_files', '*', ' AND flid = "' . $editId . '"');
    $rowstr = array();
    foreach ($row as $value) {
        $rowstr = array_merge($rowstr, $value);
    }

    $_SESSION['redirto'] = redir_to($FORM['redir']);
    $filetypenow = 'text';

    $flavalto_menu = select_opt($avalpaymentopt_array, $rowstr['flavalto']);

    $flstatusarr = array(0, 1);
    $flstatus_cek = radiobox_opt($flstatusarr, $rowstr['flstatus']);
}

if (isset($FORM['dosubmit']) and $FORM['dosubmit'] == '1') {
    extract($FORM);
    $editId = intval($editId);

    $redirto = $_SESSION['redirto'];
    $_SESSION['redirto'] = '';

    // upload file
    if ($_FILES['flpath'] && $_FILES["flpath"]["size"] < 1100000) {
        // valid extensions
        $valid_extensions = array('zip', 'rar', 'pdf');
        $fname = $_FILES['flpath']['name'];
        // get uploaded file's extension
        $ext = strtolower(pathinfo($fname, PATHINFO_EXTENSION));
        // check's valid format
        if (in_array($ext, $valid_extensions)) {
            $flpath = $cfgrow['dldir'] . '/' . $fname;
            move_uploaded_file($_FILES['flpath']['tmp_name'], $flpath);
        }
    }

    if ($editId > 0) {
        $condition = ' AND flid = "' . $editId . '" ';
    } else {
        // if new file exist, keep using old flpath
        $condition = ' AND flpath LIKE "' . $flpath . '" ';
    }

    $flupdate = date('Y-m-d', time() + (3600 * $cfgrow['time_offset']));
    $filesize = read_file_size(@filesize($flpath));
    $flimage = imageupload('flimage_' . md5($_FILES['flpath']['name'] . $_FILES['flimage']['name']), $_FILES['flimage'], $old_flimage);

    $data = array(
        'flpath' => $flpath,
        'flname' => mystriptag($flname),
        'fldescr' => mystriptag($fldescr),
        'flsize' => $filesize,
        'flimage' => $flimage,
        'flavalto' => intval($flavalto),
        'flstatus' => intval($flstatus),
    );

    $sql = $db->getRecFrmQry("SELECT * FROM " . DB_TBLPREFIX . "_files WHERE 1 " . $condition . "");

    if (count($sql) > 0) {
        if ($editId > 0) {
            $data_add = array(
                'flupdate' => $flupdate,
            );
            $data = array_merge($data, $data_add);

            $update = $db->update(DB_TBLPREFIX . '_files', $data, array('flid' => $editId));
            if ($update) {
                $_SESSION['dotoaster'] = "toastr.success('File updated successfully!', 'Success');";
            } else {
                $_SESSION['dotoaster'] = "toastr.warning('You did not change anything!', 'Info');";
            }
        } else {
            // do nothing
            $_SESSION['dotoaster'] = "toastr.warning('File not added <strong>File exist!</strong>', 'Warning');";
        }
    } else {
        $data_add = array(
            'fldate' => $flupdate,
        );
        $data = array_merge($data, $data_add);

        $insert = $db->insert(DB_TBLPREFIX . '_files', $data);
        if ($insert) {
            $_SESSION['dotoaster'] = "toastr.success('File added successfully!', 'Success');";
        } else {
            $_SESSION['dotoaster'] = "toastr.error('File not added <strong>Please try again!</strong>', 'Warning');";
        }
    }
    header('location: ' . $redirto);
    exit;
}
?>

<?php
if (defined('ISDEMOMODE')) {
    ?>
    <div class="row">
        <div class="col-md-12">
            <p class="text-danger">Sorry, this feature is disabled in demo mode!</p>
        </div>
    </div>
    <?php
    die();
}
?>
<div class="row">
    <div class="col-md-12">

        <p class="text-primary">Fields with <span class="text-danger">*</span> are mandatory!</p>

        <form method="post" action="doupfile.php" enctype="multipart/form-data">
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>File Name <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" name="flname" id="flname" class="form-control" value="<?php echo isset($rowstr['flname']) ? $rowstr['flname'] : ''; ?>" placeholder="File name" required>
                    </div>
                    <div class="form-text text-muted">The display name for the file (without extension)</div>
                </div>
                <div class="form-group col-md-7">
                    <label>Path <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="<?php echo myvalidate($filetypenow); ?>" name="flpath" id="flpath" class="form-control" value="<?php echo isset($rowstr['flpath']) ? $rowstr['flpath'] : ''; ?>" placeholder="File location" required>
                    </div>
                    <div class="form-text text-muted">The file must have a maximum size of 1Mb</div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="selectgroup-pills">Availability</label>
                    <div class="selectgroup selectgroup-pills">
                        <label class="selectgroup-item">
                            <input type="radio" name="flstatus" value="0" class="selectgroup-input"<?php echo myvalidate($flstatus_cek[0]); ?>>
                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-fw fa-question-circle"></i> Disable</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="flstatus" value="1" class="selectgroup-input"<?php echo myvalidate($flstatus_cek[1]); ?>>
                            <span class="selectgroup-button selectgroup-button-icon"><i class="fas fa-fw fa-check-circle"></i> Enable</span>
                        </label>
                    </div>
                </div>
                <div class="form-group col-md-7">
                    <label>Status</label>
                    <select name="flavalto" id="flavalto" class="form-control select1">
                        <?php echo myvalidate($flavalto_menu); ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label>Image</label>
                    <div class="input-group">
                        <input type="file" name="flimage" id="flimage" class="form-control" value="<?php echo isset($rowstr['flimage']) ? $rowstr['flimage'] : DEFIMG_FILE; ?>">
                        <input type="hidden" name="old_flimage" value="<?php echo myvalidate($rowstr['flimage']); ?>">
                    </div>
                    <div class="form-text text-muted">The image must have a maximum size of 1Mb</div>
                </div>
                <div class="form-group col-md-7">
                    <label><?php echo myvalidate($LANG['g_description']); ?></label>
                    <textarea class="form-control" name="fldescr" id="fldescr" placeholder="File description"><?php echo isset($rowstr['fldescr']) ? $rowstr['fldescr'] : ''; ?></textarea>
                </div>
            </div>

            <div class="text-md-right">
                <a href="javascript:;" class="btn btn-secondary" data-dismiss="modal"><i class="far fa-fw fa-times-circle"></i> Cancel</a>
                <button type="submit" name="submit" value="submit" id="submit" class="btn btn-primary">
                    <i class="fa fa-fw fa-plus-circle"></i> Submit
                </button>
                <input type="hidden" name="editId" value="<?php echo myvalidate($editId); ?>">
                <input type="hidden" name="dosubmit" value="1">
            </div>

        </form>

    </div>

</div>