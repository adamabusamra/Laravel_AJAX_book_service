//defining variables
const nameInput = $("#name");
const numberInput = $("#number");
const emailInput = $("#email");
$services = [];
let serviceId = [];
let interestLevelId = null;
let userData = {};

$(document).ready(() => {
    //getting old userData from session if there is
    if (JSON.parse(sessionStorage.getItem("userData"))) {
        userData = JSON.parse(sessionStorage.getItem("userData"));
        nameInput.val(userData.name);
        numberInput.val(userData.number);
        emailInput.val(userData.email);
        //getting old sevice from session if there is
        userData.serviceId
            ? (serviceId = userData.serviceId)
            : (serviceId = []);

        //getting old interest from session if there is
        interestLevelId = userData.interestLevelId;
        //if there is an old service id im giving it a dark background
        serviceId.length
            ? serviceId.forEach((item) => {
                  $(`.service-item p[key='${item}']`).addClass(
                      "bg-dark text-light"
                  );
              })
            : null;
        //if there is an old interest im giving it a dark background
        interestLevelId
            ? $(`.interest-item p[key='${interestLevelId}']`).addClass(
                  "bg-dark text-light"
              )
            : null;
    }
});

//Form submit handler
$("#user-data-form").on("submit", (e) => {
    //Preventing form submit to reload page
    e.preventDefault();
    //Basic validation
    let errors = {};
    if (!nameInput.val()) {
        nameInput.addClass("is-invalid");
        errors.name = true;
    } else {
        nameInput.removeClass("is-invalid");
        delete errors.name;
    }
    if (!numberInput.val()) {
        numberInput.addClass("is-invalid");
        errors.number = true;
    } else {
        numberInput.removeClass("is-invalid");
        delete errors.number;
    }
    if (!emailInput.val()) {
        emailInput.addClass("is-invalid");
        errors.email = true;
    } else {
        emailInput.removeClass("is-invalid");
        delete errors.email;
    }
    if (jQuery.isEmptyObject(errors)) {
        //removing alert incase it was triggered
        $("#form-alert").addClass("d-none");
        //inserting form inputs into userData variable
        userData.name = nameInput.val();
        userData.number = numberInput.val();
        userData.email = emailInput.val();
        //setting new userData to session storage
        sessionStorage.setItem("userData", JSON.stringify(userData));
        $("#services-modal").modal("show");
    } else {
        $("#form-alert").removeClass("d-none");
    }
    //I had to use throw as somthing to exit the code ecase for some very wierd reason if you open the services modal then you close it and open it again the function will start calling twice (adding to array then deleting on the second time) so the ui wont update then when you close it and open it again it goes back to working then one time it works and the second dosent ...
    //Styling selected service
    // $(document).on("click", ".service-item", (e) => {
    //     let clickedItem = e.target.getAttribute("key");
    //     if (!serviceId.includes(clickedItem)) {
    //         serviceId.push(clickedItem);
    //         $(`.service-item p[key='${clickedItem}']`).addClass(
    //             "bg-dark text-light"
    //         );
    //         $("#service-alert").addClass("d-none");
    //
    //         // throw "";
    //     } else {
    //         serviceId.splice(serviceId.indexOf(clickedItem), 1);
    //         $(`.service-item p[key='${clickedItem}']`).removeClass(
    //             "bg-dark text-light"
    //         );
    //         // throw "";
    //     }
    //     //you can remove the throw methods and use this consolelog to see how many times the func is envoked
    //     console.log("service item func invoked");
    //     // $(".service-item > p").removeClass("bg-dark text-light");
    // });
    // this was the solution for jquery firing multiple events **just add unbind to the event (it removed any previos events)
    // $(document)
    //     .unbind()
    //     .on("click", ".service-item", (e) => {
    //         let clickedItem = e.target.getAttribute("key");
    //         let isincluded = false;
    //         serviceId.forEach((item) => {
    //             if (item == clickedItem) {
    //                 isincluded = true;
    //             }
    //         });
    //         if (isincluded) {
    //             serviceId.splice(serviceId.indexOf(clickedItem), 1);
    //             $(`.service-item p[key='${clickedItem}']`).removeClass(
    //                 "bg-dark text-light"
    //             );
    //         } else {
    //             serviceId.push(clickedItem);
    //             $(`.service-item p[key='${clickedItem}']`).addClass(
    //                 "bg-dark text-light"
    //             );
    //             $("#service-alert").addClass("d-none");
    //         }
    //         //you can remove the throw methods and use this consolelog to see how many times the func is envoked
    //         console.log("service item func invoked");
    //         // $(".service-item > p").removeClass("bg-dark text-light");
    //     });
    $(document)
        .unbind()
        .on("click", ".service-item", (e) => {
            let clickedItem = e.target.getAttribute("key");
            if (!serviceId.includes(clickedItem)) {
                serviceId.push(clickedItem);
                $(`.service-item p[key='${clickedItem}']`).addClass(
                    "bg-dark text-light"
                );
                $("#service-alert").addClass("d-none");
            } else {
                serviceId.splice(serviceId.indexOf(clickedItem), 1);
                $(`.service-item p[key='${clickedItem}']`).removeClass(
                    "bg-dark text-light"
                );
            }
            //you can remove the throw methods and use this consolelog to see how many times the func is envoked
            console.log("service item func invoked");
            // $(".service-item > p").removeClass("bg-dark text-light");
        });
    //Service modal submit handler
    $("#service-modal-submit").on("click", () => {
        if (serviceId.length) {
            //hidding error just incase
            $("#service-alert").addClass("d-none");
            //inserting serviceId into userData variable
            serviceId = serviceId.filter((item) => {
                return item != null;
            });
            userData = {
                ...userData,
                serviceId,
            };
            //setting new userData to session storage
            sessionStorage.setItem("userData", JSON.stringify(userData));
            //hidding service modal
            $("#services-modal").modal("hide");
            //Show interest modal
            $("#interest-level-modal").modal("show");
        } else {
            $("#service-alert").removeClass("d-none");
        }
    });
    //Styling selected interset-level
    $(document).on("click", ".interest-item > p", (e) => {
        interestLevelId = e.target.getAttribute("key");
        $("#interest-alert").addClass("d-none");
        $(".interest-item > p").removeClass("bg-dark text-light");
        $(`.interest-item p[key='${interestLevelId}']`).addClass(
            "bg-dark text-light"
        );
        console.log("service item func invoked");
    });
    //interest modal submit handler
    $("#interest-modal-submit").on("click", () => {
        console.log("went over the code again");
        if (interestLevelId) {
            //hidding error just incase
            $("#interest-alert").addClass("d-none");
            //inserting interestLevelId into userData variable
            userData = {
                ...userData,
                interestLevelId,
            };
            //setting new userData to session storage
            sessionStorage.setItem("userData", JSON.stringify(userData));
            //hidding interest modal
            $("#interest-level-modal").modal("hide");
            //Taking all the data from session and posting it to the user controller
            addUser();
            //Clearing form, selected-items in modal, sessionStorage and all variables
            $("form")[0].reset();
            $(".modal-body p").removeClass("bg-dark text-light");
            sessionStorage.removeItem("userData");
            userData = {};
            serviceId = [];
            interestLevelId = null;
            //Show success alert
            Swal.fire(
                "Order Submitted",
                "Check your email for complete report",
                "success"
            );
        } else {
            console.log("interest else");
            $("#interest-alert").removeClass("d-none");
        }
    });
});
