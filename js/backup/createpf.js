
        // Portfolio name input box:
        var tickerEl  = document.getElementById("portfolio_name");
        var stocktxt = "Portfolio Name";
        tickerEl.value =  stocktxt;
        tickerEl.style.color = "#0C9";
        // onmouse logic:
        tickerEl.onmouseover = function() {
          if (this.value == stocktxt) {
            this.value = "";
            this.style.color = "#000";
          }
        }
        tickerEl.onmouseout = function() {
          if (this.value == "") {
           this.value = stocktxt;
           this.style.color = "#0C9";
          }
        }


        // Email input box:
        var emailEl  = document.getElementById("email");
        var emailtxt = "Email Address";
        emailEl.value =  emailtxt ;
        emailEl.style.color = "#0C9";
        // onmouse logic:
        emailEl.onmouseover = function() {
          if (this.value == emailtxt ) {
            this.value = "";
            this.style.color = "#000";
          }
        }
        emailEl.onmouseout = function() {
          if (this.value == "") {
           this.value = emailtxt ;
           this.style.color = "#0C9";
          }
        }
