$(document).on("click", "#delete", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    swal({
        title: "Are you Want to delete?",
        text: "Once Delete, This will be Permanently Delete!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = link;
            } else {
                swal("Safe Data!");
            }
        });
});


$(document).on("click", "#block", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    swal({
        title: "Are you Want to Block ?",
        text: "If Block !!, It was not asset !",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = link;
            } else {
                swal("Safe Data!");
            }
        });
});

$(document).on("click", "#unblock", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    swal({
        title: "Are you Want to UnBlock ?",
        text: "If UnBlock !!, It was asset !",
        icon: "success",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = link;
            } else {
                swal("Safe Data!");
            }
        });
});

$(document).on("click", "#give", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    swal({
        title: "Are you Want to Give This Access ???",
        text: "If  Give !,This User Can Get This Access !",
        icon: "success",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = link;
            } else {
                swal("Safe Data!");
            }
        });
});

$(document).on("click", "#remove", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    swal({
        title: "Are you Want to Remove This Access ???",
        text: "If Removed !!, This User Can't Get This Access  !",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = link;
            } else {
                swal("Safe Data!");
            }
        });
});

$(document).on("click", "#publish", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    swal({
        title: "Are you Want to Publish ???",
        text: "If Published !,This User Can See This !",
        icon: "success",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = link;
            } else {
                swal("Safe Data!");
            }
        });
});

$(document).on("click", "#draft", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    swal({
        title: "Are you Want to Draft This ???",
        text: "If Draft !!, This User Can't See This !",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = link;
            } else {
                swal("Safe Data!");
            }
        });
});


$(document).on("click", "#regular", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    swal({
        title: "Are you want to make Regular Car ???",
        text: "This Car can not see in Temporaty Section ",
        icon: "success",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = link;
            } else {
                swal("Safe Data!");
            }
        });
});

$(document).on("click", "#temporaty", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    swal({
        title: "Are you want to make Temporaty Car ???",
        text: "This Car can not see in Regular Section ",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = link;
            } else {
                swal("Safe Data!");
            }
        });
});


$(document).on("click", "#clearDeadline", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    swal({
        title: "Are you want to remove deadline ???",
        text: "This Car can book any date !!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = link;
            } else {
                swal("Safe Data!");
            }
        });
});

$(document).on("click", "#clearData", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    swal({
        title: "Are you want to remove data ???",
        text: "If removed !! It can't executable.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                window.location.href = link;
            } else {
                swal("Safe Data!");
            }
        });
});

