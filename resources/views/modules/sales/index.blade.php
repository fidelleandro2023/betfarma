@extends('layouts.app')
@push('header')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endpush
@section('content')
    <div class="modal fade" id="searchProdModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Buscar producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"> 
                    <table class="table">
                        <thead>
                            <thead>Nombre comercial</thead>
                            <thead>Lab</thead>
                            <thead>Precio Dscto</thead>
                            <thead>Precio unit</thead>
                            <thead>Stock caja</thead>
                            <thead>Stock unit</thead>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
    <div class="font-sans antialiased">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">
                <div class="container">
                 PSP = Proveedores de Servicios de Pago, PVP = Precio venta al publico
                </div>
                <div class="row">
                    <div class="col-4">
                        <h1 class="font-serif text-3xl font-bold">Crear venta</h1>
                    </div>
                    <div class="col-8 botones_sale">
                        <button class="btn btn-secondary" id="add_sales_espera" style="float:right;">Agregar a espera</button>
                        <button class="btn btn-primary" id="finish_sales" style="float:right;">Finalizar venta</button>
                    </div>
                </div> 
                <div class="w-full px-6 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link" id="nav-ventas-espera-tab" data-bs-toggle="tab" data-bs-target="#nav-ventas-espera" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Ventas en espera (<span>0</span>)</button>
                            <button class="nav-link active" id="nav-venta-tab" data-bs-toggle="tab" data-bs-target="#nav-venta" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Venta activa</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade" id="nav-ventas-espera" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div id="accordion_sales"></div>
                        </div>
                        <div class="tab-pane fade  show active" id="nav-venta" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <form method="POST" action="">
                                @csrf
                                <table class="table">
                                    <thead>
                                        <th class="col-md-4">Nombre comercial</th>
                                        <th class="col">Cantidad</th>
                                        <th class="col">Lote</th>
                                        <th class="col" title="Proveedores de Servicios de Pago">PSP</th>
                                        <th class="col" title="Descuento">Dscto</th>
                                        <th class="col" title="PVP = Precio venta al publico">PVP</th>
                                        <th class="col">total</th>
                                    </thead>
                                    <tbody>
                                        <tr class="active">
                                            <td class="col-md-3 ">
                                                <input value="" onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="text" class="name form-control">
                                            </td>
                                            <td class="col-md-2 ">
                                                <input value="" onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="text" class="cantidad form-control">
                                            </td>
                                            <td class="col col-md-2 ">
                                                <input value="" onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="number" class="lote form-control">
                                            </td>
                                            <td class="col">
                                                <input value="0.000" onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="number" class="psp form-control">
                                            </td>
                                            <td class="col ">
                                                <input value="0.00" onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="number" class="dscto form-control">
                                            </td>
                                            <td class="col ">
                                                <input value="0.000" onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="number" class="pvp form-control">
                                            </td>
                                            <td class="col">
                                                <input value="0.00" onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="number" class="total form-control">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer') 
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ asset('js/sales.js')}}"></script>
@endpush('footer')