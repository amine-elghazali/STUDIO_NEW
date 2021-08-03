


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


            <div class=" pl-5 pr-5 m-auto pt-5">
                <div class="card bg-dark">
                    <div class="card-header text-light">
                        <h2> Artists </h2>
                    </div>

                    <div class="card-body">
                            <table class="table caption-top text-center  text-light ">
                                <caption> List of artists </caption>
                                <thead>
                                    <tr class="table-dark">
                                        
                                        <th></th>
                                        <th> Full name </th>
                                        <th> User name</th>
                                        <th> Artist name</th>
                                        <th> Email</th>
                                        <th> Artist Bio</th>
                                        <th> Actions</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $Artists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td> <img src="<?php echo e(asset ('/images/'.$artist->artistPic )); ?>" alt="Artist Picture" style="width: 100px" > </td>
                                            <td>  <?php echo e($artist->fullName); ?>  </td>
                                            <td>  <?php echo e($artist->userName); ?>  </td>
                                            <td>  <?php echo e($artist->artistName); ?>  </td>
                                            <td>  <?php echo e($artist->email); ?>  </td>
                                            <td>  <?php echo e($artist->Bio); ?>  </td>

                                            <td style="display: flex">
                                                <a type="button" href="Albums/<?php echo e($artist->idArtist); ?>/edit" class="btn btn-warning"> <i class="uil-edit"></i></a>

                                                <form action="Artists/<?php echo e($artist->idArtist); ?>" method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('delete'); ?>
                                                    <button type="submit" class="btn btn-danger ml-2" > <i class="uil-trash"></i> </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                    </div>
                    <div class="card-footer">
                        <span class="iconify" data-icon="uil:focus-add" data-inline="false"><a href="Artists/create" type="button" class="btn btn-secondary"> Add Artist</a></span>
                    </div>
                </div>
            </div>
        </html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dell\Desktop\proj\STUDIO_NEW\resources\views/Admin/Admin_Artist/index.blade.php ENDPATH**/ ?>