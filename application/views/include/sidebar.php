<?php
$ControllerName = $this->router->class;
$FunctionName   = $this->router->method;
$Parameter = $this->uri->segment(3);
$usertype = @$usertype;
?>
<div class="site-menubar">
      <div class="site-menubar-body">
        <div>
          <div>
            <ul class="site-menu" data-plugin="menu">
              <li class="site-menu-category">General</li>
              <!-- <li class="site-menu-item has-sub active open">
                <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                        <span class="site-menu-title">Dashboard</span>
                            <div class="site-menu-badge">
                                <span class="badge badge-pill badge-success">3</span>
                            </div>
                    </a>
                <ul class="site-menu-sub">
                  <li class="site-menu-item">
                    <a class="animsition-link" href="../index.html">
                      <span class="site-menu-title">Dashboard v1</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="../dashboard/v2.html">
                      <span class="site-menu-title">Dashboard v2</span>
                    </a>
                  </li>
                  <li class="site-menu-item active">
                    <a class="animsition-link" href="../dashboard/ecommerce.html">
                      <span class="site-menu-title">Ecommerce</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="../dashboard/analytics.html">
                      <span class="site-menu-title">Analytics</span>
                    </a>
                  </li>
                  <li class="site-menu-item">
                    <a class="animsition-link" href="../dashboard/team.html">
                      <span class="site-menu-title">Team</span>
                    </a>
                  </li>
                </ul>
              </li> -->
               <li class="site-menu-item <?php echo $ControllerName=='dashboard'? 'active':''; ?>">
                    <a class="animsition-link" href="<?php echo base_url('dashboard'); ?>">
                      <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                      <span class="site-menu-title">Dashboard</span>
                    </a>
                </li>

                <?php  if ($this->auth->has_permission('manage-admin-users')) { ?>
                <li class="site-menu-item <?php echo $ControllerName=='ausers'? 'active':''; ?>">
                    <a class="animsition-link" href="<?php echo base_url('ausers'); ?>">
                      <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                      <span class="site-menu-title">Manage Admin Users</span>
                    </a>
                </li>
                <?php } ?>
                <?php  if ($this->auth->has_permission('manage-users')) { ?>
                <li class="site-menu-item <?php echo $ControllerName=='users'? 'active':''; ?>">
                    <a class="animsition-link" href="<?php echo base_url('users'); ?>">
                      <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                      <span class="site-menu-title">Manage App Users</span>
                    </a>
                </li>
                <?php } ?>


            </ul>
          </div>
        </div>
      </div>
    </div>