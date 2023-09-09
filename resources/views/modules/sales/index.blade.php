@extends('layouts.app')
@push('header')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endpush
@section('content')
    <div class="font-sans antialiased">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">
                <div class="mb-4">
                    <h1 class="font-serif text-3xl font-bold">Crear venta</h1>
                </div>
                <div class="botones_sale">
                    <button class="btn btn-secondary" id="add_sales_espera">Agregar a venta en espera</button>
                    <button class="btn btn-primary">Finalizar venta</button>
                </div>
                <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
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
                                        <th class="col">PSP</th>
                                        <th class="col">Dscto</th>
                                        <th class="col">PVP</th>
                                        <th class="col">total</th>
                                    </thead>
                                    <tbody>
                                        <tr class="active">
                                            <td class="col-md-3 ">
                                                <input onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="text" class="name form-control">
                                            </td>
                                            <td class="col-md-2 ">
                                                <input onclick="clickTextField(this)"  onkeyup="keyTextField(this,event)" type="text" class="cantidad form-control">
                                            </td>
                                            <td class="col col-md-2 ">
                                                <input onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="text" class="lote form-control">
                                            </td>
                                            <td class="col ">
                                                <input onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="text" class="psp form-control">
                                            </td>
                                            <td class="col ">
                                                <input onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="text" class="dscto form-control">
                                            </td>
                                            <td class="col ">
                                                <input onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="text" class="pvp form-control">
                                            </td>
                                            <td class="col">
                                                <input onclick="clickTextField(this)" onkeyup="keyTextField(this,event)" type="text" class="total form-control">
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
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="{{ asset('js/sales.js')}}"></script>
@endpush('footer')