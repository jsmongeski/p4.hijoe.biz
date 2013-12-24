<head>
    <TITLE> Portfolio Plus!</TITLE>
</head>

    
    <h2>
         Portfolio: <?=$pfname?>
         <br> <small> Enter a new stock:</small>
    </h2>

<body>

    <div id='results'></div>

    <!--$portf_id is  the db portfolio id, passed in from the portfolio controller -->

    <?php if(isset($portf_id)): ?>
        <input id="portfid" type="hidden" value="<?=$portf_id?>">
    <?php else:  ?>
        <input id="portfid" type="hidden" value="">
    <?php endif; ?>

    <form onsubmit="return false">

        <input placeholder="Symbol" id="newticker" type="text" name="symbol">
        <input placeholder="Cost" id="cost" type="text" name="Cost" >
        <input placeholder="Number of Shares" id="nshares"  type="text" name="nshares" >

        <input type="submit" value="Submit">
    </form> 

    <p></p>
 
    <TABLE id="dataTable" border="1" >
       <tr id=tblcolhead >
          <th id="Symbol">      Symbol      </th>
          <th id="Last">Last</th>
          <th id="volume">Volume</th>
          <th id="avvolume">Avg Volume</th>
          <th id="sharecost">Cost</th>
          <th id="shares">Num Shares</th>
          <th id="origvalue">OrigValue</th>
          <th id="curvalue">Current Value</th>
          <th id="gainloss">Gain/Loss</th>
          <th id="sim">Sim Update</th>
          <th id="options"></th>
        </tr>
    </TABLE>

    <!-- Check if we're retrieving a portfolio, or creating a new one: -->
    <?php if(isset($restorelist)): ?>
       <input id="restorelist" type="hidden" value="<?=$restorelist?>">
    <?php else: ?>
       <input id="restorelist" type="hidden" value="">
    <?php endif; ?>


    <input id="savetbl"  type="button" name="Dump Table" value="Save Portfolio" >

    <!--Source in jquery -->

</body>

    <!--
    <?php if(isset($pfname)): ?>
    <?php endif; ?>
       <link rel="stylesheet" href="/css/noMainMenu.css" type="text/css">
        <input placeholder="Broker Url" id="brokerurl"   type="text" name="brokerurl" >
         <img id="gomez" src="/images/gomezTicker.jpg" alt="Gomez" >
         &nbsp; &nbsp; <small> Enter a new stock:</small>
    -->
