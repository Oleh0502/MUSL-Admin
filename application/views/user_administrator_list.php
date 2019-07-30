<div class="content">
    
    <div class="musl-margin-left border-bottom w-100 musl-margin-right musl-column">
        <form method="post" class="mt-4">
            <input type="hidden" name="csrfmiddlewaretoken" value="hqJ9TxeWtTlxUynvs7cvXRAAywE3hFhhccTNwdmN1l3O2hjLbmNp6f7wHw0jKGBr">
            <div class="row">
                <div class="col">
                    <input type="text" name="username" class="form-control" id="id_username"
                           placeholder="User profile name*" required>
                </div>
                <div class="col">
                    <input type="email" name="email" class="form-control" id="id_email"
                           placeholder="Email Address">
                </div>
            </div>
            <div>
                <button type="submit" class="musl-login-button ml-0 mt-4 mb-3">Search</button>
            </div>
        </form>
    </div>
    
        <div class="musl-margin-left musl-margin-right w-100">
            <table class="table">
                <tbody>
                
                    <tr>
                        <td><a href="<?php echo base_url('user_administrator/profile'); ?>">Test2</a></td>
                        <td>cholponbek.esenbekuulu@zensoft.io</td>
                        <td><img src="<?php echo base_url('assets/images/dummy_user.png'); ?>"
                                           style="width: 40px; height: 40px"></td>
                    </tr>
                              
                    <tr>
                        <td><a href="<?php echo base_url('user_administrator/profile'); ?>">Test</a></td>
                        <td>keee@mailinator.com</td>
                        <td><img src="<?php echo base_url('assets/images/dummy_user.png'); ?>"
                                           style="width: 40px; height: 40px"></td>
                    </tr>
                
                    <tr>
                        <td><a href="<?php echo base_url('user_administrator/profile'); ?>">Test</a></td>
                        <td>testingmusl@mailinator.com</td>
                        <td><img src="<?php echo base_url('assets/images/dummy_user.png'); ?>"
                                           style="width: 40px; height: 40px"></td>
                    </tr>
                
                </tbody>
            </table>
        </div>
    

</div>