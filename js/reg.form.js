
$('#regpostcode').keyup(function()
{
  var postcode = $('#regpostcode').val();
  boxShadding('regpostcode');
  if(postcode != '')
  {
    $.post('check-username.php', {postcode: postcode},
      function(data)
      {
        if(data == 'Invalid Post Code Format.'){
          $('#ispostcode').html(data).css('color','red');
        }else{
          $('#ispostcode').html('').css('color','green');
        }

      });
  }else{
    $('#ispostcode').html('');
  }
});

$('#searchpostcode').keyup(function()
{
  var postcode = $('#searchpostcode').val();
  boxShadding('searchpostcode');
  if(postcode != '')
  {
    $.post('check-username.php', {postcode: postcode},
      function(data)
      {
        if(data == 'Invalid Post Code Format.'){
          $('#searchpostcodeisvalid').html(data).css('color','red');
        }else{
          $('#searchpostcodeisvalid').html('').css('color','green');
        }

      });
  }else{
    $('#searchpostcodeisvalid').html('');
  }
});
/*Check Post Code Format End Here...*/

