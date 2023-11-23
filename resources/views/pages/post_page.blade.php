<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Post</title>
        <link rel="icon" type="image/x-icon" href="https://media.istockphoto.com/photos/silhouette-of-profile-guy-in-shirt-with-white-button-in-aqua-menthe-picture-id1206439390?k=20&m=1206439390&s=170667a&w=0&h=wDX4xov95UOzjOgOkTqRurDiTepjhqAA7Q2iFofrO5c=" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
        <style>
            table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            }
        </style>
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                
                {{-- Component for navbar brand --}}
                <x-navbar_brand></x-navbar_brand>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                 
                    {{-- Component for navbar menu --}}
                    <x-navbar_menu></x-navbar_menu>

                </div>
            </div>
        </nav>
        <!-- Page Header-->

        <header 
        class="masthead" 
        style="background-image: url(@if($post->picture != null)
           {{$post->picture}}    
           @else
           {{$post->random}}
           @endif)">
   
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1>{{$post->title}}</h1>
                            <h2 class="subheading">{{$post->short_description}}</h2>
                            <span class="meta">
                                Posted by {{$post->user->name}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">

                    <p>{!! $post->content !!}</p> 
                    
                    </div>
                </div>
            </div>
        </article>

        <div>
            <h1> All Comments </h1>
            @if (count($comments) > 0)
            <table>
                <tr>
                    <th width="70%"> Comment </th>
                    <th> Posted By </th>
                    <th> Posted On </th>
               </tr>
              
                @foreach($comments as $comment)
                <tr>
                        <td width="70%"> {!! substr($comment->content,0,50) !!}</td>
                        <td>  {{$comment->user->name}}</td>  
                        <td> {{ date('d-m-Y', strtotime($comment->created_at));}}  </td> 
                </tr>
                @endforeach 
                
            </table>
            @else
            <p> No Comments Yet </p>
            @endif
           </br></br>
           <form id="addcomment_form" enctype="multipart/form-data">
                <div class="form-group">
                                        <label for="Name" class="col-sm-6 col-md-12 control-label">Post Comment </label>
                                        <div class="col-sm-6">
                                            <textarea id="sample-editor" name="content" class="form-control"
                                                aria-hidden="true" required>
                                            </textarea>
                                            <label class="label-txt label-box"><span id="label_email"></span></label>
                                        </div>
                                        <input type="hidden" id="post_id" value="{{$post->id}}">
                                        <input type="hidden" id="user_id" value="{{auth()->user()->id}}">
                                        <div class="box-footer123">
                                        <button type="button" class="btn btn-info pull-right" id="save-name-button">Post</button>
                                        </div>
                </div>
            </form>
       </div>
        
        <!-- Footer-->
        <x-footer></x-footer>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="{{asset('js/scripts.js')}}"></script>
        <script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>
        <script>
            CKEDITOR.replace('sample-editor');
        </script>
        <script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //save
        var submitForm = $('#addcomment_form').parsley();
        $("#save-name-button").on('click', function (e) {
            if (!submitForm.validate()) {
                return;
            }
            //$('#loading').show();
            var formData = new FormData();
            var desc = CKEDITOR.instances['sample-editor'].getData();
            formData.append("content", desc);
            formData.append("post_id", $("#post_id").val());
            formData.append("user_id", $("#user_id").val());
            $.ajax({
                    //all your regular ajax setup stuff except no success: or error:
                    type: "POST",
                    url: "{{ (route('comment-save', [], false)) }}",
                    processData: false,
                    contentType: false,
                    dataType: "JSON",
                    data: formData
                })
                .done(function (data, status) {
                
                    window.location.reload();
                });
        });

        //save
        $('#id_searchBox').keypress(function (e) {
            var key = e.which;
            if (key == 13) // the enter key code
            {
                window.searchform.submit();
            }
        });

    });


</script>
    </body>
</html>
