let base_url = $('#base_url').val();
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



    $('#btn_add_guest').click(function(){

        $('#invite_form').removeClass('d-none');
        $(this).addClass('d-none');
        $('#btn_back_to_guest').removeClass('d-none')
        $('#guest_table').addClass('d-none')
    })

    $('#btn_submit_guest').click(function(){

        if($('#full_name').val() == ''){
            alert('Full Name field is required');
            return;
        }
        if($('#email_address').val() == ''){
            alert('Email Address field is required');
            return;
        }


        $(this).html('Submitting...');
        $(this).attr('disabled', true);


        let formData = {
            'name' : $('#full_name').val(),
            'email' : $('#email_address').val(),
            'phone' : $('#phone_no').val(),
        }

        $.ajax({
            type: 'POST',
            url: base_url+'/guest/store',
            data: formData,
            dataType: 'json',
            success: function(data){
                console.log(data);
                $('#success_response').html('Guest Added Successfully')
                $('#full_name').val('')
                $('#email_address').val('')
                $('#phone_no').val('')
                $('#no_of_guests').val('')

                $('#btn_submit_guest').html('Submit');
                $('#btn_submit_guest').attr('disabled', false)
            },
            error: function(err){
                console.log(err.responseJSON);
                $('#error_response').text(err.responseJSON.errors)
                $('#btn_submit_guest').html('Submit');
                $('#btn_submit_guest').attr('disabled', false)
            }
        })

    })

    $('#btn_back_to_guest').click(function(){
        location.reload()
    })
})

function deleteGuest(id){
    swal({
        title: "Are you sure?",
        text: "Once you delete, the Invite will be inactive",
        icon: 'warning',
        buttons: {
            cancel: {
                visible: true,
                className: "btn btn-danger",
                text: 'No, Cancel',
                closeModal: true
            },
            confirm: {
                visible: true,
                className: "btn btn-success",
                text: 'Yes, Delete!',
                closeModal: false
            }
        }
    }).then((willDelete)=>{
        if(willDelete){

            $.ajax({
                url: base_url+'/guest/delete/'+id,
                type: "GET",
                success: function(data){
                    swal({
                        text: 'Invite Deleted Successfully!',
                        icon: 'success',
                        timer: '1500'
                    })
                    setInterval('location.reload()', 1800);
                },
                error: function(error){
                    console.log(error);
                    swal({
                        title: 'Opps..........',
                        text: 'Something went wrong!',
                        icon: 'error',
                        timer: '1500'
                    })
                }
            })
        } 
    });
}
