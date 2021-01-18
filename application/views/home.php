<style>
    .text-align-right {
        text-align: end;
    }
</style>

<div class="container mt-5">
    <?php echo validation_errors(); ?>
    <?php echo form_open_multipart(base_url('home/submit_form') ,array('id'=>'registration-form')); ?>
    <input type="hidden" name="files[]" id="files">
    <div class="row mb-2">
        <div class="col-6">
            <div class="form-group">
                <label for="inputFirstName">First Name</label>
                <input type="text" id="inputFirstName" name="first_name" class="form-control" placeholder="Enter first name">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="inputLastName">Last Name</label>
                <input type="text" id="inputLastName" class="form-control" name="last_name" placeholder="Enter last name">
            </div>
        </div>

    </div>

    <div class="row mb-2">
        <div class="col-12">
            <div class="form-group">
                <label for="inputDateOfBirth">Date Of Birth</label>
                <input class="form-control" type="date" name="date_of_birth" id="inputDateOfBirth">
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-12">
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input class="form-control" type="text" name="address" id="inputAddress">
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-12">
            <!-- Repeater Html Start -->
            <div id="repeater">
                <!-- Repeater Heading -->
                <div class="repeater-heading">
                    <h5 class="pull-left">Experiences</h5>
                    <div class="text-align-right">
                        <button type="button" class="btn btn-primary repeater-add-btn">
                            Add
                        </button>
                    </div>

                </div>
                <div class="clearfix"></div>
                <!-- Repeater Items -->

                <div class="items"  data-group="experiences">
                    <!-- Repeater Content -->
                    <div class="item-content">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inputCompanyName" class="control-label">Company Name</label>
                                    <input type="text" class="form-control" id="inputCompanyName" placeholder="Company Name"
                                           data-name="company_name">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inputDescription" class="col-lg-2 control-label">Description</label>
                                    <input type="text" class="form-control" id="inputDescription" placeholder="Description"
                                           data-name="description">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Repeater Remove Btn -->
                    <div class="pull-right repeater-remove-btn mb-3 mt-2">
                        <button id="remove-btn" class="btn btn-danger" onclick="$(this).parents('.items').remove()">
                            Remove
                        </button>
                    </div>
                    <div class="clearfix"></div>
                    <div></div>
                </div>
            </div>
            <!-- Repeater End -->
        </div>
    </div>


    <!--PortFolios-->
    <div class="row">
        <h5>User Portfolio</h5>
        <div class="dropzone" data-url="<?=base_url('home/submit_form') ?>">
        </div>
    </div>




    <div class="mt-5 align-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>


    <?php echo form_close(); ?>
</div>

<?php ob_start() ?>

<script>

    Dropzone.options.myAwesomeDropzone = false;
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone(".dropzone", {
        autoProcessQueue: false,
        url: '#',
        maxFilesize: 20,
        acceptedFiles: "image/*"
    });

    myDropzone.on("addedfiles", () => {
        // Input node with selected files. It will be removed from document shortly in order to
        // give user ability to choose another set of files.
        var usedInput = myDropzone.hiddenFileInput;
        // Append it to form after stack become empty, because if you append it earlier
        // it will be removed from its parent node by Dropzone.js.
        setTimeout(() => {
            // myForm - is form node that you want to submit.
            $('#registration-form')[0].appendChild(usedInput);
            // Set some unique name in order to submit data.
            usedInput.name = "files[]";
        }, 0);
    });

</script>

<?php Event::add_content(ob_get_clean(), 'javascript') ?>

