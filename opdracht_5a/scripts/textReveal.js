function showMore(element) {
  console.log(element);
  element.childNodes[1].style.display = "none";
  element.parentElement.childNodes[9].style.display = "block";
}
