  const cookieBox =  document.querySelector(".wrapper");
  const buttons =  document.querySelectorAll(".button");
    console.log(cookieBox, buttons);

    const executeCodes = () => {
        if(document.cookie.includes("codinglab")) return;
      cookieBox.classList.add("show");

      buttons.forEach((button) => {
        button.addEventListener("click", () => {
          cookieBox.classList.remove("show");

          // if button has acceptBtn id
          if(button.id == "acceptBtn"){
            // console.log("contains");
            // set cookies for 1 month. 60 = 1 min, 60 = 1 hours, 24 = 1 day, 30 = 30 days
            document.cookie = "cookieBy = codinglab; max-age=" + 60 * 60 * 24 * 2; 
          }
        });
    });
  };    
  // excuteCodes function will be called on webpage load
  window.addEventListener("load", executeCodes);







