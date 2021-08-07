
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>        
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">



</head>



<body>


            <div class=" pl-5 pr-5 m-auto pt-5 ">
                <div class="container">

                    <h2> Albums </h2>
                    <a href="javascript:void(0)" class="btn btn-success" id="CreateNewAlbum">Add album <i class="far fa-plus-square"></i></a>

                    <div class="card-body">
                            <table class="table table-bordered  data-table ">
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

            <div class="modal fade" id="ajaxModal" area-hidden="true">
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
                                        
                                        <select class="form-control id="id_Artist" name="id_Artist">
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
                                            <textarea name="Bio" id="Bio" cols="48" rows="5" class="mb-2"></textarea>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="albumDate">Album date : </label>
                                            <input type="date" id="albumDate" name="albumDate" class="form-control" >
                                    </div>
                                </div>

                                    <label for="albumPic">Album picture : </label>
                                        <input type="file" name="albumPic" class="form-control mb-2" id="albumPic">

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

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
            <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        

           
            
</body>
</html>

            <script type="text/javascript">

            $(document).ready(function(){


                $(function(){

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
                                    $("#ajaxModal").modal("hide"); // Hiding  the ajax Modal 
                                    $("#AlbumForm").trigger("reset");
                                    table.draw();   // refresh the table 
                                },
                                error : function(data){
                                    console.log('Error:',data);
                                    $("#saveBtn").html('Save');
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

<?php /**PATH C:\Users\dell\Desktop\proj\STUDIO_NEW\resources\views/Admin/Admin_Album/index.blade.php ENDPATH**/ ?>