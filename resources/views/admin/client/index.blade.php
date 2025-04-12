@extends('admin.includes.base')
@push('styles')
<style>
.pac-container { z-index: 100000!important; }
.col-half
{
    width: 155px!important;
}
.last-input
{
border-top-right-radius: 15px!important;
border-bottom-right-radius: 15px!important;
}
</style>
@endpush
@section('content')
<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-5 align-self-center">
        <h4 class="page-title">Clients</h4>
        <div class="d-flex align-items-center"> </div>
      </div>
      <div class="col-7 align-self-center">
        <div class="d-flex no-block justify-content-end align-items-center">
          <div class="d-flex no-block justify-content-end align-items-center">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"> <a href="{{ url('admin/home') }}">Home</a> </li>
                <li class="breadcrumb-item active" aria-current="page">Clients</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('common.notify')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card bg-light">
          <div class="card-body">
            <div class="d-flex m-b-30 no-block">
              <h5 class="card-title m-b-0 align-self-center">View Clients</h5>
              <div class="ml-auto">
                <div class="dl">
                  <div class="col-3 align-self-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="icon-Add"></i> Add Client</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table bg-white table-bordered nowrap display file_export">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Added On</th>
                    <th class="noExport">Actions</th>
                  </tr>
                </thead>
                <tbody>
                
                @foreach($clients as $index => $client)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $client->title.' '.$client->first_name.' '.$client->last_name }}</td>
                  <td>@if(!empty($client->email)) <a href="mailto:{{ $client->email }}">{{ $client->email }}</a> @else - @endif</td>
                  <td>{{ $client->phone ?? '-' }}</td>
                  <td>@if(!empty($client->email)) {{ date('d/m/Y',strtotime($client->created_at)) }} @else - @endif</td>
                  <td><form action="{{ route('admin.client.destroy', $client->client_id) }}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="button" class="btn btn-info btn-sm editRecord" data-id="{{ $client->client_id }}"><i class="fa fa-edit"></i> Edit</button>
                      <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i> Delete</button>
                    </form></td>
                </tr>
                @endforeach
                </tbody>
                
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="myModal" aria-labelledby="exampleModalLabel1" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success" style="display:none"></div>
        <form class="form-horizontal r-separator" action="{{route('admin.client.store')}}" method="POST" enctype="multipart/form-data" role="form" id="form">
          {{csrf_field()}}
          <input type="hidden" name="client_id" value="" />
          <div class="row">
            <div class="col-6">
              <div class="form-group has-feedback">
                <label>Name<span class="asterrisk">*</span></label>
                <div class="input-group">
                  <select type="text" class="form-control" name="title">
                    <option value="">No title</option>
                    <option value="Mr.">Mr.</option>
                    <option value="Ms.">Ms.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Miss.">Miss.</option>
                    <option value="Dr.">Dr.</option>
                  </select>
                  <input type="text" class="form-control" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" autocomplete="off">
                  <input type="text" class="form-control last-input" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" autocomplete="off">
				  
				  <span class="help-block" id="titleError"></span>
				  <span class="help-block" id="first_nameError"></span>
				  <span class="help-block" id="last_nameError"></span>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group has-feedback">
                <label>Company Name</label>
                <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="{{ old('company_name') }}" autocomplete="off">
                <span class="help-block" id="company_nameError"></span> </div>
            </div>
            <div class="col-6">
              <div class="form-group has-feedback">
                <label>Contact No</label>
                <div class="input-group">
                  <select type="text" class="form-control" name="phone_type">
                    <option selected="selected" value="Main">Main</option>
                    <option value="Work">Work</option>
                    <option value="Mobile">Mobile</option>
                    <option value="Home">Home</option>
                    <option value="Fax">Fax</option>
                    <option value="Other">Other</option>
                  </select>
                  <input type="number" class="form-control col-half last-input" placeholder="Phone Number" name="phone" value="{{ old('phone') }}" autocomplete="off">
				  <span class="help-block" id="phone_typeError"></span>
				  <span class="help-block" id="phoneError"></span>
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group has-feedback">
                <label>Email</label>
                <div class="input-group">
                  <select type="text" class="form-control" name="email_type">
                    <option selected="selected" value="Main">Main</option>
                    <option value="Work">Work</option>
                    <option value="Personal">Personal</option>
                    <option value="Other">Other</option>
                  </select>
                  <input type="email" class="form-control col-half last-input" placeholder="Email Address" name="email" value="{{ old('email') }}" autocomplete="off">
				  <span class="help-block" id="email_typeError"></span>
				  <span class="help-block" id="emailError"></span>
                </div>
              </div>
            </div>
            
            <div class="col-sm-12 col-md-6">
              <div class="form-group">
                <label for="inputEmail3" class="control-label col-form-label">Client Address</label>
                <input id="autocomplete" placeholder="Enter Address" type="text" class="form-control" name="address" value="">
                <span class="help-block" id="addressError"></span> </div>
            </div>
            <div class="col-sm-12 col-md-6"> </div>
            <div class="col-12" id="address">
              <div class="row">
                <div class="col-6">
                  <label class="control-label col-form-label">Street Number</label>
                  <input class="form-control" id="street_number" name="street_number" value="" placeholder="Street Number">
                  <span class="help-block" id="street_numberError"></span> </div>
                <div class="col-6">
                  <label class="control-label col-form-label">Street Route</label>
                  <input class="form-control" id="route" name="street_route" value="" placeholder="Street Route">
                  <span class="help-block" id="street_routeError"></span> </div>
                <div class="col-6">
                  <label class="control-label col-form-label">City</label>
                  <input class="form-control field" id="locality" name="city" value="" placeholder="City">
                  <span class="help-block" id="cityError"></span> </div>
                <div class="col-6">
                  <label class="control-label col-form-label">State</label>
                  <input class="form-control" id="administrative_area_level_1" name="state" value="" placeholder="State">
                  <span class="help-block" id="stateError"></span> </div>
                <div class="col-6">
                  <label class="control-label col-form-label">Postal Code</label>
                  <input class="form-control" id="postal_code" name="postal_code" value="" placeholder="Postal Code">
                  <span class="help-block" id="postal_codeError"></span> </div>
                <div class="col-6">
                  <label class="control-label col-form-label">Country</label>
                  <input class="form-control" id="country" name="country" value="" placeholder="Country">
                  <span class="help-block" id="countryError"></span> </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-success" id="ajaxSubmit">Add</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>

         $(document).ready(function(){
		 
            $('#ajaxSubmit').click(function(e){
			
			var btn = $(this);
			var old_html = btn.html();
			btn.html('Please wait...');
            btn.attr('disabled', true);
			
			//alert('click');
			$('#form span.help-block').text(' ');
			
			var myObject = new Object();
			var other_data = $('#form').serializeArray();
			$.each(other_data,function(key,input){
				myObject[input.name] = input.value;
			});
			
			
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
			  var client_id = $('input[name="client_id"]').val();

			  if(client_id!='')
			  {
			  var url = "{{ url('/')}}/admin/client/"+client_id;
			  var method = 'PATCH';
			  }
			  else
			  {
			  var url = "{{route('admin.client.store')}}";
			  var method = 'post';
			  }
			  //alert(url+" "+method);
               jQuery.ajax({
                  url: url,
                  method: method,   				  
				  data: myObject,
                  success: function(result){
                  	if(result.errors)
                  	{
                  		jQuery.each(result.errors, function(key, value){
							jQuery('#'+key+'Error').text(value);
                  		});
                  	}
                  	else
                  	{
						toastr.success(result.message);
						
						window.setTimeout(function() {
							$('#open').hide();
                  			$('#myModal').modal('hide');
							window.location.href = "{{ url('admin/client') }}";
						}, 2000);
						
                  		
                  	}
					btn.html(old_html);
                    btn.attr('disabled', false);
                  },
				  error: function(err){
				  alert(JSON.stringify(err));
				  }  
				  });
               });
			   
			   
			   /*Load Model Popup*/
			   
			   $('body').on('click', '.addRecord', function (event) {
					$('#form').trigger('reset');
					$('.modal-title').text("Add Client");
					$('#ajaxSubmit').text("Add");
					$('#myModal').modal('show');
				});
			   
			   
			   
			   $('body').on('click', '.editRecord', function (event) {

					event.preventDefault();
					var id = $(this).data('id');
					$.get('client/'+id+'/edit', function (data) {
						var success = data.success;
						if(success==1)
						{
						$('input[name="client_id"]').val(data.client.client_id);
						$('select[name="title"]').val(data.client.title);
						$('input[name="first_name"]').val(data.client.first_name);
						$('input[name="last_name"]').val(data.client.last_name);
						
						
						$('input[name="company_name"]').val(data.client.company_name);
						$('select[name="phone_type"]').val(data.client.phone_type);
						$('input[name="phone"]').val(data.client.phone);
						$('select[name="email_type"]').val(data.client.email_type);
						$('input[name="email"]').val(data.client.email);
						$('input[name="address"]').val(data.client.address);
						$('input[name="street_number"]').val(data.client.street_number);
						$('input[name="street_route"]').val(data.client.street_route);
						$('input[name="city"]').val(data.client.city);
						$('input[name="state"]').val(data.client.state);
						$('input[name="postal_code"]').val(data.client.postal_code);
						$('input[name="country"]').val(data.client.country);		
						
						$('.modal-title').text("Edit Client");
						$('#ajaxSubmit').text("Update");
						$('#myModal').modal('show');
						}
					 });
				});
			   
			   /*Load Model Popup*/
			   
			   
            });
      </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWjv_B5Ug9dxwMc9ig9dr1AjReKMvjZxE&libraries=places&callback=initAutocomplete" async defer></script>
<script type="text/javascript">//<![CDATA[


var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      /*function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }*/


  //]]></script>
@endpush 