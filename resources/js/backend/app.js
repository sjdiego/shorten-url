window._ = require("lodash");

window.axios = require("axios");
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
}

import { InertiaApp } from "@inertiajs/inertia-react";
import React from "react";
import { render } from "react-dom";

const app = document.getElementById("app");

render(
    <InertiaApp
        initialPage={JSON.parse(app.dataset.page)}
        resolveComponent={(name) =>
            import(`./components/${name}`).then((module) => module.default)
        }
    />,
    app
);
