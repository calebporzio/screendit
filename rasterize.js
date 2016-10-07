"use strict";
var page = require('webpage').create(),
    system = require('system');

// Exit if invalid amount of arguments
if (system.args.length !== 8) {
    console.error('Error: Invalid number of arguments');
    phantom.exit(1);
} else {
    var sourceUrl = system.args[1];
    var outputFile = system.args[2];
    var viewportWidth = parseInt(system.args[3], 10);
    var viewportHeight = parseInt(system.args[4], 10);
    var outputWidth = parseInt(system.args[5], 10);
    var outputHeight = parseInt(system.args[6], 10);
    var modalZap = system.args[7] ? 1 : 0;

    // Set viewport size
    page.viewportSize = { width: viewportWidth, height: viewportHeight };

    // sets the crop for the output image
    if (outputWidth != 0 && outputHeight != 0) {
        page.clipRect = { top: 0, left: 0, width: outputWidth, height: outputHeight };
    }

    page.open(sourceUrl, function (status) {
        if (status !== 'success') {
            console.error('Error: Unable to load the address');
            phantom.exit(1);
        } else {
            window.setTimeout(function () {
                if (modalZap === 1) {
                    page.injectJs('hide_lightboxes.js');
                }
                page.render(outputFile);
                phantom.exit();
            }, 100);
        }
    });
}
