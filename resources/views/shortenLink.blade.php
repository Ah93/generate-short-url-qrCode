<!DOCTYPE html>
<html>
<head>
    <title>create url shortener using and QR code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
   
<div class="container my-5">
<div class="row">
                <h1 class="my-2 fs-4 fw-bold text-center">URL Shortener and QR Code Generator</h1>
                    <form method="POST" action="{{ route('generate.shorten.link.post') }}">  
                @csrf  
                <div class="input-group mb-3">  
                  <input type="text" name="link" class="form-control" placeholder="Enter URL" aria-label="Recipient's username" aria-describedby="basic-addon2">  
                  <div class="input-group-append">  
                    <button class="btn btn-success" type="submit">Generate Shorten Link</button>  
                  </div>  
                </div>  
            </form>  
          </div>  
          <div class="card-body">  
         
                @if (Session::has('success'))  
                    <div class="alert alert-success">  
                        <p>{{ Session::get('success') }}</p>  
                    </div>  
                @endif 
   
                <table class="table">
                    <thead>
                        <thead>
                    <tr>
                        <th>ID</th>
                        <th>Short Link</th>
                        <th>Original Link</th>
                         <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($shortLinks as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td><a href="{{ route('shorten.link', $row->code) }}" target="_blank">{{ route('shorten.link', $row->code) }}</a></td>
                            <td>{{ $row->link }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $row->id }}">
                                QRcode
                                </button>
                            </td>
                        </tr>
                       <!-- Modal -->
                       <div class="modal fade" id="exampleModal-{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">QRcode</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h2 style="text-align: center;">Scan the QRcode to get to the site or download it</h2>

                                            <div class="container" style="text-align: center;">
                                            <!-- generate function from simple-qr code package -->
                                            
                                            <img src="data:images/png;base64, {!! base64_encode(QrCode::format('png')->size(250)->generate($row->link)) !!} "> 
                                            </div>

                                            <div class="codesource-link" style="text-align: center;">
                                            <a href=" href="{{ asset('images/png') }}" download>Download</a>
                                   </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach  
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>