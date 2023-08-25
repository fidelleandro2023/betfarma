@extends('layouts.app')
@section('content')
    <div class="font-sans antialiased">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
            <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">
                <div class="mb-4">
                    <h1 class="font-serif text-3xl font-bold">Create Post</h1>
                </div>
                <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link" id="nav-ventas-espera-tab" data-bs-toggle="tab" data-bs-target="#nav-ventas-espera" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Ventas en espera</button>
                            <button class="nav-link active" id="nav-venta-tab" data-bs-toggle="tab" data-bs-target="#nav-venta" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Venta activa</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade" id="nav-ventas-espera" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div id="accordion">
                                <div class="panel list-group">
                                <!-- panel class must be in -->
                                <a href="#web_dev" data-parent="#accordion" data-toggle="collapse" class="list-group-item">
                                    <h4>Web Development</h4>
                                </a>
                                <div class="collapse" id="web_dev">
                                    <ul class="list-group-item-text">
                                    <li>Javascript</li>
                                    <li>PHP</li>
                                    <li>Wordpress</li>
                                    <li>MYSQL</li>
                                    </ul>
                                </div> 
                                <a href="#desktop" data-parent="#accordion" data-toggle="collapse" class="list-group-item" `>
                                    <h4>Desktop App.</h4>
                                </a>
                                <div class="collapse" id="desktop">
                                    <ul class="list-group-item-text">
                                    <li>C#</li>
                                    <li>Java</li>
                                    <li>Python</li>
                                    </ul>
                                </div>  
                                <a href="#mobile" data-parent="#accordion" data-toggle="collapse" class="list-group-item">
                                    <h4>Mobile App.</h4>
                                </a>
                                <div class="collapse" id="mobile">
                                    <ul class="list-group-item-text">
                                    <li>Android</li>
                                    <li>IOS</li>
                                    <li>Windows</li>
                                    <li>Linux</li>
                                    </ul>
                                </div>
                                </div>
                            </div>
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
                                        <tr>
                                            <td class="col-md-3">
                                                <input type="text" class="form-control">
                                            </td>
                                            <td class="col-md-2">
                                                <input type="text" class="form-control">
                                            </td>
                                            <td class="col col-md-2">
                                                <input type="text" class="form-control">
                                            </td>
                                            <td class="col">
                                                <input type="text" class="form-control">
                                            </td>
                                            <td class="col">
                                                <input type="text" class="form-control">
                                            </td>
                                            <td class="col">
                                                <input type="text" class="form-control">
                                            </td>
                                            <td class="col">
                                                <input type="text" class="form-control">
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
    <script src="{{ asset('js/sales.js')}}"></script>
@endpush('footer')