
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Home</title>
    <link href="{{asset('css/style.css')}}" rel="stylesheet" />
    <script
      src="https://kit.fontawesome.com/96bf2d4fc0.js"
      crossorigin="anonymous"
    ></script>
</head>
<body>
    <!-- navigation -->
    <nav class="navbar navbar-expand-lg bg-light shadow-lg">

        <div class="container-fluid">
            <a class="navbar-brand p-0" href="/">
                <img src="{{asset('assets/logo.avif')}}" alt="Bootstrap" width="90" height="80" />
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div
                class="collapse navbar-collapse my-3 my-sm-0"
                id="navbarSupportedContent"
            >
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex gap-lg-4">
                    <li class="nav-item">
                        <a class="nav-link fw-bold" aria-current="page" href="/"><i class="fa-solid fa-house"></i> HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold" href="/dashboard"><i class="fa-solid fa-gauge"></i> DASHBOARD</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link  fw-bold" href="/category/create">ADD ITEM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  fw-bold" href="/logout" data-bs-href="/logout" type="button" data-bs-toggle = "modal" data-bs-target="#example">LOGOUT</a>
                    </li> -->
                </ul>

                </ul>

            </div>
        </div>

    </nav>

    <!-- confirm logout -->
    <div class="modal fade" class="confirm-delete" id="example" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold text-success" id="exampleModalLabel">Logout</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-danger text-center h4 fw-bold">Are you sure to Logout?</p>
                    <p class="debug-url"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="/logout" class="btn btn-danger btn-ok">Yes</a>
                </div>
            </div>
        </div>
    </div>

    @yield('content')
    
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>
    <script src="{{asset('js/script.js')}}" ></script>
  </body>
</html>