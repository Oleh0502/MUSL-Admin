 <?php
        if($_SESSION['User_Type'] == 'admin'){
            $Customers = $this->common_model->CountByCondition('users',array('User_Type' => 'user','Is_Blocked'=>'0','Is_Verified'=>'0'));
            $Suppliers = $this->common_model->CountByCondition('users',array('User_Type' => 'supplier','Is_Blocked'=>'0','Is_Verified'=>'0'));
            
         }
         ?>
    <!-- Page -->
    <div class="page">
      <div class="page-header">
        <h1 class="page-title font-size-26 font-weight-100">Dashboard</h1>
      </div>

      <div class="page-content container-fluid">
        <div class="row">
          <!-- First Row -->
        
          <div class="col-xl-3 col-md-6 info-panel">
            <div class="card card-shadow">
              <div class="card-block bg-white p-20">
                <button type="button" class="btn btn-floating btn-sm btn-primary">
                  <i class="icon wb-user"></i>
                </button>
                <span class="ml-15 font-weight-400">No Of Users</span>
                <div class="content-text text-center mb-0">
                  <i class="text-success icon wb-triangle-up font-size-20">
              </i>
                  <span class="font-size-40 font-weight-100"><?php echo $Customers ?> Users</span>
                  <p class="blue-grey-400 font-weight-100 m-0"><!-- +25% From previous month --></p>
                </div>
              </div>
            </div>
          </div>
          <!-- End First Row -->

          <!-- End Third Row -->
        </div>
      </div>
    </div>

