// function updateRating (productId) {
//    // Retreive the rating for this product from DOM tree
//    foundRating = ...
//
//    // Send to the server
//   $.post("index.php?page=ajax&action=updateRating",
//     { // POST Data
//       product_id : productId,
//       rating : foundRating
//     },
//     handleUpdateRatingResult
//   );
// }
//
//   function handleUpdateRatingResult (data) {
//     // Update new received rating
// }



function hover(element, i) {
  console.log("rating.js hover() activated");
  i++; // i is current star (0-4)
  for (var x = 1; x < (i * 2); x+=2) {
    element.childNodes[x].childNodes[0].setAttribute('src', 'http://localhost/Educom_Curriculum/opdracht_5a/img/star_thin_full.jpg');
  }
  for (var y = i*2+1; y < 10; y+=2) {
    element.childNodes[y].childNodes[0].setAttribute('src', 'http://localhost/Educom_Curriculum/opdracht_5a/img/star_thin_empty.jpg');
  }
  // element.setAttribute('src', 'http://localhost/Educom_Curriculum/opdracht_5a/img/star_thin_full.jpg');
}

function unhover(element, userRating) {
  for (var x = 1; x < (userRating * 2); x+=2) {
    element.childNodes[x].childNodes[0].setAttribute('src', 'http://localhost/Educom_Curriculum/opdracht_5a/img/star_thin_full.jpg');
  }
  for (var y = (userRating * 2)+1; y < 10; y+=2) {
    element.childNodes[y].childNodes[0].setAttribute('src', 'http://localhost/Educom_Curriculum/opdracht_5a/img/star_thin_empty.jpg');
  }
}
