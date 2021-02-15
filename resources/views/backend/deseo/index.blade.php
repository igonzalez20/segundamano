@extends('backend.base');

@section('content')
<div class="modal" id="editModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form role="form" action="{{ url('/producto') }}/" method="post" enctype="multipart/form-data" id="editProductoForm">
            @method('put')
            @csrf
                
                <div class="form-group col-md-6">
                    <label class="text-dark" for="descripcion">Descripción</label><br>
                    <textarea class="text-dark" required minlength="10" class="form-control" name="editdescripcion" id="editdescripcion" cols="50" rows="3" placeholder="Descripción del producto">{{ old('descripcion') }}</textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="uso">Uso</label>
                        <select name="edituso" id="edituso"class="text-dark form-control">
                        <option class="text-dark" disable selected>Indica el uso</option>
                            <option class="text-dark" value="0">Nuevo</option>
                            <option class="text-dark" value="1">Usado</option>
                            <option class="text-dark" value="2">Gastado</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-dark" for="precio">Precio</label>
                        <input type="number" name="editprecio" id="editprecio" min="0.10" max="9999.99" step="0.01" value="{{ old('precio') }}" class="form-control text-dark"  placeholder="Precio del producto">
                    </div>                   
                </div>
                <div class="col-md-6">
                    <label class="text-dark" for="imagen">Imagen</label>
                    <input type="file" name="editimagen[]" class="form-control text-dark" placeholder="Precio del producto" multiple>                     
                </div>                                      
      </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Crear producto</button>            
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </form>
    </div>
  </div>
</div>

<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
    <div class="container-fluid">
        <div class="navbar-wrapper">
        <div class="card">
              <div class="card-body">
                <a class="navbar-brand" href="javascript:void(0)">Mis productos</a>
                  <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
                  <a href="javascript:void(0)" id="createProducto" class="btn btn-primary">Crear producto</a>
              </div>
          </div>                
        </div>          
    </div>
</nav>
<br><br><br><br><br><br><br>
<div class="container">
    @if(session()->has('error'))

    <div class="alert alert-danger" roler="alert">
        {{session()->get('error')}}
    </div>
    @endif

    @if(session()->has('result'))
    <div class="alert alert-success" roler="alert">
        Se ha borrado correctamente su deseo
    </div>
    @endif
    <div class="row">
    <table class="table">
    <thead class="text-primary">
        <th>        
            ID
        </th>
        <th>
            Nombre
        </th>
        <th>
            Fecha
        </th>
        <th>
            Ver producto
        </th>
        <th>
            Borrar
        </th>
    </thead>
    <tbody id="tbody">
    @foreach ($deseos as $deseo)
        <tr>
            <td text-primary>
                {{$deseo['id']}}
            </td>
            <td>
                {{$deseo->producto->nombre}}
            </td>
            <td>
                {{$deseo['created_at']}}
            </td>
            <td>
            <a class="tdEdit" href="{{ url('/shop/' .$deseo->producto->nombre . '/' . $deseo['idproducto'] ) }}/">Ver</a>
            </td>    
            <td>
                <a class="deseoBorrar" data-id="{{$deseo['id']}}" href="#">Borrar</a>
            </td>                   
        </tr>
    @endforeach       
    </tbody>
</table>
    </div>
</div>

<form id="formDelete" action="{{ url('backend/deseo') }}" method="post">
    @method('delete')
    @csrf
</form>
@endsection
@section('prescript')
<script>
(function () {

    let enlacesBorrar = document.getElementsByClassName('deseoBorrar');

    for(var i = 0; i < enlacesBorrar.length; i++) {
        enlacesBorrar[i].addEventListener('click', getClassConfirmation);
    }

    function getClassConfirmation(event) {
        let id = event.target.dataset.id; //data-id
        let retVal = confirm('¿Seguro que quieres borrar este deseo?');
        if(retVal) {
            var formDelete = document.getElementById('formDelete');
            formDelete.action += '/' + id;
            formDelete.submit();
        }
    }

})();
</script>
@endsection