<div class="row" id="page-content">
    <div class="col-md-12">
        <form action="game.php?page=fleet" method="post">
            <div class="row">
                <div class="col-md-12 content-header">
                    {send_fleet}
                </div>

                    <div class="col-md-12 content-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <div>{destination}</div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div>
                                    <input oninput="javascript:calculateDistance(<?php echo Loader::getPlanet()->getGalaxy(); ?>, <?php echo Loader::getPlanet()->getSystem(); ?>, <?php echo Loader::getPlanet()->getPlanet(); ?>);" type="number" size="2" min="1" max="<?php echo Config::$gameConfig['max_galaxy'] ?>" maxlength="2" value="<?php echo Loader::getPlanet()->getGalaxy(); ?>" class="input-coordinates" name="fleet_dest_galaxy" />:
                                    <input oninput="javascript:calculateDistance(<?php echo Loader::getPlanet()->getGalaxy(); ?>, <?php echo Loader::getPlanet()->getSystem(); ?>, <?php echo Loader::getPlanet()->getPlanet(); ?>);"  type="number" size="2" min="1" max="<?php echo Config::$gameConfig['max_system'] ?>" maxlength="3" value="<?php echo Loader::getPlanet()->getSystem(); ?>" class="input-coordinates" name="fleet_dest_system" />:
                                    <input oninput="javascript:calculateDistance(<?php echo Loader::getPlanet()->getGalaxy(); ?>, <?php echo Loader::getPlanet()->getSystem(); ?>, <?php echo Loader::getPlanet()->getPlanet(); ?>);"  type="number" size="2" min="1" max="<?php echo Config::$gameConfig['max_planet'] ?>" maxlength="2" value="<?php echo Loader::getPlanet()->getPlanet(); ?>" class="input-coordinates" name="fleet_dest_planet" />
                                    <select name="fleet_dest_type">
                                        <option value="0">{planet_type_planet}</option>
                                        <option value="1">{planet_type_moon}</option>
                                        <option value="2">{planet_type_debris}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 content-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <div>{speed}</div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div>
                                    <select name="fleet_mission">
                                        <option value="0">{transport}</option>
                                        <option value="1">{deploy}</option>
                                        <option value="2">{attack}</option>
                                        <option value="3">{acs}</option>
                                        <option value="4">{hold}</option>
                                        <option value="5">{colonize}</option>
                                        <option value="6">{harvest}</option>
                                        <option value="7">{espionage}</option>
                                        <option value="8">{destroy}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="col-md-12 content-body">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div>{mission}</div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div>
                                <select name="fleet_speed">
                                    <option value="100">100%</option>
                                    <option value="90">90%</option>
                                    <option value="80">80%</option>
                                    <option value="70">70%</option>
                                    <option value="60">60%</option>
                                    <option value="50">50%</option>
                                    <option value="40">40%</option>
                                    <option value="30">30%</option>
                                    <option value="20">20%</option>
                                    <option value="10">10%</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="col-md-12 content-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <div>{distance}</div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div>
                                    <span id="distance">0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 content-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <div>{duration_one_way}</div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div>
                                    0s (todo)
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 content-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <div>{consumption}</div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div>
                                    0 (todo)
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 content-body">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <div>{storage}</div>
                            </div>
                            <div class="col-md-6 text-center">
                                <div>
                                    <span id="storage">5.000</span>(todo)
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="col-md-12 content-header">
                    {resources}
                </div>

                <div class="col-md-12 content-body">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div>
                                {metal}
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div>
                                <a href="javascript:void(0)" onclick="return setMax(this);">{max}</a> <input type="number" min="0" max="<?php echo Loader::getPlanet()->getMetal(); ?>" name="fleet_metal" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div>
                                {crystal}
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div>
                                <a href="javascript:void(0)" onclick="return setMax(this);">{max}</a> <input type="number" min="0" max="<?php echo Loader::getPlanet()->getCrystal(); ?>" name="fleet_crystal" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div>
                                {deuterium}
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div>
                                <a href="javascript:void(0)" onclick="return setMax(this);">{max}</a> <input type="number" min="0" max="<?php echo Loader::getPlanet()->getDeuterium(); ?>" name="fleet_deuterium" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 content-header">
                    {shortlinks}
                </div>

                <div class="col-md-12 content-body">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <div>
                                todo
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div>
                                todo
                            </div>
                        </div>
                    </div>
                </div>


<!--                <div class="col-md-12 content-header">-->
<!--                    {acs}-->
<!--                </div>-->
<!---->
<!--                <div class="col-md-12 content-body">-->
<!--                    <div class="row">-->
<!--                        <div class="col-md-12 text-center">-->
<!--                            <div>-->
<!--                                todo-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

                <div class="col-md-12 content-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div>
                                <input type="hidden" name="fleet_fleetdata" value="{fleet_fleetdata}" />
                                <input type="hidden" name="step" value="2" />
                                <input type="submit" value="Send" />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
<script src="scripts/fleet.js"></script>