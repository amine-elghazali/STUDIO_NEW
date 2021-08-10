

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
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">


</head>

<style>
    .data-table.dataTables_filter {
  float: right;
  text-align: right;
}
</style>
    
<body>

<div class="container m-2">
    <?php $__env->startSection('content'); ?>

            <div>
                <div class="container bg-light">

                    <h2 class="m-auto border-bottom text-center pt-2 card-header"> Songs </h2>
                    <a href="javascript:void(0)" class="btn btn-success shadow m-2" id="CreateNewSong">Add song <i class="far fa-plus-square"></i></a>

                    <div class="card-body table-responsive">
                            <table class="table table-striped table-bordered data-table ">
                                <thead class="bg-light">
                                    <tr>
                                        <th> No </th>
                                        <th> Picture </th>                                        
                                        <th> Artist </th>
                                        <th> Album </th>
                                        <th> Song name </th>
                                        <th> Full song name </th>
                                        <th> Bio </th>
                                        <th> Actions</th>
                                        <th> details</th>
                                    </tr>
                                </thead>

                                <tbody class="tdyat">
                                  
                                </tbody>
                            </table>
                    </div>

                </div>
            </div>
            
            <div class="modal fade animate__animated"  data-animation-in="animate__backInLeft" role="dialog" tabindex="-1" id="ajaxModal" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title border-bottom shadow-bottom-lg" id="modalHeading"></h4>
                        </div>
                        <div class="modal-body">
                            <form action="" id="SongForm" class="SongForm"  method="POST">
                                    
                                <?php echo csrf_field(); ?>

                                <input type="hidden" name="idSong" id="idSong"> 

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="id_Artist">Artist : </label>
                                            
                                            <select class="form-select m-1" id="id_Artist" name="id_Artist">
                                                <option value="" selected> Select an artist</option>
                                                <?php $__currentLoopData = $Artists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Artist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    
                                                        <option value="<?php echo e($Artist->idArtist); ?>"><?php echo e($Artist->fullName); ?></option>
                                                    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    
                                        <div class="form-group col-6">
                                            <label for="id_Album">Album : </label>
                                            
                                            <select class="form-select m-1" id="id_Album" name="id_Album">
                                                <option value="" selected> Select an Album</option>
                                                <?php $__currentLoopData = $Albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    
                                                        <option value="<?php echo e($Album->idAlbum); ?>"><?php echo e($Album->albumName); ?></option>
                                                    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        
                                    </div>

                                        
                                    <div class="row row-cols-2">

                                        <div class="form-group ">
                                            <label for="name">Song name : </label>
                                                <input type="text" id="name" name="name" class="form-control m-1">

                                            <label for="songDate">Song date : </label>
                                                <input type="date" id="songDate" name="songDate" class="form-control m-1" >

                                        </div>

                                        <div class="form-group col-md-6 ">
                                            <label for="Bio ">Song Bio : </label>
                                                <textarea name="Bio" id="Bio" cols="44" rows="5" class="m-1"></textarea>
                                        </div>

                                    </div>
                                    

                                    <div class="row">

                                        <div class="form-group col-6">
                                            <label for="songFile">Song Audio : </label>
                                                <input type="file" name="songFile" class="dropify form-control m-1" id="songFile">
                                        </div>
                                    
                                        <div class="form-group col-6">
                                            <label for="songPic">Song Picture : </label>
                                                <input type="file" name="songPic" class="dropify form-control m-1" id="songPic">
                                        </div>

                                    </div>
                                    

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

            <div class="modal fade animate__animated" id="songDetailsModal"  data-animation-in="animate__fadeInTopLeft" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Song Details</h5>
                      <button type="button" id="colseDetailModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <B>Path :</B><div id="path"></div>
                      <B>Extension :</B><div id="extension"></div>
                      <B>Release date :</B><div id="songDateDetail"></div>
                      <B>Size ( <em>Ko</em>  ) :</B><div id="size"></div> 
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


                $('.dropify').dropify({
                        messages: {
                            'default': 'Drag and drop a file here or click',
                            'replace': 'Drag and drop or click to replace',
                            'remove':  'Remove',
                            'error':   'Ooops, something wrong happended.'
                            }
                        });

                $(function(){

                        $.ajaxSetup({
                            headers:{
                                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        var table = $(".data-table").DataTable({
                            serverSide:true,
                            processing:true,
                            ajax:"<?php echo e(route('Songs.index')); ?>",
                            columns: [
                                { data : 'DT_RowIndex',name :'DT_RowIndex' },
                                { data :  'Picture',name :'Picture',orderable: false, searchable: false},
                                { data : 'Artist',name :'Artist', searchable: false },
                                { data : 'Album',name :'Album', searchable: false },
                                { data : 'name',name :'name',orderable: true},
                                { data : 'fullName',name :'fullName',orderable: true},
                                { data : 'Bio',name :'Bio',orderable: false, searchable: false },
                                { data : 'action',name : 'action',orderable: false, searchable: false},
                                { data : 'details',name:'details'}
                            ],
                            pageLength: 3,
                            "lengthMenu": [ 3,6,9,12,15]
                        });
                        
                        $("#cancelBtn").click(function(){
                            $('#SongForm').trigger("reset");
                            $('#ajaxModal').modal('hide');
                        });

                        $("#CreateNewSong").click(function(){

                            // Modal animation :
                            var ModalAnim = $('#ajaxModal');
                                            
                                            ModalAnim.addClass( ModalAnim.attr('data-animation-in') );

                            $('#idSong').val('');     // We set the Song Id to '' ( Tha means we gonna create a data ;)  ) 
                            $('#SongForm').trigger("reset");  // To reset the Form  :)
                            $('#modalHeading').html("Add a song");
                            $('#ajaxModal').modal('show');
                        });

                      
                        $("#saveBtn").click(function(e){
                            e.preventDefault();

                            var idSong = $('#idSong').val();
                            var id_Artist = $("#id_Artist option:selected").val();
                            var id_Album = $("#id_Album option:selected").val();
                            var name = $('#name').val();
                            var Bio = $('#Bio').val();
                            var songDate = $('#songDate').val();
                            var file_data = $("#songPic").prop('files')[0];
                            var audio_data = $("#songFile").prop('files')[0];
                            
                            //console.log(id_Artist);
                            var formData = new FormData();
                            formData.append('idSong',idSong);
                            formData.append('id_Artist',id_Artist);
                            formData.append('id_Album',id_Album);
                            formData.append('name',name);
                            formData.append('Bio',Bio);
                            formData.append('songDate',songDate);
                            formData.append('songPic',file_data); 
                            formData.append('songFile',audio_data); 

                            //alert(formData);
                            console.log(formData);
                            $.ajax({
                                url : "<?php echo e(route('Songs.store')); ?>",
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
                                    });
                                    $("#ajaxModal").modal("hide"); // Hiding  the ajax Modal 
                                    $("#SongForm").trigger("reset");

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

                            $('body').on('click','.deleteSong',function(){
                                var id_ToDelete = $(this).data("id");
                                

                                console.log(id_ToDelete);

                                if(confirm("Sure u want to delete this song ? ")){
                                        $.ajax({
                                        type : "DELETE",
                                        url : "http://127.0.0.1:8000/admin/Songs/"+id_ToDelete,
                                        
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


                            $('body').on('click','.editSong',function(){
                                var id_ToEdit = $(this).data("id");

                                console.log(id_ToEdit);

                                $.get("http://127.0.0.1:8000/admin/Songs/"+id_ToEdit+"/edit",function(data){
                                    
                                    console.log(data);

                                    $("#modalHeading").html("Edit song");
                                    $("#ajaxModal").modal("show");
                                    
                                    $("#idSong").val(data.idAlbum);
                                    $("#id_Album").val(data.id_Album);
                                    $("#id_Album option:selected").val(data.id_Album);
                                    $("#id_Artist").val(data.id_Artist);
                                    $("#id_Artist option:selected").val(data.id_Artist);
                                    $('#name').val(data.name);
                                    $('#Bio').val(data.Bio);
                                    $('#songDate').val(data.songDate);
                                    $("#albumPic").val();
                                    $("#songFile").val();
                                });


                            });

                        });


                        $('body').on('mouseover','.detailSong',function(){

                             // Modal animation :
                             var ModalAnim = $('#songDetailsModal');
                                            
                                            ModalAnim.addClass( ModalAnim.attr('data-animation-in') );

                                var id_songDetails = $(this).data("id");
                                
                                console.log(id_songDetails);

                                $.get("http://127.0.0.1:8000/admin/Songs/"+id_songDetails+"/edit",function(data){
                                    
                                    console.log(data.songDate);

                                    

                                    $("#songDetailsModal").modal("show");


                                    
                                    $('#path').html(data.path);
                                    $('#extension').html(data.extension);
                                    $('#songDateDetail').html(data.songDate);
                                    $('#size').html(data.size);
                                    
                                });
                                
                                
                            }); 

                            $("#colseDetailModal").click(function(){
                                $("#songDetailsModal").modal("hide");
                            });

            });
               

               
            </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dell\Desktop\proj\STUDIO_NEW\resources\views/Admin/Admin_Song/index.blade.php ENDPATH**/ ?>