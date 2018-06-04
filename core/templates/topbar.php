<div class="col-md-10">
    <!-- topnav -->
    <div class="row" id="topnav">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4" id="planetList">
                    <img src="{skinpath}planeten/small/s_<?php echo Loader::getPlanet()->getImage(); ?>.png" alt="Planet"/>
                    <select onchange="cpChange(this.value)">
                        {planet_dropdown}
                    </select>
                </div>
                <div class="col-md-2 text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{skinpath}images/metal.png" alt="Metall"/>
                        </div>
                        <div class="col-md-12 resource-name resource-metal">
                            {metal}
                        </div>
                        <div class="col-md-12">
                            <?php

                                if ($this->_['lang']['planet_metal'] >= $this->_['lang']['planet_metal_max']) {
                                    echo "<span class=\"negative\">" . number_format($this->_['lang']['planet_metal'],
                                            0) . "</span>";
                                } else {
                                    echo number_format($this->_['lang']['planet_metal'], 0);
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{skinpath}images/crystal.png" alt="Kristall"/>
                        </div>
                        <div class="col-md-12 resource-name resource-crystal">
                            {crystal}
                        </div>
                        <div class="col-md-12">
                            <?php

                                if ($this->_['lang']['planet_crystal'] >= $this->_['lang']['planet_crystal_max']) {
                                    echo "<span class=\"negative\">" . number_format($this->_['lang']['planet_crystal'],
                                            0) . "</span>";
                                } else {
                                    echo number_format($this->_['lang']['planet_crystal'], 0);
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{skinpath}images/deuterium.png" alt="Deuterium"/>
                        </div>
                        <div class="col-md-12 resource-name resource-deuterium">
                            {deuterium}
                        </div>
                        <div class="col-md-12">
                            <?php

                                //die($this->_['lang']['planet_deuterium'] ." - " . $this->_['lang']['planet_deuterium_max']);
                                if ($this->_['lang']['planet_deuterium'] >= $this->_['lang']['planet_deuterium_max']) {
                                    echo "<span class=\"negative\">" . number_format($this->_['lang']['planet_deuterium'],
                                            0) . "</span>";
                                } else {
                                    echo number_format($this->_['lang']['planet_deuterium'], 0);
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-center">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{skinpath}images/energy.png" alt="Energie"/>
                        </div>
                        <div class="col-md-12 resource-name resource-energy">
                            {energy}
                        </div>
                        <div class="col-md-12">
                            <?php

                                if ($this->_['lang']['planet_energy_used'] > $this->_['lang']['planet_energy_max']) {
                                    echo "<span class=\"negative\">{planet_energy_used}/{planet_energy_max}</span>";
                                } else {
                                    echo "{planet_energy_used}/{planet_energy_max}";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
