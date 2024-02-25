$('.modal-overlay').hide();  // Modal is initially hidden

  const scrollPos = $(window).scrollTop();  // Get the scroll position before modal display

  setTimeout(() => {  
    $('.modal-overlay').fadeIn(400);  // Display modal in 0.4 seconds
    $('html, body').css('overflow', 'scroll');// Freeze the background so it doesn't scroll
    $('.app').css({position: 'fixed', top: -scrollPos, left: '0'});  // Fixed the body behind the overlay (scroll control)
  },100);  // Set the fixed time to 60 seconds (60000 milliseconds)

  $('button').click(function() {  // When you click the close (×) button on the modal
    $('.modal-overlay').fadeOut(400);  // Hide modal in 0,4 seconds
    $('html, body').css('overflow', 'scroll');// Unpin the background
    $(window).scrollTop(scrollPos);  // restore scroll position
  });



  // Get “Agree” checkbox
  const agreeCheckbox = document.getElementById("agree");
  // close button
  const closeBtn = document.getElementById("modal1-close");

  // When the checkbox is clicked
  agreeCheckbox.addEventListener("click", () => {
    // If checked
    if (agreeCheckbox.checked === true) {
      closeBtn.disabled = false; // Remove disabled

    }
    else if (agreeCheckbox.checked === null){ 
      closeBtn.disabled = false;
    }
    // If not checked
    else {
      closeBtn.disabled = true; // Add disabled

    }
});

// // When you close the modal
// $('.modal1-close').click(function() {

//   $('.wrapper').fadeOut(400);

//   // Unpin the background
//   // $('html, body').removeAttr('style');
//   $('html, body').css('overflow', 'visible');

// });