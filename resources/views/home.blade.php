@extends('layouts.app')

@section('content')
<div class="container">
    <div class="ongkir-header">
        <h1>Cek Ongkir</h1>
        <p class="lead">
            Project Cek Ongkir ke Seluruh Kota dan Kabupaten di Indonesia
        </p>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100 mx-2 text-center">
                <div class="card-header bg-primary text-white">
                    <h4>Free</h4>
                </div>
                <div class="card-body">
                    <i class="fas fa-truck" style="font-size:80px"></i>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Cek Ongkir Lebih Mudah</li>
                    </ul>
                    <button type="button" class="btn btn-lg btn-block btn-outline-primary"><a href="/register" class="text-decoration-none a-hover">Sign up for free</a></button>
                </div>
            </div>
        </div>
    
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100 mx-2 text-center">
                <div class="card-header bg-success text-white">
                    <h4>Pro</h4>
                </div>
                <div class="card-body">
                    <i class="fas fa-box" style="font-size:80px"></i>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Lacak lokasi paket</li>
                    </ul>
                    <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
                </div>
            </div>
        </div>
    
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100 mx-2 text-center">
                <div class="card-header bg-info text-white">
                    <h4>Enterprise</h4>
                </div>
                <div class="card-body">
                    <i class="fas fa-plane-departure" style="font-size:80px"></i>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Cek Ongkir Pengiriman Internasional</li>
                    </ul>
                    <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-warning text-center">
                    <h4 class="text-white"><strong>Formulir Cek Ongkir</strong></h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="col">
                                <h5 class="text-muted">Asal Pengirim:</h5>
                                <div class="form-group">
                                    <label for="province_origin">Provinsi</label>
                                    <select name="province_origin" id="province_origin" class="form-control">
                                        <option value="">--Provinsi--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="city_origin">Kota/Kabupaten</label>
                                    <select name="city_origin" id="city_origin" class="form-control">
                                        <option value="">-</option>
                                    </select>
                                </div>
                                <h5 class="text-muted mt-3">Tujuan Pengirim:</h5>
                                <div class="form-group">
                                    <label for="city_destination">Kota/Kabupaten</label>
                                    <select name="city_destination" id="city_destination" class="form-control">
                                        <option value="">-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1" class="form-label">Berat Barang:</label>
                                    <input type="text" class="form-control" id="weight" name="weight" placeholder="Masukkan berat dalam gram" required>
                                </div>
                            </div>
                            <div class="col">
                                <h5 class="text-muted mt-3">Pilih Expedisi:</h5>
                                @foreach ($courier as $key => $value)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="courier-{{ $key }}" name="courier[]" value="{{ $value->code }}">
                                    <label class="form-check-label" for="courier-{{ $key }}">{{ $value->title }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <button type="submit" class="btn btn-primary mb-3 mt-3">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch('/api/provinces')
        .then(response => response.json())
        .then(data => {
            let provinceSelect = document.getElementById('province_origin');
            data.forEach(province => {
                let option = document.createElement('option');
                option.value = province.province_id;
                option.textContent = province.province;
                provinceSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching provinces:', error));

    document.getElementById('province_origin').addEventListener('change', function() {
        let provinceId = this.value;
        fetch(`/api/cities/${provinceId}`)
            .then(response => response.json())
            .then(data => {
                let citySelect = document.getElementById('city_origin');
                citySelect.innerHTML = '<option value="">-</option>'; 
                data.forEach(city => {
                    let option = document.createElement('option');
                    option.value = city.city_id;
                    option.textContent = city.city_name;
                    citySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching cities:', error));
    });

    document.getElementById('province_origin').addEventListener('change', function() {
        let provinceId = this.value;
        fetch(`/api/cities/${provinceId}`)
            .then(response => response.json())
            .then(data => {
                let citySelect = document.getElementById('city_destination');
                citySelect.innerHTML = '<option value="">-</option>'; 
                data.forEach(city => {
                    let option = document.createElement('option');
                    option.value = city.city_id;
                    option.textContent = city.city_name;
                    citySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching cities:', error));
    });
});
</script>    
@endsection

  
