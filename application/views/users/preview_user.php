<div id="myModal" class="modal fade user_modal" role="dialog">
    <div class="modal-dialog" style="max-width: 1000px">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header cst-modal-header">
                <h4 class="modal-title">User </h4>
            </div>
            <?php echo form_open_multipart(base_url('admin/users/add_update_user/') ,array('id'=>'user-form')); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group position-relative">
                            <label class="text-color font-weight-semi-bold text-capitalize">First Name  </label>
                            <p class="form-control py-2"><?= !empty($user) ? $user->first_name : '' ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group position-relative">
                            <label class="text-color font-weight-semi-bold text-capitalize">Last Name</label>
                            <p class="form-control py-2"><?= !empty($user) ? $user->last_name : '' ?></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group position-relative">
                            <label class="text-color font-weight-semi-bold text-capitalize">Date Of Birth </label>
                            <p class="form-control py-2" ><?= !empty($user) ? $user->date_of_birth : '' ?></p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group position-relative">
                            <label class="text-color font-weight-semi-bold text-capitalize">Address</label>
                            <p class="form-control py-2"> <?= !empty($user) ? $user->address : '' ?> </p>
                        </div>
                    </div>
                </div>

                <div class="row">


                    <table  style="table-layout: fixed" class="display table table-bordered table-striped" id="">
                        <thead>
                        <tr>
                            <th style="width: 30px">Sr #</th>
                            <th>Company Name</th>
                            <th >Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($experiences && !empty($experiences)): ?>
                        <?php foreach ($experiences as $experience): ?>
                        <tr>
                            <td><?= $experience->experience_id ?></td>
                            <td><?= $experience->company_name ?></td>
                            <td><?= $experience->description ?></td>
                        </tr>
                        <?php endforeach; ?>

                        <?php endif; ?>

                        </tbody>

                    </table>

                </div>



                <!--USER Portfolios-->

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group position-relative">
                            <label class="text-color font-weight-semi-bold text-capitalize">PortFolios</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?php if ($user_portfolios && !empty($user_portfolios)): ?>
                            <?php foreach ($user_portfolios as $portfolio): ?>
                                <img width="100" src="<?= base_url().'uploads/'.$portfolio->image ?>">
                            <?php endforeach; ?>

                        <?php endif; ?>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary cst-btn" data-dismiss="modal" onclick="$('#myModal').modal('hide')">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>