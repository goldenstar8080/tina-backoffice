<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BackOffice - My Convenience Stores</title>
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<link rel="shortcut icon" href="{{ asset('favicon.png') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<style type="text/css">
.desabled {
	pointer-events: none;
}
</style>

</head>
<body>

@include('partials.navbar')
<div class="container">
    <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage Convenience Store</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a data-target="#add-modal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>New Store</span></a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead style="color: #566787;">
                    <tr>
                        <th>Store Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Address</th>
                        <th>Logo</th>
                        <th >Actions</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                            
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Add Modal -->
<div id="add-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addStore" class="" method="POST" action="">
                <div class="modal-header">                      
                    <h4 class="modal-title">Add Stores</h4>
                    <button type="button" class="close add-data-from-delete-form" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title" class="col-md-12 col-form-label">Store Name</label>
                        <input id="title" type="text" class="form-control" name="title" value="" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="phone_number" class="col-md-12 col-form-label">Phone Number</label>
                        <input id="phone_number" type="text" class="form-control" name="phone_number" value="" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="email_addr" class="col-md-12 col-form-label">Email</label>
                        <input id="email_addr" type="text" class="form-control" name="email_addr" value="" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="addr" class="col-md-12 col-form-label">Address</label>
                        <input id="addr" type="text" class="form-control" name="addr" value="" required autofocus>
                        <i class="material-icons room-icon" onClick="codeAddress();">room</i> * Please click me to get geolocation.
                    </div>
                    <div class="form-group">
                        <label for="latitude" class="col-md-12 col-form-label">Latitude</label>
                        <input id="latitude" type="text" class="form-control" name="latitude" value="" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="longitude" class="col-md-12 col-form-label">Longitude</label>
                        <input id="longitude" type="text" class="form-control" name="longitude" value="" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="img" class="col-md-12 col-form-label">Image (e.g: http://anr.gwl.mybluehost.me/depanneur_fibrotech.png)</label>
                        <input id="img" type="text" class="form-control" name="img" value="" required autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default add-data-from-delete-form" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success desabled" id="submitStore">Add</button>
                    <!-- <input type="button" class="btn btn-default add-data-from-delete-form" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-success desabled" id="submitStore" value="Add"> -->
                </div>
            </form>            
        </div>
    </div>
</div>
<!-- Delete Model -->
<form action="" method="POST" class="remove-record-model">
    <div id="remove-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Store</h4>
                    <button type="button" class="close remove-data-from-delete-form" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this Record?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default remove-data-from-delete-form" data-dismiss="modal">Cancel</button> 
                    <button type="button" class="btn btn-danger deleteMatchRecord">Delete</button>
                    <!-- <input type="button" class="btn btn-default remove-data-from-delete-form" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger deleteMatchRecord" value="Delete"> -->
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Update Model -->
<form action="" method="POST" class="stores-update-record-model form-horizontal">
    <div id="update-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" style="width:55%;">
            <div class="modal-content" style="overflow: hidden;">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Store</h4>                    
                    <button type="button" class="close update-data-from-delete-form" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" id="updateBody">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default update-data-from-delete-form" data-dismiss="modal">Cancel</button> 
                    <!-- <input type="button" class="btn btn-default update-data-from-delete-form" data-dismiss="modal" value="Cancel"> -->
                    <button type="button" class="btn btn-info updateUserRecord">Update</button>
                    <!-- <input type="submit" class="btn btn-info updateUserRecord" value="Update"> -->
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>


<script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBx0QJx7WaFNYgjG84uBAr9HAl9Js3vD0&libraries=places&sensor=true"></script>
<script>

// Initialize Firebase
var config = {
    apiKey: "AIzaSyDoAjhMLWRtJT62MhtNPxcGugVdLFKjMFU",
    authDomain: "tina-project-a9ad6.firebaseapp.com",
    databaseURL: "https://tina-project-a9ad6.firebaseio.com",
    projectId: "tina-project-a9ad6",
    storageBucket: "tina-project-a9ad6.appspot.com",
    messagingSenderId: "431985002265",
    appId: "1:431985002265:web:256faf035b4d6ae8b16788",
    measurementId: "G-Q0E2KQMXPK"
};
firebase.initializeApp(config);

var database = firebase.database();

$(document).ready(function () {
   google.maps.event.addDomListener(window, 'load', initialize);
});
function initialize() {
    var input = document.getElementById('addr');
    var autocomplete = new google.maps.places.Autocomplete(input);
}
function codeAddress() {
    geocoder = new google.maps.Geocoder();
    var address = document.getElementById("addr").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        $('#latitude').val(results[0].geometry.location.lat());
        $('#longitude').val(results[0].geometry.location.lng());
      } 
      else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
}

var lastIndex = 0;
// Get Data
firebase.database().ref('stores/').on('value', function(snapshot) {
    var value = snapshot.val();
    var htmls = [];
    if (value != null){
        $.each(value, function(index, value){
            if(value) {
                htmls.push('<tr>\
                    <td>'+ value.title +'</td>\
                    <td>'+ value.phone +'</td>\
                    <td>'+ value.email +'</td>\
                    <td>'+ value.latitude +'</td>\
                    <td>'+ value.longitude +'</td>\
                    <td>'+ value.address +'</td>\
                    <td>'+ value.image +'</td>\
                    <td><a data-toggle="modal" data-target="#update-modal" class="edit updateData" data-id="'+index+'"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>\
                    <a data-toggle="modal" data-target="#remove-modal" class="delete removeData" data-id="'+index+'"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a></td>\
                </tr>');
            }       
            lastIndex = index;
        });
    }
    $('#tbody').html(htmls);
    $("#submitStore").removeClass('desabled');
});


// Add Data
$('#submitStore').on('click', function(){
    var values = $("#addStore").serializeArray();
    var store_name = values[0].value;
    var phone_number = values[1].value;
    var email_addr = values[2].value;
    var addr = values[3].value;
    var latitude = values[4].value;
    var longitude = values[5].value;    
    var img = values[6].value;
    var store_id = firebase.database().ref('stores/').push().key;
    firebase.database().ref('stores/' + store_id + '/').update({
        title: store_name,
        phone: phone_number,
        email: email_addr,
        latitude: latitude,
        longitude: longitude,
        address: addr,
        image: img
    });
    // Reassign lastID value
    // lastIndex = userID;
    $("#addStore input").val("");
    $("#add-modal").modal('hide');
});

// Update Data
var updateID = 0;
$('body').on('click', '.updateData', function() {
    updateID = $(this).attr('data-id');
    firebase.database().ref('stores/' + updateID).on('value', function(snapshot) {
        var values = snapshot.val();
        var updateData = '<div class="form-group">\
                <label for="store_name" class="col-md-12 col-form-label">Store Name</label>\
                <input id="store_name" type="text" class="form-control" name="store_name" value="'+values.title+'" required autofocus>\
            </div>\
            <div class="form-group">\
                <label for="phone_number" class="col-md-12 col-form-label">Phone Number</label>\
                <input id="phone_number" type="text" class="form-control" name="phone_number" value="'+values.phone+'" required autofocus>\
            </div>\
            <div class="form-group">\
                <label for="email_addr" class="col-md-12 col-form-label">Email</label>\
                <input id="email_addr" type="text" class="form-control" name="email_addr" value="'+values.email+'" required autofocus>\
            </div>\
            <div class="form-group">\
                <label for="addr" class="col-md-12 col-form-label">Address</label>\
                <input id="addr" type="text" class="form-control" name="addr" value="'+values.address+'" required autofocus>\
                <i class="material-icons room-icon" onClick="codeAddress();">room</i> * Please click me to get geolocation.\
            </div>\
            <div class="form-group">\
                <label for="latitude" class="col-md-12 col-form-label">Latitude</label>\
                <input id="latitude" type="text" class="form-control" name="latitude" value="'+values.latitude+'" required readonly>\
            </div>\
            <div class="form-group">\
                <label for="longitude" class="col-md-12 col-form-label">Longitude</label>\
                <input id="longitude" type="text" class="form-control" name="longitude" value="'+values.longitude+'" required readonly>\
            </div>\
            <div class="form-group">\
                <label for="img" class="col-md-12 col-form-label">Image</label>\
                <input id="img" type="text" class="form-control" name="img" value="'+values.image+'" required autofocus>\
            </div>';

            $('#updateBody').html(updateData);
    });
});

$('.updateUserRecord').on('click', function() {
    var values = $(".stores-update-record-model").serializeArray();
    var postData = {
        title : values[0].value,
        phone : values[1].value,
        email : values[2].value,
        address : values[3].value,
        latitude : values[4].value,
        longitude : values[5].value,        
        image : values[6].value,
    };

    var updates = {};
    updates['/stores/' + updateID] = postData;

    firebase.database().ref().update(updates);

    $("#update-modal").modal('hide');
});


// Remove Data
$("body").on('click', '.removeData', function() {
    var id = $(this).attr('data-id');
    $('body').find('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
});

$('.deleteMatchRecord').on('click', function(){
    var values = $(".remove-record-model").serializeArray();
    var id = values[0].value;
    firebase.database().ref('stores/' + id).remove();
    $('body').find('.remove-record-model').find( "input" ).remove();
    $("#remove-modal").modal('hide');
});

</script>