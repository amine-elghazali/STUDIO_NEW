

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>        
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
   
    <!-- dropify -->
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">


</head>



<body>

    <?php $__env->startSection('content'); ?>


            <div>
                <div class="container bg-light">

                    <h2 class="m-auto border-bottom text-center pt-2 card-header"> Albums </h2>
                    <a href="javascript:void(0)" class="btn btn-success shadow m-2" id="CreateNewAlbum">Add album <i class="far fa-plus-square"></i></a>

                    <div class="card-body">
                            <table class="table table-striped  data-table">
                                <thead class="bg-light">
                                    <tr>
                                        <th> No </th>
                                        <th> Picture </th>                                        
                                        <th> Artist </th>
                                        <th> Album name </th>
                                        <th> Album bio </th>
                                        <th> Album date </th>
                                        <th> Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                  
                                </tbody>
                            </table>
                    </div>

                </div>
            </div>

            <div class="modal fade animate__animated m-auto"  data-animation-in="animate__backInLeft" role="dialog" tabindex="-1" id="ajaxModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title border-bottom shadow-bottom-lg" id="modalHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form action="" id="AlbumForm" class="AlbumForm"  method="POST">
                                    
                                <?php echo csrf_field(); ?>

                                <input type="hidden" name="idAlbum" id="idAlbum"> <!-- we're using this input to know if the album id exist or not , so we can either updates or creates our data -->

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="id_Artist">Artist : </label>
                                        
                                        <select class="form-select" id="id_Artist" name="id_Artist">
                                            <option value="" selected> Select an artist</option>
                                            <?php $__currentLoopData = $Artists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Artist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                
                                                    <option value="<?php echo e($Artist->idArtist); ?>"><?php echo e($Artist->fullName); ?></option>
                                                
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                   

                                    <div class="form-group col-6">
                                        <label for="albumName">Album name : </label>
                                            <input type="text" id="albumName" name="albumName" class="form-control mb-2">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-md-6 col-6">
                                        <label for="Bio ">Album Bio : </label>
                                            <textarea name="Bio" id="Bio" cols="44" rows="5" class="mb-2"></textarea>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="albumDate">Album date : </label>
                                            <input type="date" id="albumDate" name="albumDate" class="form-control" >
                                    </div>
                                </div>

                                    <label for="albumPic">Album picture : </label>
                                        <input type="file" name="albumPic" id="dropify" class="form-control dropify mb-2" id="albumPic">

                                    <div class="pt-3">
                                        <button class="btn btn-outline-success shadow-lg btn-light" style="display: flex" id="saveBtn" value="create">Save <i class="fas fa-check m-1"></i></button>

                                        
                                    </div>

                                </div>
                            </form>
                            <button class="btn btn-outline-light text-dark shadow-lg" id="cancelBtn" value="cancel">Exit<i class="far fa-times-circle ml-2"></i></button>
                        </div>
                    </div>
                </div>
            </div>

        <?php $__env->stopSection(); ?>
           
            
</body>
</html>


<?php $__env->startSection('javascript'); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script> 
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script type="text/javascript">

            $(document).ready(function(){


               

                $(function(){


                    $('.dropify').dropify({
                        messages: {
                            'default': 'Drag and drop a file here or click',
                            'replace': 'Drag and drop or click to replace',
                            'remove':  'Remove',
                            'error':   'Ooops, something wrong happended.'
                            }
                        });

                        $.ajaxSetup({
                            headers:{
                                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        var table = $(".data-table").DataTable({
                            serverSide:true,
                            processing:true,
                            ajax:"<?php echo e(route('Albums.index')); ?>",
                            columns: [
                                { data : 'DT_RowIndex',name :'DT_RowIndex' },
                                { data:  'Picture',name :'Picture',orderable: false, searchable: false},
                                { data : 'Artist',name :'Artist', searchable: false },
                                { data : 'albumName',name :'albumName',orderable: true, searchable: true },
                                { data : 'Bio',name :'Bio',orderable: false, searchable: false },
                                { data : 'albumDate',name :'albumDate',orderable: false, searchable: false },
                                { data : 'action',name : 'action',orderable: false, searchable: false}
                            ],
                        });

                        $("#cancelBtn").click(function(){
                            $('#AlbumForm').trigger("reset");
                            $('#ajaxModal').modal('hide');
                        });

                        $("#CreateNewAlbum").click(function(){

                            // Modal animation :
                            var ModalAnim = $('.modal');
                                            
                                            ModalAnim.addClass( ModalAnim.attr('data-animation-in') );

                            $('#idAlbum').val('');     // We set the Album Id to '' ( Tha means we gonna create a data ;)  ) 
                            $('#AlbumForm').trigger("reset");  // To reset the Form  :)
                            $('#modalHeading').html("Add an album");
                            $('#ajaxModal').modal('show');
                        });

                      
                        $("#saveBtn").click(function(e){
                            e.preventDefault();
                            $(this).html('Save');

                            var idAlbum = $('#idAlbum').val();
                            var id_Artist = $("#id_Artist option:selected").val();
                            var albumName = $('#albumName').val();
                            var Bio = $('#Bio').val();
                            var albumDate = $('#albumDate').val();
                            var file_data = $("#albumPic").prop('files')[0];
                            
                            //console.log(id_Artist);
                            var formData = new FormData();
                            formData.append('idAlbum',idAlbum);
                            formData.append('id_Artist',id_Artist);
                            formData.append('albumName',albumName);
                            formData.append('Bio',Bio);
                            formData.append('albumDate',albumDate);
                            formData.append('albumPic',file_data); 

                            //alert(formData);
                            console.log(formData);
                            $.ajax({
                                url : "<?php echo e(route('Albums.store')); ?>",
                                type : "POST",
                                dataType : 'json',
                                cache:false,
                                contentType:false,
                                processData:false,
                                data:formData,
                                success : function(data){
                                    Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Your work has been saved',
                                    showConfirmButton: false,
                                    timer: 1500
                                    }),
                                    $("#ajaxModal").modal("hide"); // Hiding  the ajax Modal 
                                    $("#AlbumForm").trigger("reset");
                                    $("#dropify").val('');

                                    table.draw();   // refresh the table 
                                },
                                error : function(data){
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                    footer: '<em> Validate the form ! </em>'
                                    });
                                    console.log('Error:',data);
                                }
                            });
                        });


                            $('body').on('click','.deleteAlbum',function(){
                                var id_ToDelete = $(this).data("id");
                                

                                console.log(id_ToDelete);

                                if(confirm("Sure u want to delete this album ? ")){
                                        $.ajax({
                                        type : "DELETE",
                                        url : "http://127.0.0.1:8000/admin/Albums/"+id_ToDelete,
                                        
                                        success : function(data){
                                            console.log(data);
                                            table.draw();
                                        },
                                        error : function(data){
                                            console.log('Error:',data);
                                            $("#saveBtn").html('Save');
                                        }
                                    })
                                }
                                
                            }); 


                            $('body').on('click','.editAlbum',function(){
                                var id_ToEdit = $(this).data("id");

                                console.log(id_ToEdit);

                                $.get("http://127.0.0.1:8000/admin/Albums/"+id_ToEdit+"/edit",function(data){
                                    
                                    console.log(data);

                                    $("#modalHeading").html("Edit album");
                                    $("#ajaxModal").modal("show");
                                    
                                    $("#idAlbum").val(data.idAlbum);
                                    $("#id_Artist").val(data.id_Artist);
                                    $("#id_Artist option:selected").val(data.id_Artist);
                                    $('#albumName').val(data.albumName);
                                    $('#Bio').val(data.Bio);
                                    $('#albumDate').val(data.albumDate);
                                    $("#albumPic").prop('files')[0];
                                });


                            });

                                
                        });
            });
               

               
            </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dell\Desktop\proj\STUDIO_NEW\resources\views/Admin/Admin_Album/index.blade.php ENDPATH**/ ?>