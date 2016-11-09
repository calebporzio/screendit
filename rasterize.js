// Timer
var start = new Date().getTime();

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

    // Set timeout on page load.
    page.settings.resourceTimeout = 5000; // in milliseconds

    // sets the crop for the output image
    if (outputWidth != 0 && outputHeight != 0) {
        page.clipRect = { top: 0, left: 0, width: outputWidth, height: outputHeight };
    }

    // Timer
    var end = new Date().getTime();
    console.log('Boot: ' + String((end - start) / 1000))
    var startOpen = new Date().getTime();

    page.open(sourceUrl, function (status) {

        // Timer
        var endOpen = new Date().getTime();
        console.log('Page Open: ' + String((endOpen - startOpen) / 1000))
        var start = new Date().getTime();

        if (status !== 'success') {
            console.error('Error: Unable to load the address');
            phantom.exit(1);
        } else {
            window.setTimeout(function () {
                if (modalZap === 1) {
                    page.injectJs('hide_lightboxes.js');
                }
                page.render(outputFile);

                // Timer
                var end = new Date().getTime();
                console.log('Page Render: ' + String((end - start) / 1000))

                phantom.exit();
            }, 100);
        }
    });
}
