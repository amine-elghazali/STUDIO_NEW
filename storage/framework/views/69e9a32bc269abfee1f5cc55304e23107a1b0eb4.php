


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
    <div class="m-auto pt-5">
        <div class="card bg-dark">
            <div class="card-header text-light">
                <h2> Songs </h2>
            </div>

            <div class="card-body">
                    <table class="table caption-top  text-center text-light ">
                        <caption> List of Songs </caption>
                        <thead>
                            <tr>

                                <th></th>
                                <th> Song name </th>
                                <th> Song bio </th>
                                <th> Song FullName</th>
                                <th> Song Path</th>
                                <th> Song extension</th>
                                <th> Song Size </th>
                                <th> Song date </th>
                                <th> Action </th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $songs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $song): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr>
                                        <td> <img src="<?php echo e(asset ('/images/'.$song->songPic )); ?>" alt="song Picture" style="width:100px" > </td>

                                        <td>  <?php echo e($song->name); ?>  </td>
                                        <td>  <?php echo e($song->Bio); ?>  </td>
                                        <td>  <?php echo e($song->fullName); ?>  </td>
                                        <td>
                                           <div>
                                               <?php echo e($song->path); ?>

                                           </div>
                                        </td>
                                        <td>  <?php echo e($song->extension); ?>  </td>
                                        <td>  <?php echo e($song->size); ?>  </td>
                                        <td>  <?php echo e($song->songDate); ?>  </td>

                        
                                        <td style="display: flex">
                                            <div class="pl-5">
                                                <a type="button" href="Songs/<?php echo e($song->idSong); ?>/edit" class="btn btn-warning"> <i class="uil-edit"></i> </a>
                                            </div>
                                            <div class="pl-5">
                                                <form action="Songs/<?php echo e($song->idSong); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('delete'); ?>
                                                    <button type="submit" class="btn btn-danger ml-2" > <i class="uil-trash"></i> </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
            </div>
            <div class="card-footer">
                <a href="Songs/create" type="button" class="btn btn-secondary ml-2">Add an song</a>
            </div>
        </div>
    </div>
</html>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dell\Desktop\proj\STUDIO_NEW\resources\views/Admin/Admin_Song/index.blade.php ENDPATH**/ ?>