//enable the data table
$(document).ready(function() {

    //get the teams element
    var teamName  = document.getElementById("teamName").value;
    var lineup    = document.getElementById("lineup").value;
    var sport     = document.getElementById("sport").value;
    var timezone  = document.getElementById("timezone").value;
    var live      = document.getElementById("live").value;

    var url = '';

    if (teamName != "" && lineup != "")
    {
      url = url + 'tms.php?team=' + teamName + '&lineup=' + lineup;
    }
    else if (sport != "" && lineup != "")
    {
      url = url + 'tms.php?sport=' + sport + '&lineup=' + lineup;
    }

    //live data support
    if (live == "true") { url = url + '&live=true'; }

    if (url != '')
    {
      url = url + '&tz=' + timezone;

      $('#airings').dataTable( {
          "bProcessing": true,
          "sAjaxSource": url,
          "sPaginationType": "full_numbers",
          "aaSorting" :[], /* disable default sorting since we sort outselves */
          "bLengthChange": false,
          "bPaginate": false, // take away pagination, does not seem neccessary
          "bInfo": false, // showing x of y of z entries
          "bFilter": false, // take away filter
          "bProcessing": false,// disable the processing indicator
          "sDom": '<"toolbar">frtrip',
          "aoColumnDefs": [
            { "sTitle":"Game",      "sWidth": "50%", "sClass": "eventTitle", "aTargets": [ 0 ], "mRender": renderTitle },
            { "sTitle":"Start Time", "sWidth": "15%", "sClass": "eventStartTime", "aTargets": [ 1 ], "mRender": renderTimestamp },
            // end times and duration set not to display in css for current iteration of design
            { "sTitle":"End Time",   "sWidth": "15%", "sClass": "eventEndTime", "aTargets": [ 2 ], "mRender": renderTimestamp },
            { "sTitle":"Duration",   "sWidth": "15%", "sClass": "eventDuration", "aTargets": [ 3 ] },
            { "sTitle":"Channels (HD)",   "sWidth": "15%", "sClass": "eventChannel", "aTargets": [ 4 ] },
            { "sTitle":"Channels (SD)",   "sWidth": "15%", "sClass": "eventChannel", "aTargets": [ 5 ] },
            // for Qualifiers and Description, they are showing up on their own in the search results. I've added in these columns to the jQuery datatables so that I can set display: none in the css and it won't show up
            //{ "sTitle":"Qualifiers",   "sWidth": "15%", "sClass": "qualifiers", "aTargets": [ 5 ] },
            //{ "sTitle":"Description",   "sWidth": "15%", "sClass": "desc", "aTargets": [ 6 ] },
          ]
          
      } );
      $("div.toolbar").html('<b>SEARCH RESULTS</b>');
    }

    //reset the live flag so it doesn't keep showing up
    if (live == "true") { document.getElementById("live").value = ''; }

} );

//clear the local storage
//this is necessary because the pre_fetch data doesn't get cleared
//even with all the ttl params that don't seem to be respected
window.localStorage.clear();

$(document).ready(function() {

  //get the zip code element
  var zip_code = document.getElementById("zipcode");

  $('.zipcodes .typeahead').typeahead([
    {
      name: 'zip-codes',
      prefetch: 'typeahead.php?zip='+zip_code.value,
      header: '<h3 class="league-name">Zip Codes</h3>'
    },
    {
      name: 'cities',
      remote: { url: 'typeahead.php?city=%QUERY' },
      header: '<h3 class="league-name">Cities</h3>'
    },
  ]);

  //onkeyup or blur, lookup the lineups
  $('.zipcodes .typeahead').blur(function(eventData) {
    zipcodeChange(eventData.target.value);
  });
  $('.zipcodes .typeahead').keyup(function(eventData) {
    zipcodeChange(eventData.target.value);
  });

  $('.sports .typeahead').typeahead([
    {
      name: 'nba-teams',
      prefetch: 'typeahead.php?teams=nba',
      header: '<h3 class="league-name">NBA Teams</h3>',
      //template: '<p id="typeahead_teamName" onclick="setTypeaheadField(\'teamName\');">{{value}}</p>',
      engine: Hogan
    },
    {
      name: 'mlb-teams',
      prefetch: 'typeahead.php?teams=mlb',
      header: '<h3 class="league-name">MLB Teams</h3>',
      //template: '<p id="typeahead_teamName" onclick="setTypeaheadField(\'teamName\');">{{value}}</p>',
      engine: Hogan
    },
    {
      name: 'nhl-teams',
      prefetch: 'typeahead.php?teams=nhl',
      header: '<h3 class="league-name">NHL Teams</h3>',
      //template: '<p id="typeahead_teamName" onclick="setTypeaheadField(\'teamName\');">{{value}}</p>',
      engine: Hogan
    },
    {
      name: 'college-bb',
      prefetch: 'typeahead.php?teams=college+basketball',
      header: '<h3 class="league-name">College Basketball</h3>',
      engine: Hogan
    },
    {
      name: 'nfl-teams',
      prefetch: 'typeahead.php?teams=nfl',
      header: '<h3 class="league-name">NFL Teams</h3>',
      //template: '<p id="typeahead_teamName" onclick="setTypeaheadField(\'teamName\');">{{value}}</p>',
      engine: Hogan
    },
    {
      name: 'soccer-teams',
      prefetch: 'typeahead.php?teams=mls+soccer',
      header: '<h3 class="league-name">Major League Soccer</h3>',
      //template: '<p id="typeahead_teamName" onclick="setTypeaheadField(\'teamName\');">{{value}}</p>',
      engine: Hogan
    },
    {
      name: 'epl-soccer-teams',
      prefetch: 'typeahead.php?teams=english+premier+league+soccer',
      header: '<h3 class="league-name">English Premier League Soccer</h3>',
      //template: '<p id="typeahead_teamName" onclick="setTypeaheadField(\'teamName\');">{{value}}</p>',
      engine: Hogan
    }
  ]);

});

function zipcodeChange(zip)
{
  var hidden = document.getElementById("hidden_zipcode").value;
  //alert(zip+":"+hidden);
  //someone changed the zip from what we guessed, or it was changed
  //if we see a comma, its a city lookup
  if (zip != hidden && zip.indexOf(',') > 0)
  {
    //someone manually typed in city, state
    if (zip.indexOf('USA') < 0)
    {
      //alert("Need to get zipcode from city lookup ["+zip+"]...");
      var request = $.ajax(
        {
          url: "typeahead.php?city="+zip,
          dataType: "json"
        }
      );
      //on complete
      request.done(
        function(json) { updateProviders(json); }
      );
      //on fail
      request.fail(
        function( jqXHR, textStatus ) { alert( "Request failed: " + textStatus ); }
      );
    }
    else
    {
      //update the providers
      updateProviders(zip);
    }
  }
  else if (zip != hidden)
  {
    updateProviders(zip);
  }
}

function updateProviders(zip)
{
  //alert('update Providers: '+zip);
  var hidden = document.getElementById("hidden_zipcode").value;
  if (zip.indexOf('USA') > 0)
  {
    var comma = zip.indexOf(',');
    //strip the city out
    zip = zip.substring(comma+1);
    //trim any whitespace
    zip = zip.trim();
    //strip the state out
    zip = zip.substring(2);
    //strip the country out
    if (zip.indexOf(',') > 0)
    {
      zip = zip.substring(0,zip.indexOf(',')).trim();
    }
  }
  //alert('['+zip+']');
  //make sure its a valid zip (ie: the length is 5)
  if (zip.length == 5 && isNumber(zip))
  {
    //set the hidden input value to be our zip
    $( "#hidden_zipcode" ).val(zip);

    var providers = $( "#lineup" );
    providers.empty();
    providers.append('<option value="">Loading...</option>');

    //alert("Need to get lineups...");
    var request = $.ajax(
      {
        url: "tms.php?lineups="+zip,
        dataType: "json"
      }
    );
    //on complete
    request.done(function(json)
      {
        var providers = $( "#lineup" );
        if (providers == null) { alert("Error: Cannot find providers control!"); }
        if (json == null) { alert("Error: Invalid lineup results!"); }
        providers.empty();
        for(var v=0; v<json.length; v++)
        {
          var lineup = json[v];
          //if (v == 0) { alert("Providers have been refreshed"); }
          providers.append('<option value="'+lineup.lineupId+'">'+lineup.name+'</option>');
        }
      }
    );
    //on fail
    request.fail(function( jqXHR, textStatus )
      {
        alert( "Request failed: " + textStatus );
      }
    );
  }
}

function isNumber(n)
{
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function setTypeaheadField(typeaheadControlId)
{
  var ta_teamName = document.getElementById("typeahead_"+typeaheadControlId).innerHTML;
  var form_teamName = document.getElementById(typeaheadControlId);
  form_teamName.value = ta_teamName;
}

function submitForm(sportValue,liveOnly)
{
  var form = document.getElementById("game_form");
  var sport = document.getElementById("sport");
  var team = document.getElementById("teamName");
  var live = document.getElementById("live");
  var lineup = document.getElementById("lineup");
  if (team != null) { team.value = ''; }
  if (sport != null) { sport.value = sportValue; }
  if (live != null && liveOnly != null) { live.value = liveOnly; }
  //alert(lineup.options[lineup.selectedIndex].value);
  if (lineup != null && lineup.options[lineup.selectedIndex].value != '')
  {
    form.submit();
  }
}

function renderTitle(data, type, full)
{
  return  '<span title="' + full[6] + '">'+data + '</span>';
}

function renderTimestamp(data, type, full)
{
  var date = data.substring(0,data.indexOf(" "));
  var time = data.substring(data.indexOf(" ")+1);
  //return  '<span title="' + data + '">'+date +'<br/>' + time + '</span>';
  //TODO: only show date if its not today
  return  '<span style="white-space:wrap;" title="' + data + '">'+data + '</span>';
}


// this function is for the clear filters button
function clearFilters ()
{
  document.getElementById("game_form").reset();
  document.getElementById("teamName").value = "";
  document.getElementById("zipcode").value = "";
}


// this function is for the ongoing games button
function onGoingGames ()
{

}