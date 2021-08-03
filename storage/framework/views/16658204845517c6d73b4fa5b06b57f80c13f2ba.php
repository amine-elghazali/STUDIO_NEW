



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
                    <h2> Albums </h2>
                </div>

                <div class="card-body">
                        <table class="table caption-top  text-center text-light">
                            <caption> List of Albums </caption>
                            <thead>
                                <tr class="table-dark">
                                    <th></th>
                                    
                                    <th> Album name </th>
                                    <th> Album bio</th>
                                    <th> Artist</th>
                                    <th> Album date </th>
                                    <th> Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td> <img src="<?php echo e(asset ('/images/'.$Album->albumPic )); ?>" alt="Album Picture" style="width:100px" > </td>

                                        <td>  <?php echo e($Album->albumPic); ?></td>
                                        <td>  <?php echo e($Album->albumName); ?>  </td>
                                        <td>  <?php echo e($Album->Bio); ?>  </td>
                                        <td>  <?php echo e(App\Models\Artist::where('idArtist',$Album->id_Artist)->value("fullName")); ?>  </td>
                                        <td>  <?php echo e($Album->albumDate); ?>  </td>

                                        <td style="display: flex">
                                            <div class="pl-5">
                                                <a type="button" href="Albums/<?php echo e($Album->idAlbum); ?>/edit"class="btn btn-warning"> <i class="uil-edit"></i></a>
                                            </div>
                                            <div>
                                                <form action="Albums/<?php echo e($Album->idAlbum); ?>" method="POST">
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
                    
                    <a href="Albums/create" type="button" class="btn btn-secondary ml-2"> Add an Album</a>
                </div>
            </div>
        </div>
    </html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dell\Desktop\proj\STUDIO_NEW\resources\views/Admin/Admin_Album/index.blade.php ENDPATH**/ ?>