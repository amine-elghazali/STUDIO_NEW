



<?php $__env->startSection('content'); ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">

            <title>Document</title>
        </head>

        <body>
            <div class= " pl-5 pr-5 m-auto pt-5 text-light">

                <div class="card bg-dark" >

                    <div class="card-header text-light">
                        <h3> Add an album </h3>
                    </div>

                    <div class="card-body">
                        <form action="/admin/Albums"  method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label for="id_Artist">Album artist : </label>
                                
                                <select id="id_Artist" class="form-select" name="id_Artist" class="form-control">
                                    <option value="" selected> Select an artist</option>
                                    <?php $__currentLoopData = $Artists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Artist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        
                                            <option value="<?php echo e($Artist->idArtist); ?>"><?php echo e($Artist->fullName); ?></option>
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                            </div>

                            <div  class="form-group">
                                <label for="albumName">Album name : </label>
                                    <input type="text" id="albumName" name="albumName" class="form-control" placeholder="Album name" >
                            </div>

                            <div class="form-group">
                                <label for="Bio">Album Bio : </label>
                                    <input type="text" id="Bio" name="Bio" class="form-control" placeholder="Album Bio" >
                            </div>

                            <div class="form-group">
                                <label for="albumDate">Album date : </label>
                                    <input type="date" id="albumDate" name="albumDate" class="form-control" >
                            </div>

                            <label for="albumPic">Song picture : </label>
                                <input type="file" name="albumPic" class="form-control" id="albumPic">
                            

                            <div class="pt-3">
                                <button type="submit" class="btn btn-secondary"> Add album</button>
                            </div>

                        </form>
                    </div>

                    <!--    PRINTING ERRORS     -->

                    <?php if($errors->any()): ?>
                        <div class="card-footer">
                            <div class="text-danger text-center m-auto ">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-unstyled">
                                        <?php echo e($error); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


        </body>
        </html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dell\Desktop\proj\STUDIO_NEW\resources\views/Admin/Admin_Album/create.blade.php ENDPATH**/ ?>