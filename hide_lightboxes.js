var elements = document.getElementsByTagName('div');

for (var i = 0; i < elements.length; i++) {
	var zindex = document.defaultView.getComputedStyle(elements[i],null).getPropertyValue("z-index");
	if ((zindex > 25)) {
		elements[i].style.display = 'none';
	}
}
