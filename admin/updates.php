<?php
if (!defined('OK_LOADME')) {
    die('o o p s !');
}

if (defined('ISDEMOMODE')) {
    die();
}

// debug only, truncate member records
if ($FORM['dbtest'] == 'truncated' && $payrow['testpayon'] == 1 && !defined('ISDEMOMODE')) {
    $db->getRecFrmQryStr("TRUNCATE " . DB_TBLPREFIX . "_transactions");
    $db->getRecFrmQryStr("TRUNCATE " . DB_TBLPREFIX . "_points");
    $db->getRecFrmQryStr("TRUNCATE " . DB_TBLPREFIX . "_mbrs");
    $db->getRecFrmQryStr("TRUNCATE " . DB_TBLPREFIX . "_mbrplans");

    $db->getRecFrmQryStr("DELETE FROM " . DB_TBLPREFIX . "_paygates WHERE 1 AND pgidmbr > '0'");
    $db->getRecFrmQryStr("ALTER TABLE " . DB_TBLPREFIX . "_paygates AUTO_INCREMENT = 2");

    redirpageto('index.php?hal=dashboard');
    exit;
}

if (isset($FORM['dosubmit']) && $FORM['dosubmit'] == '1') {
    extract($FORM);

    $baseArr = ($isreuse == 1) ? array('myruname' => $myruname, 'addlic' => '1') : array('rfname' => $rfname, 'rlname' => $rlname, 'remail' => $remail, 'runame' => $runame);
    $dataArr = array_merge($baseArr, array('lickey' => $cfgrow['lickey'], 'do' => 'reg'));

    $initurl = "https://www.mlmscript.net/~enverifykey/api.php";
    $response = getdocurl($initurl, $dataArr);
    $arrResponse = $response['data'];

    if ($arrResponse['isvalid'] != 1) {
        $_SESSION['errmsg'] = $arrResponse['errmsg'];
    } else {
        $envacc = ($arrResponse['username']) ? $arrResponse['username'] : $cfgrow['envacc'];
        $lichash = $arrResponse['lichash'];
        $data = array(
            'envacc' => $envacc,
            'licstatus' => $arrResponse['licstatus'],
            'lichash' => $lichash,
        );
        $update = $db->update(DB_TBLPREFIX . '_configs', $data, array('cfgid' => '1'));
    }
    redirpageto('index.php?hal=updates');
    exit;
}

$cfgtoken = get_optionvals($cfgrow['cfgtoken']);
$updateinfostr = ($cfgtoken['cnvnum'] > $cfgrow['softversion']) ? '<span class="badge badge-success">New version ' . $cfgtoken['cnvnum'] . ' is available!</span>' : '<a href="javascript:;" onclick="getinitdo(\'../common/init.loader.php\', \'vnum\')"><span id="newverstr" class="badge badge-info">No new version available!</span></a><span id="newvernum" class="badge badge-success"></span>';

$errmsg = $_SESSION['errmsg'];
$errmsgstr = ($errmsg) ? showalert('danger', 'Erroer', $errmsg) : showalert('warning', 'Optional', "You can also register your license manually from the <a href='https://www.mlmscript.net/join' target='_blank' data-toggle='tooltip' title='Register to MLMScript.net'>MLMScript.net</a> site.");
$_SESSION['errmsg'] = '';

$admin_content = <<<INI_HTML
<div class="section-header">
    <h1><i class="fa fa-fw fa-briefcase-medical text-success"></i> {$LANG['a_updates']}</h1>
</div>
INI_HTML;
echo myvalidate($admin_content);
?>

<div class="row">
    <?php
    if ($payrow['testpayon'] == 1) {
        ?>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Reset Database</h4>
                </div>
                <div class="card-body">
                    Use the button below to reset or purge your current test records. Please note! This process cannot be reversed.
                </div>
                <div class="card-footer bg-whitesmoke text-md-right">
                    <a href="javascript:;" data-href="index.php?hal=updates&dbtest=truncated" class="btn btn-danger bootboxconfirm" data-poptitle="Purge Test Records" data-popmsg="<p>Are you sure want to purge the member and transaction records?</p><p><span class='badge badge-danger'><i class='fa fa-exclamation-triangle'></i> This action cannot be undone!</span></p>" data-toggle="tooltip" title="Purge Test Records"><i class="far fa-fw fa-trash-alt"></i> Purge Test Records</a>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="col-6">
        <div class="card">
            <div class="card-header">
                <h4>License Info</h4>
            </div>
            <div class="card-body">
                <span class='text-small text-muted'>License Key</span>
                <h6 class="summary"><?php echo myvalidate(base64_decode($cfgrow['lickey'])); ?></h6>
                <span class='text-small text-muted'>License Date</span>
                <h6 class="summary"><?php echo formatdate($cfgrow['licdate']); ?></h6>
                <span class='text-small text-muted'>Version</span>
                <h6 class="summary"><?php echo myvalidate($cfgrow['softversion']); ?></h6>
                <span class='text-small text-muted'>Installation Date</span>
                <h6 class="summary"><?php echo formatdate($cfgrow['installdate']); ?></h6>
                <span class='text-small text-muted'>Have a Question?</span>
                <h6 class="summary text-muted">Please feel free to ask <a href="https://www.mlmscript.net/askqu/ask" target="_blank">here</a>.</h6>
                <span class='text-small text-muted'>Need additional features or custom programming services?</span>
                <h6 class="summary text-muted">Please feel free to <a href="https://www.mlmscript.net/helpdesk/index.php?a=add&category=4" target="_blank">contact us</a>.</h6>
            </div>
            <div class="card-footer bg-whitesmoke">
                <?php echo myvalidate($updateinfostr); ?>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="card">
            <form method="post" action="index.php" id="updform">
                <input type="hidden" name="hal" value="updates">

                <div class="card-header">
                    <h4>License Registration</h4>
                </div>

                <?php
                if ($cfgrow['lichash'] && $cfgrow['licstatus'] > 0) {
                    ?>

                    <div class="card-body">
                        <p>Your license has been registered by <Strong><?php echo myvalidate($cfgrow['envacc']); ?></Strong></p>
                        <?php
                        $days_ago = date('Y-m-d', strtotime('-25 days', strtotime($cfgrow['datetimestr'])));
                        if ($days_ago <= $cfgrow['installdate'] || $payrow['testpayon'] == 1) {
                            ?>
                            <p>If you like UniMatrix script, <Strong>please rate us 5 Stars</Strong> and get free one month <a href='https://www.mlmscript.net/helpdesk/index.php?a=add&category=4' target='_blank'>support</a> and access to the latest version and minor updates directly from the <a href='https://www.mlmscript.net/index.php?a=client&b=purchased' target='_blank'>MLMScript</a> website.</p>
                            <?php
                        }
                        ?>
                        <h6>Thank you for your business!</h6>
                    </div>
                    <div class="card-footer bg-whitesmoke text-md-right">
                        <button type="button" class="btn btn-primary" onclick="window.open('https://www.mlmscript.net/id/<?php echo myvalidate($cfgrow['envacc']); ?>/client', '_blank')">
                            MLMScript Login
                        </button>

                    </div>

                    <?php
                } else {
                    ?>

                    <div class="card-body">
                        <div>Register your license for free and get more benefits!</div>
                        <ul>
                            <li>Login to the MLMScript member only area.</li>
                            <li>Access the pre-release of latest version.</li>
                            <li>and more...</li>
                        </ul>

                        <?php echo myvalidate($errmsgstr); ?>

                        <div id='newregacc'>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="rfname"><?php echo myvalidate($LANG['g_firstname']); ?></label>
                                    <input type="text" name="rfname" class="form-control" id="rfname" placeholder="First name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="rlname"><?php echo myvalidate($LANG['g_lastname']); ?></label>
                                    <input type="text" name="rlname" class="form-control" id="rlname" placeholder="Last name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="runame">MLMScript Username</label>
                                <input type="text" name="runame" class="form-control" id="runame" placeholder="Choose your MLMScript.net username">
                                <span class='text-small text-muted'>If the username already exists, we will generate it randomly.</span>
                            </div>
                            <div class="form-group">
                                <label for="remail">Email Address</label>
                                <input type="email" name="remail" class="form-control" id="remail" placeholder="Email address">
                                <span class='text-small text-muted'>Your password will be sent to this email address.</span>
                            </div>
                        </div>
                        <div id='myregacc' class="d-none">
                            <div class="form-group">
                                <label for="myruname">Your MLMScript Username</label>
                                <input type="text" name="myruname" class="form-control" id="myruname" placeholder="Your MLMScript.net username">
                                <span class='text-small text-muted'>Please enter your MLMScript username correctly.</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-whitesmoke text-md-right">
                        <div class="form-group float-left">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="isreuse" value="1" class="custom-control-input" id="isreuse" onclick="checkBoxCnt('isreuse', 'myregacc', 'newregacc');">
                                <label class="custom-control-label" for="isreuse">Use my existing MLMScript account</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="Register My License"><i class="fas fa-fw fa-unlock-alt"></i> Register</button >
                    </div>

                    <?php
                }
                ?>

                <input type="hidden" name="dosubmit" value="1">
            </form>
        </div>
    </div>

</div>
