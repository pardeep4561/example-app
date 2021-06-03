let csrf = $("meta[name='csrf']").attr("content");
$(function () {
    let mobileCode = "";
   $("#register-step").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        autoFocus: true,
        enablePagination: false,
    });

    $('.error').empty();

    $('.next-step').on("click", () => $("#wizard").steps('next'));
    $('.previous-step').on("click", () => $("#wizard").steps('previous'));



    $("select[name='mobile_code']").on("change", function () {
        mobileCode = this.value
    });

    //sent opt ajax
    $(this).on("click", "#sent-otp", function () {
        $('.error').empty();
        let number = $("input[name='number']").val();
        $.ajax({
            url: route('api-sentotp'),
            method: 'get',
            headers: { 'X-CSRF-Token': csrf },
            data: {
                number: number,
                mobile_code: mobileCode
            },
            success: function (resp) {
                //for showing error
                if (resp.error) {
                    const keys = Object.keys(resp.errors);
                    keys.forEach((elm) => {
                        if (typeof resp.errors[elm] != "undefined") {
                            $(`#${elm}`).parent().find(".error").text(resp.errors[elm]);
                        }
                    });
                }
                //for render html
                if (typeof resp == "string") {
                    console.log($('#register-step-p-1'));
                    $('#register-step-p-1').html(resp);
                    $("#register-step").steps('next');
                }
            }
        });
    });

    //verify opt section
    $(this).on("click", "#verify-otp-btn", function () {

        $.ajax({
            url: route('api-verify-otp'),
            method: 'post',
            headers: { 'X-CSRF-Token': csrf },
            data: {
                otp: $('#otp').val(),
            },
            success: function (resp) {
                console.log(resp);
                // //for showing error
                // if (resp.error) {
                //     const keys = Object.keys(resp.errors);
                //     keys.forEach((elm) => {
                //         if (typeof resp.errors[elm] != "undefined") {
                //             $(`#${elm}`).parent().find(".error").text(resp.errors[elm]);
                //         }
                //     });
                // }
                // //for render html
                // if(typeof resp == "string"){
                //     $('#verify-otp-section').html(resp);
                //     $("#wizard").steps('next');
                // }
            }
        });
    });


    ///dropzone

    //Dropzone class
    //Disabling autoDiscover
    // Dropzone.autoDiscover = false;
    // var myDropzone = new Dropzone(".dropzone", {
    //     url: route('test'),
    //     paramName: "file",
    //     parallelUploads: 3,
    //     uploadMultiple: true,
    //     acceptedFiles: '.png,.jpeg,.jpg',
    //     autoProcessQueue: false,
    //     success: function (file, response) {
    //         if (response == "true") {
    //             $("#message").append("<div class='alert alert-success'>Files Uploaded successfully</div>");
    //         } else {
    //             $("#message").append("<div class='alert alert-danger'>Files can not uploaded</div>");
    //         }
    //     }
    // });

    // myDropzone.on("sending", function (file, xhr, formData) {
    //     // Will send the filesize along with the file as POST data.
    //     formData.append("_token", csrf);
    // });

    Dropzone.options.imageUpload = {
        maxFilesize         :       1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif"
    };

});
