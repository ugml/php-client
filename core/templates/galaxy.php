<div class="row" id="page-content">

    <div class="col-md-1">&nbsp;</div>

    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12 content-header">
                Galaxie
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 content-body">
                <div class="row">
                    <div class="col-md-12 text-center vertical-center">
                        <div>
                            <form method="get">
                                <button name="g" value="{galaxy_pos_g_prev}"><-</button>
                                <input type="text" id="g" value="{galaxy_pos_g}" />
                                <button name="g" value="{galaxy_pos_g_next}">-></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-2">&nbsp;</div>

    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12 content-header">
                System
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 content-body">
                <div class="row">
                    <div class="col-md-12 text-center vertical-center">
                        <div>
                            <form method="get">
                                <input type="submit" id="prevGalaxy" value="<-" />
                                <input type="text" id="g" value="{galaxy_pos_s}" />
                                <input type="submit" id="nextGalaxy" value="->" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-1">&nbsp;</div>

    <div class="row"><div class="col-md-12 content-body"><div>submit</div></div></div>

    <div class="row"><div class="col-md-12">&nbsp;</div></div>

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
                            Pos.
                        </div>
                    </div>
                    <div class="col-md-1 text-center vertical-center">
                        <div>
                            Planet
                        </div>
                    </div>
                    <div class="col-md-2 text-center vertical-center">
                        <div>
                            Name (Aktivit&auml;t)
                        </div>
                    </div>
                    <div class="col-md-1 text-center vertical-center">
                        <div>
                            Mond
                        </div>
                    </div>
                    <div class="col-md-1 text-center vertical-center">
                        <div>
                            TF
                        </div>
                    </div>
                    <div class="col-md-2 text-center vertical-center">
                        <div>
                            Spieler (Status)
                        </div>
                    </div>
                    <div class="col-md-1 text-center vertical-center">
                        <div>
                            Allianz
                        </div>
                    </div>
                    <div class="col-md-3 text-center vertical-center">
                        <div>
                            Aktionen
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
