<?php

    // set the values for the topbar
    $this->lang['planet_galaxy'] = Loader::getPlanet()->getGalaxy();
    $this->lang['planet_system'] = Loader::getPlanet()->getSystem();
    $this->lang['planet_planet'] = Loader::getPlanet()->getPlanet();
    $this->lang['planet_name'] = Loader::getPlanet()->getName();
    $this->lang['planet_diameter'] = number_format(Loader::getPlanet()->getDiameter(), 0);
    $this->lang['planet_fields_current'] = Loader::getPlanet()->getFieldsCurrent();
    $this->lang['planet_fields_max'] = Loader::getPlanet()->getFieldsMax();
    $this->lang['planet_temp_min'] = Loader::getPlanet()->getTempMin();
    $this->lang['planet_temp_max'] = Loader::getPlanet()->getTempMax();
    $this->lang['planet_metal'] = Loader::getPlanet()->getMetal();
    $this->lang['planet_crystal'] = Loader::getPlanet()->getCrystal();
    $this->lang['planet_deuterium'] = Loader::getPlanet()->getDeuterium();

    $this->lang['planet_metal_max'] = D_Units::getStorageCapacity(Loader::getBuildingData()->getMetalStorage());
    $this->lang['planet_crystal_max'] = D_Units::getStorageCapacity(Loader::getBuildingData()->getCrystalStorage());
    $this->lang['planet_deuterium_max'] = D_Units::getStorageCapacity(Loader::getBuildingData()->getDeuteriumStorage());

    $this->lang['planet_energy_used'] = number_format(Loader::getPlanet()->getEnergyUsed(), 0);
    $this->lang['planet_energy_max'] = number_format(Loader::getPlanet()->getEnergyMax(), 0);
//    $this->lang['planet_image_small'] = ;

    $planetList = Loader::getUser()->getPlanetList();

    for ($i = 0; $i < sizeof($planetList); $i++) {
        $current = "";

        if ($planetList[$i]->getPlanetID() == Loader::getUser()->getCurrentPlanet()) {
            $current = " selected";
        }
        $this->lang['planet_dropdown'] .= "<option" . $current . " value=\"" . $planetList[$i]->getPlanetID() . "\">" . $planetList[$i]->getName() . " [" . $planetList[$i]->getGalaxy() . ":" . $planetList[$i]->getSystem() . ":" . $planetList[$i]->getPlanet() . "]</option>";
    }
