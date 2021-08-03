

<?php $__env->startSection('content'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>
</head>

<body >
    <div class="card m-auto bg-dark text-light">

        <div class="card-header">
            <h3 class="card-title"> Add an artist </h3>
        </div>


        <div class="card-body ">
            <form action="/admin/Artists "  method="POST" enctype="multipart/form-data">
              <?php echo csrf_field(); ?>

                <div  class="form-group ">
                    <label for="fullName">Full name : </label>
                        <input type="text" id="fullName" name="fullName" class="form-control" placeholder="Full Name" >
                </div>

                <div class="form-group">
                    <label for="userName">User name : </label>
                        <input type="text" id="userName" name="userName" class="form-control" placeholder="User Name" >
                </div>

                <div class="form-group">
                    <label for="artistName">Artist name : </label>
                        <input type="text" id="artistName" name="artistName" class="form-control" placeholder="Artist Name " >
                </div>

                <div class="form-group">
                    <label for="role_id">Role : </label>
                    <input type="text" class="form-control"  disabled name="role_id" id="role_id" value="<?php echo e($Role); ?>">

                </div>

                <div class="form-group">
                    <label for="email">Artist Email : </label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="exemple@gmail.com" >
                </div>

                <div class="form-group col-md-6 ">
                    <label for="Bio ">Artist Bio : </label>
                        <textarea name="Bio" id="Bio" cols="90" rows="7"></textarea>
                </div>

                <div class="form-group">
                    <label for="password">Artist Password : </label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="******" >
                </div>

                <label for="artistPic">Song picture : </label>
                    <input type="file" name="artistPic" class="form-control" id="artistPic">

                <div class="pt-3">
                    <button type="submit" class="btn btn-secondary"> Add artist</button>
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


</body>
</html>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dell\Desktop\proj\STUDIO_NEW\resources\views/Admin/Admin_Artist/create.blade.php ENDPATH**/ ?>