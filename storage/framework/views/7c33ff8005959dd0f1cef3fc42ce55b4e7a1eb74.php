


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
    
    <form action="/admin/Songs"  method="POST" enctype="multipart/form-data" class="w-50 m-5 text-light">

        <?php echo csrf_field(); ?>

        <label for="id_Artist"> Artist :</label>
            <select name="id_Artist" id="id_Artist" class="form-select form-select-sm"  select-box">
                <option value="" selected> Select an artist</option>

                <?php $__currentLoopData = $Artists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Artist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Artist->idArtist); ?>"><?php echo e($Artist->fullName); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

        <label for="id_Album"> Album :</label>
            <select name="id_Album" id="id_Album" class="form-select form-select-sm">
                <option value="" selected> Select the album</option>

                <?php $__currentLoopData = $Albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($Album->idAlbum); ?>"><?php echo e($Album->albumName); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>


        <label for="name">Song name :</label>
            <input type="text" name="name" class="form-control" id="name">

        <label for="Bio">Song bio : </label>
            <input type="text" name="Bio" class="form-control" id="Bio">

        <label for="songFile">Song File : </label>
            <input type="file" name="songFile" class="form-control" id="songFile">

        <label for="songDate">Song date : </label>
            <input type="date" name="songDate" class="form-control" id="songDate">

        <label for="songPic">Song picture : </label>
            <input type="file" name="songPic" class="form-control" id="songPic">
            
            <button type="submit" class="btn btn-info mt-5"> Submit </button>

    </form>


</body>
</html>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dell\Desktop\proj\STUDIO_NEW\resources\views/Admin/Admin_Song/create.blade.php ENDPATH**/ ?>