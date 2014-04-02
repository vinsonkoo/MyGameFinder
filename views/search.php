<!-- <input type="hidden" name="timezone" id="timezone" value="<?php echo $timezone?>"/> -->

<div class="container search">
  <div class="row">

    <div class="col-md-3 search_fields">
      <h2 class="struggling">Struggling to find the game you want to watch tonight?</h2>

      <div class="row">

        <!-- search form -->
        <div class="row search_form">
            <form name="game_form" id="game_form" method="POST" action="">
              <!-- hidden fields -->

              <!-- zip code search -->
              <div class="row">
                <div class="zipcodes">
                  <h4>ZIP CODE, CITY, OR STATE</h4>
                  <input type="text" name="zipcode" id="zipcode" value="<?php echo $zip_code?>" placeholder="ZIP CODE, CITY, OR STATE" class="typeahead"/>
                  <input type="hidden" name="hidden_zipcode" id="hidden_zipcode" value="<?php echo $postal_code?>"/>
                </div> <!-- .zipcodes -->
              </div>

              <!-- cable provider search-->
              <div class="row">
                <div class="cable_provider">
                  <select id="lineup" name="lineup" class="twitter-typeahead" placeholder="Provider">
                    <option value="">Please pick a Provider...</option>
                    <?php
                      if (!empty($lineups))
                      {
                        foreach($lineups as $lineup)
                        {
                          $lineup_id = $lineup -> lineupId;
                          $selected = $selectedLineup == $lineup_id ? "selected=\"true\"" : "" ;
                          ?>
                        <option value="<?php echo $lineup_id; ?>" <?php echo $selected ?>>
                          <?php echo $lineup -> name; ?>
                        </option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div> <!-- .cable_provider -->
              </div> <!-- .row -->

              <!-- team/sport search-->
              <input type="hidden" name="sport" id="sport" value="<?php echo $selectedSport?>"/>
              <input type="hidden" name="timezone" id="timezone" value="<?php echo $timezone?>"/>
              <input type="hidden" name="live" id="live" value="<?php echo $liveOnly?>"/>
              <!-- team name -->
              <div class="row">
                <div class="sports">
                  <h4 class="placeholder_workaround">SEARCH FOR A TEAM</h4>
                  <input class="typeahead" type="text" name="teamName" id="teamName" value="<?php echo $selectedTeam?>" placeholder="SEARCH FOR A TEAM">
                </div> <!-- .sports -->
              </div>


              <div class="row ongoing">
          
                <div class="col-md-6 ongoing_games">
                  <!-- a select option is not used because javascript/jquery is needed to redirect/load up the results and it increases load time -->
                  <div class="btn-group">
                    <button data-toggle="dropdown" class="btn dropdown-toggle custom_button">Today&apos;s Games <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu ongoing_games_dropdown">
                        <li><a href="javascript:submitForm('mlb','true');">MLB</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:submitForm('mls+soccer','true');">MLS</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:submitForm('nba','true');">NBA</a></li>
                        <li class="divider"></li>
<!--
                        <li><a href="javascript:submitForm('nfl','true');">NFL</a></li>
                        <li class="divider"></li>
-->
                        <li><a href="javascript:submitForm('nhl','true');">NHL</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:submitForm('ncaa','true');">NCAA</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:submitForm('english+premier+league+soccer','true');">EPLS</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-4 clear_filters">
                  <button type="button" class="btn btn-default custom_button" onclick="clearFilters()">Clear Filters
                  </button>
                </div>
              </div> <!-- .ongoing -->

              <div class="row find_channels">
                <input type="submit" class="find_channels_button" value="Find Channels"/>
              </div>

            </form>
        </div> <!-- .row .search_form -->

        

      </div> <!-- .row -->

    </div> <!-- .col-md-3 .search_fields -->

    <div class="col-md-6 results">
      <!-- jquery results -->
      <div class="row"> <!-- a row class is needed to add responsiveness to dataTables -->
          <table class="pretty" id="airings">
          </table>
      </div> <!-- .row -->
    </div> <!-- .col-md-6 -->

  </div> <!-- .row -->
</div> <!-- .search -->

<!-- add our scripts  -->
<script type="text/javascript" src="script/gamefinder.js?cachebust=<?php echo $seconds?>"></script>