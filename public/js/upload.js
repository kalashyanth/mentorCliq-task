$(document).ready(function () {

    $('#updateReq').click(function () {
        var resource = $(this).data("resource");

        const division = $('#divison').val();
        const age = $('#age').val();
        const timezone = $('#timezone').val();
        const data = {
            'division': division,
            'age': age,
            'timezone': timezone,
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/" + resource,
            type: "post",
            data: data,
            success: function (res) {
                if(res) {
                    $('#success').text('Success')
                }
                $('#success').fadeIn('fast');
                setTimeout(function () {
                    $('#success').fadeOut('fast');

                }, 3000)
            },
            error: function (error) {
                if (error.responseJSON.errors.sum) {
                    $('#errors').text(error.responseJSON.errors.sum[0])
                } else {
                    $('#errors').text(error.responseJSON.message)
                }
                $('#errors').fadeIn('fast');
                setTimeout(function () {
                    $('#errors').fadeOut('fast');

                }, 3000)
            }
        });
        console.log(division)
        console.log(age)
        console.log(timezone)
    });
    // $('#updateReq').click()
});