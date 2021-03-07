<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Setting csrf token in meta tag so that ajax can access it and send it with the post requests-->
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <title>Book a service</title>
        <style>
            .cursor-pointer {
                cursor: pointer;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <!-- logo -->
            <div class="logo-container mt-5 row"><img class="mx-auto" src="{{asset("assets/images/logo.png")}}" /></div>
            <!-- End logo -->

            <!-- User data form -->
            <div class="form-container col-lg-4 col-md-6 mx-auto my-3">
                <div class="alert alert-danger d-none" id="form-alert" role="alert">
                    Please fill in all inputs
                </div>
                <form id="user-data-form">
                    <div class="form-group">
                        <label for="email">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="email">Mobile number</label>
                        <input type="text" class="form-control" id="number" name="number"
                            placeholder="Enter mobile-number">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>
                    <button type="submit" class="btn btn-dark col-12" id="submit">Submit</button>
                </form>
            </div>
            <!-- End user data form -->

            <!-- Services modal -->
            <div class="modal fade" id="services-modal" tabindex="-1" role="dialog"
                aria-labelledby="services-modalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Select one or more services</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="alert alert-danger d-none" id="service-alert" role="alert">
                                    Please choose a service
                                </div>
                                <!-- This row will get the data dynamicly from the database-->
                                <div class="row" id="services-list">
                                </div>
                                <div class="row">
                                    <div class="col-12"><button id="service-modal-submit" type="button"
                                            class="btn btn-primary btn-block mt-1">Next</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                onclick="$('#services-modal').modal('hide')">Close</button>

                        </div>
                    </div>
                </div>
            </div>
            <!-- End services modal -->

            <!-- interest level modal -->
            <div class="modal fade" id="interest-level-modal" tabindex="-1" role="dialog"
                aria-labelledby="interest-level-modalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">How interested are you?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="alert alert-danger d-none" id="interest-alert" role="alert">
                                    Please choose an option
                                </div>
                                <!-- This row will get the data dynamicly from the database-->
                                <div class="row" id="interests-list">
                                </div>
                                <div class="row">
                                    <div class="col-12"><button id="interest-modal-submit" type="button"
                                            class="btn btn-primary btn-block mt-1">Place Order</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                onclick="$('#interest-level-modal').modal('hide')">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End interest level modal -->
        </div>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!-- this is bootstraps CDN and its slim ie.it dosent have ajax -->
        {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script> --}}
        <!-- this is Jquery's uncompressed CDN and it has ajax -->
        <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        <script src="{{asset('assets/js/ajax.js')}}"></script>
        <script src="{{asset('assets/js/main.js')}}"></script>
    </body>

</html>