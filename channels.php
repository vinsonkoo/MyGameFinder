<?php include('header.php'); ?>
<div class="container">
  <!-- channels -->
  <center>
    <h1>Channels</h1>
    <div id="dynamic">
      <table cellpadding="0" cellspacing="0" border="0" class="pretty" id="airings">
      </table>
    </div>
  </center>
  <script type="text/javascript">
    //enable the data table
    $(document).ready(function() {
        $('#airings').dataTable( {
            "bProcessing": true,
            "sAjaxSource": 'tms.php?channels',
            "sPaginationType": "full_numbers",
            "aoColumnDefs": [
              { "mData": "channel", "sTitle":"Channel",   "sWidth": "20%", "aTargets": [ 0 ] },
              { "mData": "callSign", "sTitle":"Name",      "sWidth": "20%", "aTargets": [ 1 ] },
              { "mData": "affiliateCallSign", "sTitle":"Affiliate", "sWidth": "20%", "aTargets": [ 2 ] },
              {
                "mData": "image.uri",
                "mRender" : function ( data, type, full ) {
                  //return '<img src="'+link+'"/>';
                  var link = 'http://developer.tmsimg.com/'+data+'?api_key=r4dbakty98d7sax7qnptzqwn"';
                  return '<a href="'+link+'" target="link">'+data+'</a>';
                 },
                "sTitle":"Image", "sWidth": "20%", "aTargets": [ 3 ]
              },
            ]
        } );
    } );
    function renderImage(data, type, full)
    {
      return "AARON-"+data;
    }
  </script>
</div><!-- /container -->