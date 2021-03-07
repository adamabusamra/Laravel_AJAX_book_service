//Getting services from ServicesController
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        type: "GET",
        url: "get-services/",
        success: function (data) {
            data.forEach((item) => {
                $("#services-list").append(
                    `<div class="service-item col-md-4 my-1">
                        <p class="border border-primary p-4 text-center cursor-pointer" key="${item.id}">${item.service}
                        </p>
                    </div>`
                );
            });
        },
        error: function (err) {
            console.log(err);
        },
    });

    $.ajax({
        type: "GET",
        url: "get-interests/",
        success: function (data) {
            data.forEach((item) => {
                $("#interests-list").append(`
                      <div class="interest-item col-md-4 my-1">
                      <p class="border border-primary p-4 text-center cursor-pointer" key="${item.id}">
                        ${item.interest_type}
                      </p>
                  </div> `);
            });
        },
        error: function (err) {
            console.log(err);
        },
    });
    addUser = () => {
        $.ajax({
            type: "post",
            url: "add-user/",
            data: JSON.parse(sessionStorage.getItem("userData")),
            success: function (response) {
                console.table(response);
                console.log(response);
            },
            error: function (err) {
                console.log(err);
                Swal.fire(
                    "Somthing went wrong",
                    "check console for more info",
                    "error"
                );
            },
        });
    };
});
