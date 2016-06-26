var page = require('webpage').create();
page.open('https://tesla.com', function(status) {
  console.log("Status: " + status);
  if(status === "success") {
    page.render('google.png');
  }
  phantom.exit();
});