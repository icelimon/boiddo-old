
function divhide(id){
    var alldivchild = ["name","email","address","city","phone","specialist","degree","hospital","hospitaladdress","hoscity","hosmap","hoscapacity","hosservice","hospitalcontacts"];
    var alldiv = ["nameedit","emailedit","addressedit","cityedit","phoneedit","specialistedit","degreeedit","hospitaledit","hosaddressedit","hoscityedit","hosmapedit","hoscapacityedit","hosserviceedit","hoscontactsedit"];
    var i=0;
    while(i<alldiv.length){
        if(id==alldiv[i]){
            $("#"+alldiv[i]).hide();
            $("#"+alldivchild[i]).show();
        }else{
            $("#"+alldiv[i]).show();
            $("#"+alldivchild[i]).hide();
        }
        i++;
    }
}

function invdivhide(id){
    var alldivchild = ["name","email","address","city","phone","specialist","degree","hospital","hospitaladdress","hoscity","hosmap","hoscapacity","hosservice","hospitalcontacts"];
    var alldiv = ["nameedit","emailedit","addressedit","cityedit","phoneedit","specialistedit","degreeedit","hospitaledit","hosaddressedit","hoscityedit","hosmapedit","hoscapacityedit","hosserviceedit","hoscontactsedit"];
    var i=0;
    while(i<alldivchild.length){
        if(id==alldivchild[i]){
            $("#"+alldivchild[i]).hide();
            $("#"+alldiv[i]).show();
        }
        i++;
    }
}

/*Personal Details Start Here*/
var count = 0;
var newp = '';
var p = $('#newservice');

$(document).ready(function() {

$('#nameedit').click(function(){
    divhide('nameedit');
});



$('#specialistedit').click(function(){
    divhide('specialistedit');
});


$('#degreeedit').click(function(){
    divhide('degreeedit');
});



$('#emailedit').click(function(){
    divhide("emailedit");
});


$('#addressedit').click(function(){
    divhide('addressedit');
});


$('#cityedit').click(function(){
    divhide('cityedit');
});


$('#phoneedit').click(function(){
    divhide('phoneedit');
});

/*Personal Details End Here*/

/*Professional Details Start Here*/

$('#hospitaledit').click(function(){
    divhide('hospitaledit');
});


$('#hosaddressedit').click(function(){
    divhide('hosaddressedit');
});


$('#hosserviceedit').click(function(){
    divhide('hosserviceedit');
});
$('#hosserviceBtnSave,#hosserviceBtnCancel').click(function(){
    invdivhide('hosservice');
    count=0;
    newp = '';
    p.html(newp);
});

$('#hoscityedit').click(function(){
    divhide('hoscityedit');
});


$('#hoscapacityedit').click(function(){
    divhide('hoscapacityedit');
});

$('#hosmapedit').click(function(){
    divhide('hosmapedit');
});

$('#hoscontactsedit').click(function(){
    divhide('hoscontactsedit');
});


/*Professional Details End Here*/

});

