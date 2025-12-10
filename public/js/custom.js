{
    $("#date_range").daterangepicker({
        autoUpdateInput: false,
        maxDate: moment(),
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
    const studentModules = document.getElementById("studentmodules");
    if (studentModules) {
        const activeItem = studentModules.querySelector(".nav > li.active");
        if (activeItem) {
            studentModules.classList.add("show");
        }
    }
}

{
    const feemodules = document.getElementById("feemodules");
    if (feemodules) {
        const activeItem = feemodules.querySelector(".nav > li.active");
        if (activeItem) {
            feemodules.classList.add("show");
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

