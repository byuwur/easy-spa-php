<?php
// --- API functions ---
function api_respond(int $status, bool $error, string $message, array $data = [])
{
    header("Content-Type: application/json");
    $response = new stdClass();
    $response->status = $status;
    $response->error = $error;
    $response->message = $message;
    $response->data = $data;
    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    ob_end_flush();
    exit;
}
function make_http_request(string $url, array $get = [], array $post = [])
{
    session_write_close();
    $post[session_name()] = session_id();
    $req = curl_init();
    curl_setopt($req, CURLOPT_URL, $url . "?" . http_build_query($get));
    curl_setopt($req, CURLOPT_POST, 1);
    curl_setopt($req, CURLOPT_POSTFIELDS, $post);
    curl_setopt($req, CURLOPT_RETURNTRANSFER, true);
    $requested = curl_exec($req);
    if (curl_errno($req)) echo "<script>console.error(\"CURL ERROR: " . curl_error($req) . "\");</script>";
    curl_close($req);
    session_start();
    return $requested;
}
function validate_value($input, string $type = "")
{
    if (!isset($input)) return false;
    if ($input == null) return false;
    if ($input == "null") return false;
    if ($input == "") return false;
    $filterMap = [
        "boolean" => FILTER_VALIDATE_BOOLEAN,
        "domain" => FILTER_VALIDATE_DOMAIN,
        "email" => FILTER_VALIDATE_EMAIL,
        "float" => FILTER_VALIDATE_FLOAT,
        "int" => FILTER_VALIDATE_INT,
        "ip" => FILTER_VALIDATE_IP,
        "mac" => FILTER_VALIDATE_MAC,
        "url" => FILTER_VALIDATE_URL
    ];
    return filter_var($input, $filterMap[$type] ?? FILTER_UNSAFE_RAW);
}
function sanitize_value($input, string $type = "")
{
    $input = trim($input);
    $input = strip_tags($input);
    $input = htmlspecialchars($input);
    $filterMap = [
        "email" => FILTER_SANITIZE_EMAIL,
        "encoded" => FILTER_SANITIZE_ENCODED,
        "float" => FILTER_SANITIZE_NUMBER_FLOAT,
        "int" => FILTER_SANITIZE_NUMBER_INT,
        "special_chars" => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        "url" => FILTER_SANITIZE_URL
    ];
    return filter_var($input, $filterMap[$type] ?? FILTER_UNSAFE_RAW);
}
// --- functions ---
function error_crash(int $status, string $message, string $error_file)
{
    $_GET["e"] = $status;
    $_POST["custom_error_message"] = $message;
    require_once $error_file;
    ob_end_flush();
    exit;
}
function suppress_errors()
{
    error_reporting(0);
    ini_set("display_errors", 0);
}
function escape_html($input)
{
    $output = htmlspecialchars($input, ENT_QUOTES, "UTF-8", false);
    return nl2br($output);
}
function exit_json($json)
{
    header("Content-Type: application/json");
    echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    ob_end_flush();
    exit;
}
function print_json($json)
{
    echo json_encode($json, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
function random_string($length)
{
    $string = "";
    $char = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz";
    for ($i = 0; $i < $length; $i++) $string .= substr($char, rand(0, strlen($char)), 1);
    return $string;
}
function show_modal_back($state = "success", $title = "INFO.", $message = "Message.", $hideCancelBtn = false, $redirect = "javascript:destroy_modal_back();")
{
    echo '<div id="modal_back" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
        <div id="modal_back_container" class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div id="modal_back_title" class="modal-header m-0 fs-5 alert alert-' . $state . '">' . $title . '</div>
                <div id="modal_back_body" class="modal-body text-dark">' . $message . '</div>
                <div class="modal-footer">
                    <a id="modal_back_back" class="btn btn-dark" href="javascript:destroy_modal_back();" onclick="javascript:destroy_modal_back();">CANCEL</a>
                    <a id="modal_back_ok" class="btn btn-success" href="' . $redirect . '">OK</a>
                </div>
            </div>
        </div>
    </div>
    <script>
    "use strict";
    function destroy_modal_back() {
        $("#modal_back").modal("hide");
        setTimeout(() => $("#modal_back").remove(), 999);
    }
    $(document).ready(function () {
        ' . ($hideCancelBtn ? '$("#modal_back_back").addClass("d-none");' : '$("#modal_back_back").removeClass("d-none");') . '
        window.innerWidth < 992 ? $("#modal_back_container").addClass("modal-dialog-centered") : $("#modal_back_container").removeClass("modal-dialog-centered");
        $("#modal_back").modal("show");
    });
    </script>';
}
function get_mime_type($filename)
{
    $mime = [
        'aac' => 'audio/aac',
        'abw' => 'application/x-abiword',
        'arc' => 'application/octet-stream',
        'avi' => 'video/x-msvideo',
        'azw' => 'application/vnd.amazon.ebook',
        'bin' => 'application/octet-stream',
        'bmp' => 'image/bmp',
        'bz' => 'application/x-bzip',
        'bz2' => 'application/x-bzip2',
        'csh' => 'application/x-csh',
        'css' => 'text/css',
        'csv' => 'text/csv',
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'eot' => 'application/vnd.ms-fontobject',
        'epub' => 'application/epub+zip',
        'gif' => 'image/gif',
        'htm' => 'text/html',
        'html' => 'text/html',
        'ico' => 'image/x-icon',
        'ics' => 'text/calendar',
        'jar' => 'application/java-archive',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'mid' => 'audio/midi',
        'midi' => 'audio/midi',
        'mpeg' => 'video/mpeg',
        'mpkg' => 'application/vnd.apple.installer+xml',
        'odp' => 'application/vnd.oasis.opendocument.presentation',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        'odt' => 'application/vnd.oasis.opendocument.text',
        'oga' => 'audio/ogg',
        'ogv' => 'video/ogg',
        'ogx' => 'application/ogg',
        'otf' => 'font/otf',
        'png' => 'image/png',
        'pdf' => 'application/pdf',
        'ppt' => 'application/vnd.ms-powerpoint',
        'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'rar' => 'application/x-rar-compressed',
        'rtf' => 'application/rtf',
        'sh' => 'application/x-sh',
        'svg' => 'image/svg+xml',
        'swf' => 'application/x-shockwave-flash',
        'tar' => 'application/x-tar',
        'tif' => 'image/tiff',
        'tiff' => 'image/tiff',
        'ts' => 'application/typescript',
        'ttf' => 'font/ttf',
        'txt' => 'text/plain',
        'vsd' => 'application/vnd.visio',
        'wav' => 'audio/x-wav',
        'weba' => 'audio/webm',
        'webm' => 'video/webm',
        'webp' => 'image/webp',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'xhtml' => 'application/xhtml+xml',
        'xls' => 'application/vnd.ms-excel',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'xml' => 'application/xml',
        'xul' => 'application/vnd.mozilla.xul+xml',
        'zip' => 'application/zip',
        '3gp' => 'video/3gpp',
        '3g2' => 'video/3gpp2',
        '7z' => 'application/x-7z-compressed'
    ];
    $type = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    return $mime[$type] ?? "application/octet-stream";
}
