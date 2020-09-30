$(document).on("click", "#delete", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
        title: "Are you Want to delete?",
        text: "Once Delete, This will be Permanently Delete!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            window.location.href = link;
        } else {
            console.log("Safe Data!");
        }
    });
});

$(document).on("click", "#cancel", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
        title: "Are you Want to cancel?",
        text: "Once Cancel, This will be Permanently Canceled!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Cancel it!'
    }).then((result) => {
        if (result.value) {
            window.location.href = link;
        } else {
            console.log("Safe Data!");
        }
    });
});


$(document).on("click", "#temporaty", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
        title: "Are you want to make Temporaty Car ???",
        text: "This Car can not see in Regular Section ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, temporaty!'
    }).then((result) => {
        if (result.value) {
            window.location.href = link;
        } else {
            console.log("Safe Data!");
        }
    });
});



$(document).on("click", "#clearDeadline", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
        title: "Are you want to remove deadline ???",
        text: "This Car can book any date !!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, clear!'
    }).then((result) => {
        if (result.value) {
            window.location.href = link;
        } else {
            console.log("Safe Data!");
        }
    });
});


$(document).on("click", "#clearData", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
        title: "Are you want to remove data ???",
        text: "If removed !! It can't executable.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, clear!'
    }).then((result) => {
        if (result.value) {
            window.location.href = link;
        } else {
            console.log("Safe Data!");
        }
    });
});

$(document).on("click", "#regular", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
        title: "Are you want to make Regular Car ???",
        text: "This Car can not see in Temporaty Section ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, regular!'
    }).then((result) => {
        if (result.value) {
            window.location.href = link;
        } else {
            console.log("Safe Data!");
        }
    });
});

$(document).on("click", "#block", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
        title: "Are you Want to Deactive ?",
        text: "If Deactive !!, It will not asset !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Deactive!'
    }).then((result) => {
        if (result.value) {
            window.location.href = link;
        } else {
            console.log("Safe Data!");
        }
    });
});

$(document).on("click", "#unblock", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
        title: "Are you Want to Active ?",
        text: "If Active !!, It will asset !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Active!'
    }).then((result) => {
        if (result.value) {
            window.location.href = link;
        } else {
            console.log("Safe Data!");
        }
    });
});


$(document).on("click", "#remove", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
        title: "Are you Want to Remove This Access ???",
        text: "If Removed !!, This User Can't Get This Access  !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, remove!'
    }).then((result) => {
        if (result.value) {
            window.location.href = link;
        } else {
            console.log("Safe Data!");
        }
    });
});


$(document).on("click", "#give", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
        title: "Are you Want to Give This Access ???",
        text: "If  Give !,This User Can Get This Access !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, give!'
    }).then((result) => {
        if (result.value) {
            window.location.href = link;
        } else {
            console.log("Safe Data!");
        }
    });
});
