{
    $("#date_range").daterangepicker({
        autoUpdateInput: false,
        maxDate: moment().add(6, 'days'),
        locale: {
            cancelLabel: "Clear",
        },
        showDropdowns: true,
    });

    $("#date_range").on("apply.daterangepicker", function (ev, picker) {
        $(this).val(
            picker.startDate.format("YYYY-MM-DD") +
            " to " +
            picker.endDate.format("YYYY-MM-DD")
        );
    });

    $("#date_range").on("cancel.daterangepicker", function (ev, picker) {
        $(this).val("");
    });
}

{
    document
        .querySelectorAll("input, select, textarea")
        .forEach(function (element) {
            element.addEventListener("input", function () {
                let errorSpan = this.nextElementSibling;
                if (errorSpan && errorSpan.classList.contains("text-danger")) {
                    errorSpan.style.display = "none";
                }
            });

            element.addEventListener("change", function () {
                let errorSpan = this.nextElementSibling;
                if (errorSpan && errorSpan.classList.contains("text-danger")) {
                    errorSpan.style.display = "none";
                }
            });
        });
}
{
    new DataTable(".alltable", {
        //  autoWidth: false,
        //   scrollX: true,
        layout: {
            topStart: {
                buttons: [
                    {
                        extend: "copy",
                        exportOptions: { columns: ':not(.not-export)' }
                    },
                    {
                        extend: "excel",
                        exportOptions: { columns: ':not(.not-export)' }
                    },
                    {
                        extend: "pdf",
                        exportOptions: { columns: ':not(.not-export)' }
                    },

                    {
                        extend: "colvis",
                        text: "Columns"
                    },
                ],
            },
        },
        perPage: 25,
        ordering: false,
    });

    $.extend(true, $.fn.dataTable.Buttons.defaults, {
        exportOptions: {
            columns: ':not(.not-export)' // exclude Action column everywhere
        }
    });
}

{
    new DataTable(".domaincodetable", {
        layout: {
            topStart: {
                buttons: [
                    // {
                    //     extend: "copy",
                    //     exportOptions: { columns: ':not(.not-export)' }
                    // }
                ],
            },
        },
        pageLength: 50,
        ordering: false,
    });

    $.extend(true, $.fn.dataTable.Buttons.defaults, {
        exportOptions: {
            columns: ':not(.not-export)' // exclude Action column everywhere
        }
    });
}

{
    setTimeout(function () {
        $(".alert").fadeOut("slow");
    }, 3000);
}

{
    const adminModules = document.getElementById("adminmodules");
    if (adminModules) {
        const activeItem = adminModules.querySelector(".nav > li.active");
        if (activeItem) {
            adminModules.classList.add("show");
        }
    }
}

{
    const memberModules = document.getElementById("membermodules");
    // console.log(memberModules);
    if (memberModules) {
        const activeItem = memberModules.querySelector(".nav > li.active");
        if (activeItem) {
            memberModules.classList.add("show");
        }
    }
}

{
    const gateAdminModules = document.getElementById("gateadminmodule");
    // console.log(gateAdminModules);
    if (gateAdminModules) {
        const activeItem = gateAdminModules.querySelector(".nav > li.active");
        if (activeItem) {
            gateAdminModules.classList.add("show");
        }
    }
}


{
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            html: true,
            sanitize: false
        });

    });
}

