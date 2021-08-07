
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>        
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">



</head>



<body>


            <div class=" pl-5 pr-5 m-auto pt-5 ">
                <div class="container">

                    <h2> Songs </h2>
                    <a href="javascript:void(0)" class="btn btn-success" id="CreateNewSong">Add song <i class="far fa-plus-square"></i></a>

                    <div class="card-body">
                            <table class="table table-bordered  data-table ">
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
                            <form action="" id="SongForm" class="SongForm"  method="POST">
                                    
                                @csrf

                                <input type="hidden" name="idSong" id="idSong"> 

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="id_Artist">Artist : </label>
                                            
                                            <select class="form-control" id="id_Artist" name="id_Artist">
                                                <option value="" selected> Select an artist</option>
                                                @foreach ($Artists as $Artist)
                                                    
                                                        <option value="{{$Artist->idArtist}}">{{$Artist->fullName}}</option>
                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                    
                                        <div class="form-group col-6">
                                            <label for="id_Album">Album : </label>
                                            
                                            <select class="form-control" id="id_Album" name="id_Album">
                                                <option value="" selected> Select an Album</option>
                                                @foreach ($Albums as $Album)
                                                    
                                                        <option value="{{$Album->idAlbum}}">{{$Album->albumName}}</option>
                                                    
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                    </div>

                                        
                                    <div class="row">

                                        <div class="form-group col-6">
                                            <label for="name">Song name : </label>
                                                <input type="text" id="name" name="name" class="form-control mb-2">
                                        </div>

                                        <div class="form-group col-md-6 col-6">
                                            <label for="Bio ">Song Bio : </label>
                                                <textarea name="Bio" id="Bio" cols="48" rows="5" class="mb-2"></textarea>
                                        </div>

                                    </div>
                                    

                                    <div class="row">

                                        <div class="form-group col-12">
                                            <label for="songDate">Song date : </label>
                                                <input type="date" id="songDate" name="songDate" class="form-control" >
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="form-group col-6">
                                            <label for="songFile">Song Audio : </label>
                                                <input type="file" name="songFile" class="form-control mb-2" id="songFile">
                                        </div>
                                    
                                        <div class="form-group col-6">
                                            <label for="songPic">Song Picture : </label>
                                                <input type="file" name="songPic" class="form-control mb-2" id="songPic">
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

            <div class="modal fade" id="songDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Song Details</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <B>Path :</B><div id="path"></div>
                      <B>Extension :</B><div id="extension"></div>
                      <B>Release date :</B><div id="songDateDetail"></div>
                      <B>Size :</B><div id="size"></div>ko
                    </div>
                    <div class="modal-footer">
                      <button type="button" id="colseDetailModal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                            ajax:"{{route('Songs.index')}}",
                            columns: [
                                { data : 'DT_RowIndex',name :'DT_RowIndex' },
                                { data:  'Picture',name :'Picture',orderable: false, searchable: false},
                                { data : 'Artist',name :'Artist', searchable: false },
                                { data : 'Album',name :'Album', searchable: false },
                                { data : 'name',name :'name',orderable: true},
                                { data : 'fullName',name :'fullName',orderable: true},
                                { data : 'Bio',name :'Bio',orderable: false, searchable: false },
                                { data : 'action',name : 'action',orderable: false, searchable: false},
                                { data : 'details',name:'details'}
                            ],
                        });
                        
                        $("#cancelBtn").click(function(){
                            $('#SongForm').trigger("reset");
                            $('#ajaxModal').modal('hide');
                        });

                        $("#CreateNewSong").click(function(){

                            $('#idSong').val('');     // We set the Song Id to '' ( Tha means we gonna create a data ;)  ) 
                            $('#SongForm').trigger("reset");  // To reset the Form  :)
                            $('#modalHeading').html("Add a song");
                            $('#ajaxModal').modal('show');
                        });

                      
                        $("#saveBtn").click(function(e){
                            e.preventDefault();
                            $(this).html('Save');

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
                                url : "{{route('Songs.store')}}",
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
                                    
                                    $("#idAlbum").val(data.idAlbum);
                                    $("#id_Artist option:selected").val(data.id_Artist);
                                    $("#id_Album option:selected").val(data.id_Album);
                                    $('#name').val(data.name);
                                    $('#Bio').val(data.Bio);
                                    $('#songDate').val(data.songDate);
                                    $("#albumPic").val();
                                    $("#songFile").val();
                                });


                            });

                        });


                        $('body').on('mouseover','.detailSong',function(){
                                var id_songDetails = $(this).data("id");
                                
                                console.log(id_songDetails);

                                $.get("http://127.0.0.1:8000/admin/Songs/"+id_songDetails+"/edit",function(data){
                                    
                                    console.log(data.songDate);

                                    $("#modalHeading").html("Edit song");
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

