"use strict";
function destroy_modal_front() {
    $("#modal_front").modal("hide");
    setTimeout(() => $("#modal_front").remove(), 111);
}
function show_modal_front($state = "success", $title = "INFO.", $message = "Message.", $hideCancelBtn = false, $redirect = "javascript:destroy_modal_front();") {
    if ($("#modal_front").length) {
        $("#modal_front").modal("hide");
        $("#modal_front").remove();
    }
    let modal_front = `<div id="modal_front" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div id="modal_front_container" class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div id="modal_front_title" class="modal-header m-0 fs-5 alert alert-${$state}">${$title}</div>
                <div id="modal_front_body" class="modal-body text-dark">${$message}</div>
                <div class="modal-footer">
                    <a id="modal_front_back" class="btn btn-dark" href="javascript:destroy_modal_front();" onclick="javascript:destroy_modal_front();">CANCEL</a>
                    <a id="modal_front_ok" class="btn btn-success" href="${$redirect}">OK</a>
                </div>
            </div>
        </div>
    </div>`;
    $("body").append(modal_front);
    $hideCancelBtn ? $("#modal_front_back").addClass("d-none") : $("#modal_front_back").removeClass("d-none");
    window.innerWidth < 992 ? $("#modal_front_container").addClass("modal-dialog-centered") : $("#modal_front_container").removeClass("modal-dialog-centered");
    $("#modal_front").modal("show");
}