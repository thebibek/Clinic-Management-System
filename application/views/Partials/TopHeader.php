<?php
if (isset($notifications)) {
    $c = count($notifications);
} else {
    $c = 0;
}
?>
<!--START HEADER-->
<header>
    <a href="<?php echo base_url('app/dashboard'); ?>" class="logo"><img src="<?php echo base_url("assets/img/logo.png"); ?>" width="50" height="50" alt="Logo"></a>
    <ul id="header-actions" class="clearfix">
        <li class="list-box hidden-xs dropdown"><a id="drop2" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-warning2"></i> </a><span class="info-label blue-bg"><?php echo $c; ?></span>
            <ul class="dropdown-menu imp-notify" style="display: none;">

                <li class="dropdown-header">You have <span class="text-bold text-danger">(<?php echo $c; ?>)</span> notifications</li>
                <?php
                if (isset($notifications) && !empty($notifications)) {
                    foreach ($notifications as $v) {
                        ?>
                        <li>
                            <div class="icon"><img src="<?php echo base_url('assets/img/icons/notification.png'); ?>" alt="Notification"></div>
                            <div class="details"><strong class="text-danger"><?php echo $v['FirstName'] . ' ' . $v['LastName']; ?></strong> <span>Report No <span class="text-bold text-danger"><?php echo $v['ReceiptNo']; ?></span> is completed ,paid amount is <?php echo $v['PaidAmount']; ?></span></div>
                        </li>
                        <?php
                    }
                }
                ?>
                <li class="dropdown-footer text-bold text-12"><a href="<?php echo base_url('app/complete/report'); ?>">See all the notifications</a></li>
            </ul>
        </li>

        <?php
        if (isset($pendingTasks)) {
            $t = count($pendingTasks);
        } else {
            $t = 0;
        }
        ?>
        <li class="list-box hidden-xs dropdown"><a id="drop3" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-archive2"></i> </a><span class="info-label red-bg"><?php echo $t; ?></span>
            <ul class="dropdown-menu progress-info" style="display: none;">
                <li class="dropdown-header">You have (<span class="text-bold text-danger"><?php echo $t; ?></span>) pending tasks</li>
                <?php
                if (isset($pendingTasks) && !empty($pendingTasks)) {
                    foreach ($pendingTasks as $v) {
                        ?>
                        <li>
                            <p class="progress-info">
                                <img src="<?php echo base_url('assets/img/icons/reportcard.png'); ?>">
                                <strong class="text-danger">Report No. <?php echo $v['ReceiptNo']; ?></strong> of 
                                <span class="text-bold text-success t-12"><?php echo $v['FirstName'] . ' ' . $v['LastName']; ?></span>
                            </p>
                            <p><span class="text-danger">is pending</span></p>
                            <hr>
                        </li>
                        <?php
                    }
                }
                ?>
                <li class="dropdown-footer"><a href="<?php echo base_url('app/pending/report'); ?>">See all the tasks</a></li>
            </ul>
        </li>
        <li class="list-box user-admin dropdown">
            <div class="admin-details">
                <div class="name"><?php echo $this->session->userdata('email'); ?></div>
                <div class="designation"><?php echo $this->session->userdata('username'); ?></div>
            </div><a id="drop4" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-account_circle"></i></a>
            <ul class="dropdown-menu sm">
                <li class="dropdown-content">
                    <?php
                    if ($this->aauth->is_admin()) {
                        ?>
                        <a href="<?php echo base_url("app/change/password"); ?>">Change Password</a>
                        <a href="<?php echo base_url("app/settings"); ?>">Settings</a> 
                        <?php
                    }
                    ?>
                    <a href="<?php echo base_url("app/logout"); ?>">Logout</a>
                </li>
            </ul>
        </li>

    </ul>
</header>
<!--END HEADER-->