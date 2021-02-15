@extends('backend.base');

@section('content')
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
                <textarea class="text-dark" required minlength="5" class="form-control" name="textocontacto" id="textocontacto" cols="50" rows="3" placeholder="Mensaje para el propietario">{{ old('textocontacto') }}</textarea>
            </div>
            <input id="idusuario2" name="idusuario2" type="hidden" value="">                          
            <input id="idproducto" name="idproducto" type="hidden" value="">  
      </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Enviar mensaje</button>            
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
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
    <div class="row">
        <h2>enviados recientes</h2>
    <table class="table">
    <thead class="text-primary">
        <th>        
            ID
        </th>
        <th>
            usuario
        </th>
        <th>
            producto
        </th>
        <th>
            texto            
        </th>
        <th>
            Fecha
        </th>
        <th>
            Mensaje
        </th>
    </thead>
    <tbody id="tbody">
    @foreach ($enviados as $enviado)
        <tr>
            <td text-primary>
                {{$enviado['id']}}
            </td>
            <td>
                {{$enviado->getidusuario2->name}}
            </td>
            <td>
                {{$enviado->producto->nombre}}
            </td>
            <td>
                {{$enviado['textocontacto']}}
            </td>
            <td>
                {{$enviado['created_at']}}
                
            </td>
            <td>
            <a id="tdEnviados" 
                data-idusuario2="{{$enviado['idusuario2']}}" data-idproducto="{{$enviado['idproducto']}}"
                href="javascript:void(0)">enviar mensaje</a>
            </td>
        </tr>
    @endforeach       
    </tbody>
</table>
<br><br><br><br><br><br><br>
<h2>recibidos recientes</h2>
<table class="table">
    <thead class="text-primary">
        <th>        
            ID
        </th>
        <th>
            usuario
        </th>
        <th>
            producto
        </th>
        <th>
            texto            
        </th>
        <th>
            Fecha
        </th>
        <th>
            Mensaje
        </th>
    </thead>
    <tbody id="tbody">
    @foreach ($recibidos as $recibido)
        <tr>
            <td text-primary>
                {{$recibido['id']}}
            </td>
            <td>
                {{$recibido->getidusuario1->name}}
            </td>
            <td>
                {{$recibido->producto->nombre}}
            </td>
            <td>
                {{$recibido['textocontacto']}}
            </td>
            <td>
                {{$enviado['created_at']}}                
            </td>
            <td>
            <a id="tdRecibidos" 
                data-idusuario2="{{$enviado['idusuario1']}}" data-idproducto="{{$enviado['idproducto']}}"
                href="javascript:void(0)">Enviar mensaje</a>
            </td>
        </tr>
    @endforeach       
    </tbody>
</table>
    </div>
</div>
@endsection
@section('prescript')
<script>
(function () {

    let createContactoEnviado = document.getElementById('tdEnviados');
    createContactoEnviado.addEventListener('click', function() {   
        
        document.getElementById('idusuario2').value  = event.target.dataset.idusuario2;
        document.getElementById('idproducto').value  = event.target.dataset.idproducto;
        $('#createModal').modal('show');
    });

    let createContactoRecibidos = document.getElementById('tdRecibidos');
    createContactoRecibidos.addEventListener('click', function() {   
        
        document.getElementById('idusuario2').value  = event.target.dataset.idusuario2;
        document.getElementById('idproducto').value  = event.target.dataset.idproducto;
        $('#createModal').modal('show');
    });

})();
</script>
@endsection