"use strict";
$(document).ready(function () {
    let URI = localStorage.getItem("URI"),
        _GET = JSON.parse(localStorage.getItem("_GET")),
        _POST = JSON.parse(localStorage.getItem("_POST")),
        HISTORY_INDEX = -1;
    const ROUTES = JSON.parse(localStorage.getItem("ROUTES")),
        TO_HOME = localStorage.getItem("TO_HOME"),
        HOME_PATH = localStorage.getItem("HOME_PATH"),
        HISTORY_PATH = [],
        COMPONENTS = {};
    const getLocalStorageItems = function () {
        URI = localStorage.getItem("URI");
        _GET = JSON.parse(localStorage.getItem("_GET"));
        _POST = JSON.parse(localStorage.getItem("_POST"));
    };
    const historyPushState = function (url) {
        HISTORY_INDEX++;
        HISTORY_PATH[HISTORY_INDEX] = url;
        history.pushState({ index: HISTORY_INDEX }, "", url);
    };
    const errorPage = function (status, custom_error_message = "") {
        $.ajax({
            url: `${HOME_PATH}_error.php?e=${status}`,
            type: "POST",
            data: { custom_error_message },
            success: function (data) {
                document.write(data);
                $("head").append(`<script>
                const parseURL = ${parseURL}, routeURL = ${routeURL}, loadSPA = ${loadSPA}, getLocalStorageItems = ${getLocalStorageItems}, ROUTES = ${JSON.stringify(ROUTES)}, TO_HOME = "${TO_HOME}", HOME_PATH = "${HOME_PATH}", HISTORY_PATH = ${JSON.stringify(HISTORY_PATH)}, COMPONENTS = ${JSON.stringify(COMPONENTS)};
                let _GET = ${JSON.stringify(_GET)}, _POST = ${JSON.stringify(_POST)}, HISTORY_INDEX = ${HISTORY_INDEX};
                window.addEventListener("popstate", function (e) {
                    HISTORY_INDEX = e.state.index;
                    loadSPA(HISTORY_PATH[HISTORY_INDEX], false);
                });
                </script>`);
            }, error: function (xhr, status, error) {
                console.log("Error loading content:", error);
            }
        });
    };
    const reloadComponent = function (component, file, get, post) {
        COMPONENTS[component] = file;
        $.ajax({
            url: `${HOME_PATH}${file}?${new URLSearchParams(get).toString()}`,
            type: "POST",
            data: { ...post },
            success: function (data) {
                $(component).html(data);
            }, error: function (xhr, status, error) {
                console.log("Error loading content:", error);
            }
        });
    };
    const parseURL = function (uri = "/") {
        while (uri.length > 0 && !uri.startsWith("/")) uri = uri.substring(1);
        while (uri.length > 1 && uri.endsWith("/")) uri = uri.substring(0, uri.length - 1);
        if (!uri.includes("/$/")) return { path: uri, params: {} };
        const [path, param] = uri.split("/$/", 2);
        const keyValuePairs = param.split("/");
        const params = {};
        for (let i = 0; i < keyValuePairs.length; i += 2)
            if (keyValuePairs[i + 1] !== undefined)
                params[keyValuePairs[i]] = keyValuePairs[i + 1];
        return { path, params };
    };
    const routeURL = function (uri = "/") {
        const { path, params } = parseURL(uri);
        if (!ROUTES.hasOwnProperty(path) || !Object.entries(ROUTES).length) errorPage(404, `Route "${uri}" does not exist.`);
        localStorage.setItem("URI", path);
        localStorage.setItem("_GET", JSON.stringify({ ..._GET, ...ROUTES[path]?.GET ?? [], ...params }));
        localStorage.setItem("_POST", JSON.stringify({ ..._POST, ...ROUTES[path]?.POST ?? [] }));
        getLocalStorageItems();
        uri = ROUTES[path]?.URI;
        if (uri == "") uri = _GET["uri"] ? (ROUTES[_GET["uri"]]?.URI ? ROUTES[_GET["uri"]]?.URI : ROUTES["/"]?.URI) : ROUTES["/"]?.URI;
        else _GET["uri"] = URI;
        return { path, uri, file: ROUTES[path]?.FILE, get: _GET, post: _POST, component: ROUTES[path]?.COMPONENT };
    };
    const loadSPA = function (url, push = true) {
        $("#spa-loader").fadeIn(1);
        $("#spa-page-content-container").html("");
        const { path, uri, file, get, post, component } = routeURL(`${url}`);
        if (push) historyPushState(url);
        if (!$("#spa-page-content-container").length) location.reload();
        for (let key in component) reloadComponent(key, component[key], get, post);
        if (!file) $.ajax({
            url: `${HOME_PATH}${uri}?${new URLSearchParams(get).toString()}`,
            type: "POST",
            data: { ...post },
            success: function (data) {
                $("#spa-page-content-container").html(data);
            }, error: function (xhr, status, error) {
                console.log("Error loading content:", error);
                errorPage(404, `Route "${url}" does not exist.`);
            }, complete: function () {
                $("#spa-loader").fadeOut(500);
            }
        });
        else window.location = path;
    };
    window.addEventListener("popstate", function (e) {
        if (!e.state || e.state.index == undefined) return;
        HISTORY_INDEX = e.state.index;
        loadSPA(HISTORY_PATH[HISTORY_INDEX], false);
    });
    $(document).on("click", "a:not([target='_blank']):not([href^='#']):not([href^='javascript:']):not([custom-folder='true'])", function (e) {
        e.preventDefault();
        loadSPA($(this).attr("href"));
    });
    loadSPA(`${TO_HOME == "./" ? "." : TO_HOME}${URI}`);
});