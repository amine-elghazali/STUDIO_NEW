

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


    

<div class="m-2">
    
    <?php $__env->startSection('content'); ?>


    <div class="modal fade animate__animated m-auto"  data-animation-in="animate__backInLeft" role="dialog" tabindex="-1" id="ajaxModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title border-bottom shadow-bottom-lg" id="modalHeading"></h4>
                </div>
                <div class="modal-body">
                    <form action="" id="ArtistForm" class="ArtistForm"  method="POST">
                            
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="idArtist" id="idArtist"> <!-- we're using this input to know if the Artist id exist or not , so we can either updates or creates our data -->

                        <div class="row">
                            <div  class="form-group col-6">
                                <label for="fullName">Full name : </label>
                                    <input type="text" id="fullName" name="fullName" class="form-control mb-2" placeholder="Full Name" >
                            </div>

                            <div class="form-group col-6">
                                <label for="userName">User name : </label>
                                    <input type="text" id="userName" name="userName" class="form-control mb-2" placeholder="User Name" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="artistName">Artist name : </label>
                                    <input type="text" id="artistName" name="artistName" class="form-control mb-2" placeholder="Artist Name " >
                            </div>
                            
                            <div class="form-group col-6">
                                <label for="email">Artist Email : </label>
                                    <input type="email" id="email" name="email" class="form-control mb-2" placeholder="exemple@gmail.com" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 col-6">
                                <label for="Bio ">Artist Bio : </label>
                                    <textarea name="Bio" id="Bio" cols="44" rows="5" class="mb-2"></textarea>
                            </div>

                            <div class="form-group col-6">
                                <label for="password">Artist password : </label>
                                    <input type="password" id="password" name="password"  class="form-control mb-2" placeholder="********">
                            </div>
                        </div>

                            <label for="artistPic">Artist picture : </label>
                                <input type="file" name="artistPic" class="form-control mb-2 dropify" data-height="140" id="artistPic">

                            <div class="pt-3">
                                <button class="btn btn-outline-success btn-light shadow-lg" style="display: flex" id="saveBtn" value="create">Save <i class="fas fa-check m-1"></i></button>

                                
                            </div>

                        </div>
                    </form>
                    <button class="btn btn-outline-light text-dark shadow-lg" id="cancelBtn" value="cancel">Exit<i class="far fa-times-circle ml-2"></i></button>
                </div>
            </div>
        </div>
    </div>


            <div>
                <div class="container bg-light">

                    <h2 class="m-auto border-bottom text-center pt-2 card-header"> Artists </h2>
                    <a href="javascript:void(0)" class="btn btn-success shadow m-2" id="CreateNewArtist" data-toggle="modal" data-bs-target="#exampleModal">Add Artist <i class="far fa-plus-square"></i></a>

                    <div class="card-body">
                            <table class="table table-striped  data-table ">
                                <thead class="bg-light">
                                    <tr>
                                        
                                        <th>No</th>
                                        <th> Picture</th>
                                        <th> Full name </th>
                                        <th> User name</th>
                                        <th> Artist name</th>
                                        <th> Email</th>
                                        <th> Artist Bio</th>
                                        <th> Actions</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                  
                                </tbody>
                            </table>
                    </div>

                </div>
            </div>

            
            <?php $__env->stopSection(); ?>
</div>

            
            

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

                    $("#ajaxModal").attr("aria-hidden", "true");
                    $("#ajaxModal").modal('hide');

                        $.ajaxSetup({
                            headers:{
                                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        var table = $(".data-table").DataTable({
                            serverSide:true,
                            processing:true,
                            ajax:"<?php echo e(route('Artists.index')); ?>",
                            columns: [
                                { data : 'DT_RowIndex',name :'DT_RowIndex' },
                                { data : 'Picture',name :'Picture',orderable: false, searchable: false },
                                { data : 'fullName',name :'fullName' },
                                { data : 'userName',name :'userName' },
                                { data : 'artistName',name :'artistName' },
                                { data : 'email',name :'email' },
                                { data : 'Bio',name :'Bio',orderable: false, searchable: false },
                                { data : 'action',name : 'action',orderable: false, searchable: false}
                            ],
                        });

                        $("#cancelBtn").click(function(){
                            
                            $('#ArtistForm').trigger("reset");
                            $('#ajaxModal').modal('hide');

                              
                        });

                        $("#CreateNewArtist").click(function(){

                            // Modal animation :
                                                var ModalAnim = $('.modal');
                                            
                                                ModalAnim.addClass( ModalAnim.attr('data-animation-in') );


                            $('#ArtistId').val('');     // We set the Artist Id to '' ( Tha means we gonna create a data ;)  ) 
                            $('#ArtistForm').trigger("reset");  // To reset the Form  :)
                            $('#modalHeading').html("Add an artist");
                            $('#ajaxModal').modal('show');
                        });

                      
                        $("#saveBtn").click(function(e){

                            e.preventDefault();
                            $(this).html('Save');

                            var idArtist = $('#idArtist').val();
                            var fullName = $('#fullName').val();
                            var userName = $('#userName').val();
                            var artistName = $('#artistName').val();
                            var email = $('#email').val();
                            var Bio = $('#Bio').val();
                            var password = $('#password').val();
                            var file_data = $("#artistPic").prop('files')[0];
                            

                            var formData = new FormData();
                            formData.append('idArtist',idArtist);
                            formData.append('fullName',fullName);
                            formData.append('userName',userName);
                            formData.append('artistName',artistName);
                            formData.append('email',email); 
                            formData.append('Bio',Bio); 
                            formData.append('password',password); 
                            formData.append('artistPic',file_data);   

                            //alert(formData);
                            
                            $.ajax({
                                url : "<?php echo e(route('Artists.store')); ?>",
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
                                    $("#ArtistForm").trigger("reset");
                                  
                                    table.draw();   // refresh the table 
                                },
                                error : function(data){
                                    Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                    footer: '<em> Validate the form ! </em>'
                                    });
                                    console.log('Error:',data)
                                }
                            });
                        });


                            $('body').on('click','.deleteArtist',function(){
                                var id_ToDelete = $(this).data("id");
                                

                                console.log(id_ToDelete);

                                if(confirm("Sure u want to delete this artist ? ")){
                                        $.ajax({
                                        type : "DELETE",
                                        url : "http://127.0.0.1:8000/admin/Artists/"+id_ToDelete,
                                        
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


                            $('body').on('click','.editArtist',function(){
                                var id_ToEdit = $(this).data("id");

                                console.log(id_ToEdit);

                                $.get("http://127.0.0.1:8000/admin/Artists/"+id_ToEdit+"/edit",function(data){
                                    
                                    console.log(data);

                                    $("#modalHeading").html("Edit artist");
                                    $("#ajaxModal").modal("show");
                                    
                                    $("#idArtist").val(data.idArtist);
                                    $('#fullName').val(data.fullName);
                                    $('#userName').val(data.userName);
                                    $('#artistName').val(data.artistName);
                                    $('#email').val(data.email);
                                    $('#Bio').val(data.Bio);
                                    $('#password').val(data.password);
                                });


                            });


                        });

                    

                    

                    

            });
               

               
            </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\dell\Desktop\proj\STUDIO_NEW\resources\views/Admin/Admin_Artist/index.blade.php ENDPATH**/ ?>