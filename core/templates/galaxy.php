<div class="row" id="page-content">
    <div class="col-md-1">&nbsp;</div> <!-- spacing -->

    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12 content-header">
                {galaxy_galaxy}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 content-body">
                <div class="row">
                    <div class="col-md-12 text-center vertical-center">
                        <div>
                            <a class="button" href="?page=galaxy&g={galaxy_pos_g_prev}&s={galaxy_pos_s}">&#8592;</a>
                            <form>
                                <input type="text" name="g" value="{galaxy_pos_g}" disabled />
                            </form>
                            <a class="button" href="?page=galaxy&g={galaxy_pos_g_next}&s={galaxy_pos_s}">&#8594;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">&nbsp;</div> <!-- spacing -->

    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12 content-header">
                {galaxy_system}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 content-body">
                <div class="row">
                    <div class="col-md-12 text-center vertical-center">
                        <div>
                            <a href="?page=galaxy&g={galaxy_pos_g}&s={galaxy_pos_s_prev}">&#8592;</a>
                            <form>
                                <input type="text" name="s" value="{galaxy_pos_s}" disabled />
                            </form>
                            <a href="?page=galaxy&g={galaxy_pos_g}&s={galaxy_pos_s_next}">&#8594;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-1">&nbsp;</div> <!-- spacing -->

    <div class="row"><div class="col-md-12">&nbsp;</div></div> <!-- spacing -->

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 content-header">
                {galaxy_system} {galaxy_pos_g}:{galaxy_pos_s}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 content-body">
                <div class="row">
                    <div class="col-md-1 text-center vertical-center">
                        <div>
                            {galaxy_position}
                        </div>
                    </div>
                    <div class="col-md-1 text-center vertical-center">
                        <div>
                            {galaxy_planet_image}
                        </div>
                    </div>
                    <div class="col-md-2 text-center vertical-center">
                        <div>
                            {galaxy_planet_name} ({galaxy_planet_activity})
                        </div>
                    </div>
                    <div class="col-md-1 text-center vertical-center">
                        <div>
                            {galaxy_moon}
                        </div>
                    </div>
                    <div class="col-md-1 text-center vertical-center">
                        <div>
                            {galaxy_debris}
                        </div>
                    </div>
                    <div class="col-md-2 text-center vertical-center">
                        <div>
                            {galaxy_player} ({galaxy_player_status})
                        </div>
                    </div>
                    <div class="col-md-1 text-center vertical-center">
                        <div>
                            {galaxy_alliance}
                        </div>
                    </div>
                    <div class="col-md-3 text-center vertical-center">
                        <div>
                            {galaxy_actions}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 content-body">
                {galaxy_list}
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 content-header">
                ( {galaxy_num_planets} {planets_populated} )
            </div>
            <div class="col-md-4 content-header">
                <span onmouseover="showGalaxyLegend();">{legend}</span>
            </div>
        </div>
    </div>
</div>

<script>

</script>
