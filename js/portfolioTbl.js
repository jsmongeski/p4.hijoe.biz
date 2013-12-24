

        
        var currentBroker;

        //function addRow(table,ticker, cost, nshares, brokerLink) {
        function addRow(table,ticker, cost, nshares ) {

            // Create a new row:
            var table = document.getElementById(table);

            var rowCount = table.rows.length;
            
            while ( $('#row'+ rowCount).length != 0 ) {
                rowCount++;
            } 
            

            // Insert new row:
            var row = table.insertRow(rowCount);

            // Inesrt Cells:
            
            // Symbol
            ticker = ticker.toUpperCase();
            var symbol = row.insertCell(0);
            symbol.type =  "text";
            symbol.name =  "symbol";
            var tickerorig = ticker;
            if( $('#symbol' + ticker).length )  {
                    var ranNumber = 1 + Math.floor(Math.random() * 10);
                    var ticker = ticker + ranNumber;
            }
            symbol.id =  "symbol" + ticker;
            symbol.innerHTML = tickerorig ; 
            

            // Last share price:
            var Last = row.insertCell(1);
            Last.type =  "text"; Last.name =  "last";
            Last.id =  "last" + ticker;
            Last.innerHTML = "0"; 
            var last = Last.innerHTML;


            // Volume :
            var Volum = row.insertCell(2);
            Volum.type =  "text";
            Volum.name =  "vol";
            Volum.id =  "vol" + ticker;
            Volum.innerHTML = '200000'; 

            // AvVolume :
            var AvVolum = row.insertCell(3);
            AvVolum.type =  "text";
            AvVolum.name =  "avvol";
            AvVolum.id =  "avvol" + ticker;
            AvVolum.innerHTML = '300000'; 
            
            // Cost per share :
            var Cost = row.insertCell(4);
            Cost.type =  "text";
            Cost.name =  "cost";
            Cost.id =  "cost" + ticker;
            Cost.innerHTML = cost; 

            // Number of shares :
            var NumShrs = row.insertCell(5);
            NumShrs.type =  "text";
            NumShrs.name =  "nshares";
            NumShrs.id =  "nshares" + ticker;
            NumShrs.innerHTML = nshares; 

            // Original Value
            var OrigVal = row.insertCell(6);
            OrigVal.type =  "text";
            OrigVal.name =  "origval";
            OrigVal.id =  "origval" + ticker;
            var tmpval = cost * nshares;
            OrigVal.innerHTML = tmpval.toFixed(2);
            tmpval = 0;
            var origval =  OrigVal.innerHTML;

          
            // Current Value
            var CurVal = row.insertCell(7);
            CurVal.type =  "text";
            CurVal.name =  "curval";
            CurVal.id =  "curval" + ticker;
            CurVal.innerHTML = last * nshares;
            var curval =  CurVal.innerHTML;

            // Gain/Loss
            var GainLoss = row.insertCell(8);
            GainLoss.type = "text";
            GainLoss.name = "gainloss";
            GainLoss.id =  "gainloss" + ticker;
            curval=0;
            tmpval =  curval - origval;

            $('#gainloss' + ticker).css('backgroundColor', "lightgreen");
            if (tmpval < 0 ) {
                $('#gainloss' + ticker).css('backgroundColor', "red");
            } 
            GainLoss.innerHTML = tmpval.toFixed(2);
            tmpval =  0;


            // Broker link
            /*
            var Trade = row.insertCell(9);
            Trade.type = "text";
            Trade.value = "Trade";
            Trade.id =  "trade" + ticker;

            if(brokerLink != "Broker eg: www.trade.com") {
                var linkPrefix = '<a href="https://'
                var linkSuffix =  '" target = "_blank">Trade</a>';
                var res =  linkPrefix.concat(brokerLink);
                currentBroker =  res.concat(linkSuffix);
            }
            Trade.innerHTML =  currentBroker;
            */


            // Simulate a stock update from an internet data service:
            var Update = row.insertCell(9);
            var updatebtn = document.createElement("input");
            updatebtn.type = "button";
            updatebtn.value = "Update";
            updatebtn.id =  "updatebtn" + ticker;
            Update.appendChild(updatebtn);

            $('#updatebtn' + ticker).click(function() {

                // last stk price:
                $('#last' + ticker).html("25");

                // get new last:
                var last = $('#last' + ticker).html();

                // volume:
                $('#vol' + ticker).html("233000");

                // get nshares:
                var nshares = $('#nshares' + ticker).html();

                // set/get current stock value:
                $('#curval' + ticker).html(last * nshares);
                var curval = $('#curval' + ticker).html();

                // get original value:
                var origval = $('#origval' + ticker).html();

                //set gainloss:
                $('#gainloss' + ticker).html(curval - origval);

                //set gainloss color:
                $('#gainloss' + ticker).css('backgroundColor', "lightgreen");
                if (  $('#gainloss' + ticker).html() < 0 ) {
                    $('#gainloss' + ticker).css('backgroundColor', "red");
                } 
            });

            // Setup Delete row handler:
            var deleterow = row.insertCell(10);
            var deleteMe = document.createElement("input");
            deleteMe.type = "button";
            deleteMe.value="Delete";
            deleteMe.id =  "deleteme" + ticker;
            deleterow.appendChild(deleteMe);

            $('#deleteme' + ticker).click(function() {
                // Delete this stock from stock table using ajax:
                $.ajax({
                    type: 'POST',
                    url: '/stocks/deletestock',
                    success: function(response) { 
                        // Use this for debugging:
                        //$('#results').html(response);
                    },
                    data: {
                        symbol: ticker,
                    },
                }); // end ajax setup
                
                // now delete the row from the stock table:
                var delId =  '#deleteme' + ticker;
                var delRow = $(delId).parent().parent().index(); 
                table.deleteRow(delRow);
            });


        } //addRow


        //  Stock table input Form :
        $("form").submit(function(){

           // Note, we don't check data type on the stock ticker,
           // as there are numeric stock symbols, e.g. "3".

           var ticker =  $("#newticker").val();
           var cost    = $("#cost").val();
           var nshares = $("#nshares").val();
           //var brokerLink = $("#brokerurl").val();

           
           if (ticker == "" ) {
               alert( "Please enter a Stock Symbol");
               return;
           } else if(ticker.length > 6) {
               alert("Please enter a symbol of valid length, <=6 chars");
               return;
           } else if (cost < 0 || isNaN(cost) || cost == "") {
               alert( "Please enter a positive numeric cost value");
               return;
           } else if (nshares < 0 || isNaN(nshares) || nshares == "") {
               alert( "Please enter a positive number for number of shares");
               return;
           } else {

               // Add this stock to table:
               addRow('dataTable', ticker, cost, nshares );
               //addRow('dataTable', ticker, cost, nshares, brokerLink);
           }

           // Reset stock input boxes:
           $("#newticker").val("");
           $("#newticker").attr("placeholder", "Symbol");
           $("#cost").val("");
           $("#cost").attr("placeholder", "Cost");
           $("#nshares").val("");
           $("#nshares").attr("placeholder", "Number Of Shares");
           //$("#brokerurl").val("");
           //$("#brokerurl").attr("placeholder", "Broker Url");

        });



        // Save stock table info to the database via html form/submit:
        $('#savetbl').click(function() {
           var i = 0;
           var thissymbol;
           var thiscost;
           var portf_id;

           action =  '/stocks/p_add/0'
           if ( $('#restorelist').val() != "" ) {
               action =  '/stocks/p_add/1'
           }

           $form = $('<form>', {
                    "method": "POST",
                    "id": "saveStkToDb",
                    "action": action
           });

           $('#dataTable tr').each(function() {

               if (i == 0) { i++; return}  //skip over table headers:

               thissymbol = $(this).find("td").eq(0).html();    
               thiscost =   $(this).find("td").eq(4).html();    
               nshares =   $(this).find("td").eq(5).html();    
               portf_id =   $('#portfid').val();

               $form.append('<input  type="hidden" name="symbol' + i +         '" value="' + thissymbol + '">');
               $form.append('<input  type="hidden" name="purchase_price' + i + '" value="' + thiscost + '">');
               $form.append('<input  type="hidden" name="portfolio_id' + i +   '" value="' + portf_id + '">');
               $form.append('<input  type="hidden" name="nshares' + i +        '" value="' + nshares + '">');
               i++;
           });
           $form.appendTo(document.body).submit();
        });


        // Get portfolio names in #portflist, present them as links to the user from which 
        // a selected portfolio will be rerieved from the db, for viewing/editing. 
        // (See #restorelist below):
        //

        pfaction = $('#pfaction').val();
        if(pfaction == "get")    { pf_url =  '/stocks/p_pfget'; } 
        if(pfaction == "delete") { pf_url =  '/portfolios/deleteportfolio'; } 

        $('#portflist').each(function() {
           $form = $('<form>', {
                    "method": "POST",
                    "id": "pflister",
                    "action": pf_url
           });
                    
           pfname=   $('#portflist').val();
           var pfnameArray = pfname.split(' ');
           var Link;

           $.each(pfnameArray, function (i, elem) {
              if (elem != "" ) {
                  if(pfaction == "get")    { 
                      Link = '/stocks/p_pfget/' + elem ;
                      Link2 = "<a href=" + Link +" >&nbsp;&nbsp; Get Portfolio: " + elem +"</a><br>";
                  } 
                  if(pfaction == "delete")    { 
                      Link = '/portfolios/deleteportfolio/' + elem ;
                      Link2 = "<a href=" + Link +" >&nbsp;&nbsp; Delete Portfolio: " + elem +"</a><br>";
                  }

              $form.append(Link2);
              }
           });
           $form.appendTo(document.body);
        });


        // Get stock info in #restorelist (set in v_stocks_add), rebuild stock table:
        $('#restorelist').each(function() {
           if ( $('#restorelist').val() != "" ) {

               rst=   $('#restorelist').val();
               var rstArray = rst.split(' ');

               var args = "sym cost nshr ";
               var argArray = args.split(' ');

               j=0;
               for (var i = 0; i < rstArray.length; i++) {
                 argArray[j] =   rstArray[i];
                 j++;
                 if (j == 3) {
                     addRow('dataTable', argArray[0], argArray[1], argArray[2]);
                     j = 0; 
                 }
               }
           }
        });

