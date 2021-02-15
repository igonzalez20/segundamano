@extends('frontend.base')

@section('prescript')
<script>
(function () {

    let createContacto = document.getElementById('createContacto');
    createContacto.addEventListener('click', function() {             
        $('#createModal').modal('show');
    });

    let createDeseo = document.getElementById('createDeseo');
    createDeseo.addEventListener('click', function() {             
        document.getElementById('idproductodeseo').value  = event.target.dataset.id;
        document.getElementById('createDeseoForm').submit();
    });


})();
</script>
@endsection

@section('content')


<form role="form" action="{{ url('backend/deseo') }}" method="post" enctype="multipart/form-data" id="createDeseoForm">
    @csrf
    <input type="hidden" id="idproductodeseo" name="idproductodeseo">
</form>

<div class="modal" id="createModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Mensaje</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form role="form" action="{{ url('backend/contacto') }}" method="post" enctype="multipart/form-data" id="createContactoForm">
            @csrf
            <div class="form-group col-md-6">
                <label class="text-dark" for="descripcion">Mensaje</label><br>
                <textarea class="text-dark" required minlength="5" class="form-control" name="textocontacto" id="textocontacto" cols="50" rows="3" placeholder="Mensaje para el propietario">{{ old('descripcion') }}</textarea>
            </div>
            <input id="idusuario2" name="idusuario2" type="hidden" value="{{$producto['idusuario']}}">                          
            <input id="idproducto" name="idproducto" type="hidden" value="{{$producto['id']}}">  
      </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Enviar mensaje</button>            
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
    </form>
    </div>
  </div>
</div>

<!-- Start All Title Box -->
<div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Shop Detail</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Shop Detail </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box @for ($i = 0; $i < count($producto['imagen']); $i++)                            
                                <li data-target="#carousel-example-1" data-slide-to="{{ $i }}" class="active">
                                    <img class="  img-fluid" src="{{ url('assets/pictures/' . $producto['imagen'][$i]) }}" alt="" />
                                </li>
                            @endfor -->

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
        @if(session()->has('error'))

            <div class="alert alert-danger" roler="alert">
                {{session()->get('error')}}
            </div>
        @endif
        
        @if(session()->has('result'))
            <div class="alert alert-success" roler="alert">
                Se ha guardado correctamente su deseo
            </div>
        @endif
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                       
                    @foreach($producto['imagen'] as $imagenes)
                        
                        @if($producto['imagen'][0] == $imagenes)    
                            <div class="carousel-item active"> <img class="d-block w-100" src="{{ url('assets/pictures/' . $imagenes) }}"> </div>
                       
                        @else
                        <div class="carousel-item"> <img class="d-block w-100" src="{{ url('assets/pictures/' . $imagenes) }}"> </div>
                        @endif
                        @endforeach     
                        
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
						<i class="fa fa-angle-left" aria-hidden="true"></i>
						<span class="sr-only">Previous</span> 
					</a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
						<i class="fa fa-angle-right" aria-hidden="true"></i> 
						<span class="sr-only">Next</span> 
					</a>
                        <ol style="background-color: white;" class="carousel-indicators">
                            @for ($i = 0; $i < count($producto['imagen']); $i++)                            
                                <li  data-target="#carousel-example-1" data-slide-to="{{ $i }}" class="active">
                                    <img class="d-block w-100 img-fluid" src="{{ url('assets/pictures/' . $producto['imagen'][$i]) }}" alt="" />
                                </li>
                            @endfor                            
                        </ol>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2>{{$producto['nombre']}}</h2>
                        <h5>{{$producto['precio']}}</h5>
                        <p class="available-stock"><span> More than 20 available / <a href="#">8 sold </a></span>
                            <p>
                                <h4>Description:</h4>
                                <p>{{$producto['descripcion']}}</p>
                                <ul>
                                    <li>
                                    <div class="form-group quantity-box">
                                        <label class="control-label">Uso</label>
                                        <input class="form-control" value="{{$uso[$producto['uso']]}}"  type="text" disabled>
                                    </div>
                                    </li>
                                    <li>
                                        <div class="form-group quantity-box">
                                            <label class="control-label">Estado</label>
                                            <input class="form-control" value="{{$estado[$producto['estado']]}}"  type="text" disabled>
                                        </div>
                                    </li>
                                </ul>

                                <div class="add-to-btn">
                                    <div class="add-comp">
                                    
                                        <a id="createDeseo" data-id="{{$producto['id']}}" class="btn hvr-hover" href="javascript:void(0)"><i class="fas fa-heart"></i> Add to wishlist</a>
                                        <a id="createContacto" class="btn hvr-hover" data-fancybox-close="" href="javascript:void(0)"><i class="fas fa-bags-shopping"></i>Contact with owner</a>
                                        
                                    </div>
                                    <div class="share-bar">
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                                        <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Featured Products</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                    </div>
                    <div class="featured-products-box owl-carousel owl-theme">
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{ url('assets/frontend/images/img-pro-01.jpg') }}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    <h5> $9.79</h5>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{ url('assets/frontend/images/img-pro-02.jpg') }}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    <h5> $9.79</h5>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{ url('assets/frontend/images/img-pro-03.jpg') }}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    <h5> $9.79</h5>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{ url('assets/frontend/images/img-pro-04.jpg') }}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    <h5> $9.79</h5>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{ url('assets/frontend/images/img-pro-01.jpg') }}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    <h5> $9.79</h5>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{ url('assets/frontend/images/img-pro-02.jpg') }}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    <h5> $9.79</h5>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{ url('assets/frontend/images/img-pro-03.jpg') }}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    <h5> $9.79</h5>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="products-single fix">
                                <div class="box-img-hover">
                                    <img src="{{ url('assets/frontend/images/img-pro-04.jpg') }}" class="img-fluid" alt="Image">
                                    <div class="mask-icon">
                                        <ul>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                        </ul>
                                        <a class="cart" href="#">Add to Cart</a>
                                    </div>
                                </div>
                                <div class="why-text">
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    <h5> $9.79</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

@endsection