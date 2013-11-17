<div class="container">
  <section id="forms">
  <div class="row" style="margin-top:10px;">
    <div class="span3 offset1">
      <h3 id="list"><a href="/admincp">Lists</a></h3>
      <div class="well" style="padding: 10px 0;">
        <ul class="nav nav-list">
          <li class="nav-header">Document</li>
          <li <?php echo ($template=='reset_telex')?'class="active"':'';?>><a href="/admincp/reset_telex">Reset Telex increment number</a></li>
          <li <?php echo ($template=='reset_approval')?'class="active"':'';?>><a href="/admincp/reset_approval">Reset Approval increment number</a></li>
          <li <?php echo ($template=='reset_reg')?'class="active"':'';?>><a href="/admincp/reset_reg">Reset Registration number</a></li>
          <li <?php echo ($template=='set_signcode')?'class="active"':'';?>><a href="/admincp/set_signcode">Set Sign Code</a></li>
          <li class="nav-header">User Settings</li>
          <li <?php echo ($template=='password_user')?'class="active"':'';?>><a href="/admincp/puser">Change password for user</a></li>
          <li <?php echo ($template=='password_admin')?'class="active"':'';?>><a href="/admincp/padmin">Change admin password</a></li>
        </ul>
      </div>
    </div>
    <div class="span7">
          <?php 
      if (isset($template))
      {
        $this->load->view("/admin/".$template);
      }
      ?>
    </div>