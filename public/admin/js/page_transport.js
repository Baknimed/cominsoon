$(document).on("click", ".place_delete", function () {
    if (confirm("Are you sure? The place that deleted can not restore!"))
        $(this).parent().submit();
});

$(document).on("change", ".place_status", function () {
    let place_id = $(this).attr("data-id");
    let availability = $(this).is(":checked");
    updateAvailabilityTransport(place_id, availability);
});

$(document).on("click", ".place_approve", function () {
    let place_id = $(this).attr("data-id");
    if (confirm("Are you sure?")) {
        updateStatusPlace(place_id, 1);
        location.reload();
    }
});

function updateAvailabilityTransport(place_id, availability) {
    let data_resp = callAPI({
        url: getUrlAPI("/transports/availability", "api"),
        method: "put",
        body: {
            transport_id: place_id,
            availability: availability,
        },
    });
    data_resp.then((res) => {
        if (res.code === 200) {
            notify(res.message);
        } else {
            console.log(res);
            notify("Error!", "error");
        }
    });
}
