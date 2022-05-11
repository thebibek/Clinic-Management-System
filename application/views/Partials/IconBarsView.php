<div class="float-end">
    <div class="btn-group btn-group-sm " role="group">
        <a  href="<?php echo base_url('app/pending/report'); ?>" title="Pending Report" class="btn btn-outline-primary rounded-0"><img src="<?php echo base_url('assets/img/icons/report4.png'); ?>"></a>
        <a  href="<?php echo base_url('app/complete/report'); ?>" title="Completed Report" class="btn btn-outline-primary rounded-0"><img src="<?php echo base_url('assets/img/icons/completed1.png'); ?>"></a>
        <a  href="<?php echo base_url('app/receipt'); ?>" title="Invoice" class="btn btn-outline-primary rounded-0"><img src="<?php echo base_url('assets/img/icons/bill1.png'); ?>"></a>
    </div>
    <div class="btn-group btn-group-sm " role="group">
        <a href="<?php echo base_url('app/settings'); ?>" title="Settings"  class="btn btn-outline-primary rounded-0"><img src="<?php echo base_url('assets/img/icons/setting-25.png'); ?>"></a>
        <a href="<?php echo base_url('app/user/management'); ?>" title="User"  class="btn btn-outline-primary rounded-0"><img src="<?php echo base_url('assets/img/icons/user-25.png'); ?>"></a>
        <a href="<?php echo base_url('app/item/inward'); ?>" title="Purchase"  class="btn btn-outline-primary rounded-0"><img src="<?php echo base_url('assets/img/icons/purchase-25.png'); ?>"></a>
    </div>
    <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        User
    </button>
    <ul class="dropdown-menu">
        <?php
            if ($this->aauth->is_admin()) {
        ?>
            <li><a class="dropdown-item" href="<?php echo base_url("app/change/password"); ?>">Change Password</a></li>
            <li><a class="dropdown-item" href="<?php echo base_url("app/settings"); ?>">Settings</a></li>
        <?php
            }
        ?>  
        <li><a class="dropdown-item" href="<?php echo base_url("app/logout"); ?>">Logout</a></li>
    </ul>
</div>

