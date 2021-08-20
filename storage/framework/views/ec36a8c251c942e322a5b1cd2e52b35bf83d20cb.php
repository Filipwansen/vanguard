

<?php $__env->startSection('page-title', __('Test API')); ?>
<?php $__env->startSection('page-heading', __('API Test')); ?>

<?php $__env->startSection('breadcrumbs'); ?>
    <li class="breadcrumb-item active">
        <?php echo app('translator')->get('API Test'); ?>
    </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/toastr')); ?>/toastr.css"> 
<?php if($message=Session::get('notify')): ?>
<div class="alert alert-success alert-block col-md-4 offset-md-4">
    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
    <li><?php echo e($message); ?></li>       
</div>
<?php endif; ?>
<?php if($message=Session::get('error_notify')): ?>
<div class="alert alert-danger alert-block col-md-4 offset-md-4">
    <button type="button" class="close" data-dismiss="alert"><i class="fas fa-times"></i></button>
    <li><?php echo e($message); ?></li>       
</div>
<?php endif; ?>
<?php echo $__env->make('partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="card">
   <div class="card-body">
        <div class="col-md-12">
            <div class="row" style="padding-bottom: 10px;">
                <h4>OCR Api Test Section</h4>
            </div>            
        </div>
        <div class="col-md-12">
            <div class="row" style="text-align: center">
                <h6>Test API</h6>
            </div> 
            <div class="row">
                <div class="col-sm-3">
                    
                    <div                      
                        id="details-form" 
                        novalidate="novalidate"
                        style="padding-top: 50px;"
                        >
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong id="file-name" style="display: none;"></strong>
                                </div>                                
                            </div>                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="btn btn-default" for="file" style="border: 1px solid black;">Select Image
                                        <input type="file" id="file" hidden accept="image/*" required>
                                    </label>
                                </div>                                
                            </div>                            
                            <div class="col-md-12 mt-2">
                                <button type="submit" class="btn btn-primary" id="test-api" style="width: 124px;">
                                <i class="fas fa-refresh"></i>Execute</button>
                                <a href="javascript:void(0)" class="btn btn-primary" id="hidden-api" style="width: 124px; display:none" disabled>
                                    <i class="fas fa-circle-notch fa-spin" style="font-size: 12pt;"></i>
                                </a>
                            </div>
                        </div>
                    </div>                          
                </div>
                <div class="col-sm-9" style="border-left: solid 5px #54575c;">
                    <div class="col-sm-12"><label>Result:</label></div>
                    
                    <div class="row">
                        <div class="col-sm-4" id="result-value" style="border: dashed 1px #54575c;">
                            ---
                        </div>
                        <div class="col-sm-8" >
                            <pre class="response" style="border: dashed 1px #54575c; height: 400px; margin: 0px;" id="result"></pre>
                        </div>
                    </div>
                </div>
            </div> 
            
        </div>
   </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        //
        $('#file').on('change', function(){    
            let fileName = $('input[type=file]').val().split('\\').pop();

            if(fileName.lastIndexOf('.png') < 0 && fileName.lastIndexOf('.jpg') < 0 && fileName.lastIndexOf('.jpeg') < 0 ) {

                toastr.error('Please select png, jpg images only!'); 
                $('#file-name').html("");
                $('input[type=file]').val(""); 
            }
            else{
                $('#file-name').css('display', '');
                $('#file-name').html(fileName);  
            }
        });

        //
        $('#test-api').on('click', function(e){   
            
            //show/hide btns
            $('#test-api').css('display', 'none');
            $('#hidden-api').css('display', 'block');

            var formData = new FormData();
            formData.append('img', $('#file')[0].files[0]);

            $.ajax({
                url: '<?php echo e(url("api/test-ocr")); ?>',
                type: "POST",
                data: formData,   
                contentType: false,
                processData: false,             
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer <?php echo e($token); ?>');
                },            
                success: function (response) {
                    //show/hide btns
                    $('#test-api').css('display', 'block');
                    $('#hidden-api').css('display', 'none');
                    
                    /* show data */
                    $('#result').text(JSON.stringify(response.content, null, '\t'));

                    /* show values */
                    let values = response.content.Module; let str = "";
                    if(values.length > 0){
                        values.forEach(function(val, key){
                            val.page.forEach(function(valVal, kk){
                               valVal.PageItems.forEach(function(vv, k){
                                   console.log(vv, k);
                                   str += vv.Label + " = " + vv.Value +"<br>";
                               });
                            });
                        });
                    }
                    console.log(str);
                    $('#result-value').html(str);

                },
                error: function (request, response) {
                    $('#test-api').prop("disabled", false);        
                    toastr.error("Web server Error. Try again later.");
                },
                complete: function(response) {
                }
            });

        });
    </script>
<?php $__env->stopSection(); ?>
<style>
.response{
    /* background-color:#282c34; color: white; border-radius: 5px; padding: 10px 0px; padding-left: 25px; min-width: 680px; */
    background-color:#282c34; color: white; border-radius: 5px; padding: 10px 0px; padding-left: 25px; min-width: 300px;
}
.response:before{
    content: "json";
    float: right;
    color: hsla(0,0%,100%,.4);
    padding-right: 10px;
}
</style>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\nvanguard\resources\views/ocr/api-test.blade.php ENDPATH**/ ?>