<div id="page" class="box">
    <form action="" method="post">
        <div>
            <table width="500">
                <tbody>
                <tr>
                    <td class="c">{Production_level}</td>
                    <th>{production_level}</th>
                    <th width="250">
                        <div style="border: 1px solid rgb(153, 153, 255); width: 250px;">
                            <div id="prodBar" style="background-color: {production_level_barcolor}; width: {production_level_bar}px;">
                                &nbsp;
                            </div>
                        </div>
                    </th>
                </tr>
                </tbody>
            </table>
            <br>
        </div>

        <table width="500">
            <tbody>
            <tr>
                <td class="c" colspan="5">{Production_of_resources_in_the_planet}</td>
            </tr>
            <tr>
                <th></th>
                <th>{Metal}</th>
                <th>{Crystal}</th>
                <th>{Deuterium}</th>
                <th>{Energy}</th>
            </tr>
            <tr>
                <th>{Basic_income}</th>
                <td class="k">{metal_basic_income}</td>
                <td class="k">{crystal_basic_income}</td>
                <td class="k">{deuterium_basic_income}</td>
                <td class="k">{energy_basic_income}</td>
            </tr>

            <!-- resource_row -->
            {resource_row}

            <tr>
            </tr>
            <tr>
                <th>{Stores_capacity}</th>
                <td class="k">{metal_max}</td>
                <td class="k">{crystal_max}</td>
                <td class="k">{deuterium_max}</td>
                <td class="k"><font color="#00ff00">-</font></td>
                <td class="k"><input name="action" value="{Calcule}" type="submit"></td>
            </tr>
            <tr>
                <th colspan="5" height="4"></th>
            </tr>
            <tr>
                <th>Suma:</th>
                <td class="k">{metal_total}</td>
                <td class="k">{crystal_total}</td>
                <td class="k">{deuterium_total}</td>
                <td class="k">{energy_total}</td>
            </tr>

            <tr>
            </tr>

            <tr>
                <td colspan="5"><center></center></td>
            </tr>
            </tbody>
        </table>

        <div>
            <br>
            <table width="500">
                <tbody>
                <tr>
                    <td class="c" colspan="4">{Widespread_production}</td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <th>{Daily}</th>
                    <th>{Weekly}</th>
                    <th>{Monthly}</th>
                </tr>
                <tr>
                    <th>{Metal}</th>
                    <th>{daily_metal}</th>
                    <th>{weekly_metal}</th>
                    <th>{monthly_metal}</th>
                </tr>
                <tr>
                    <th>{Crystal}</th>
                    <th>{daily_crystal}</th>
                    <th>{weekly_crystal}</th>
                    <th>{monthly_crystal}</th>
                </tr>
                <tr>
                    <th>{Deuterium}</th>
                    <th>{daily_deuterium}</th>
                    <th>{weekly_deuterium}</th>
                    <th>{monthly_deuterium}</th>
                </tr>
                </tbody>
            </table>
        </div>

        <br>

        <table width="500">
            <tbody>
            <tr>
                <td class="c" colspan="3">{Storage_state}</td>
            </tr>
            <tr>
                <th>{Metal}</th>
                <th>{metal_storage}</th>
                <th width="250">
                    <div style="border: 1px solid rgb(153, 153, 255); width: 250px;">
                        <div id="AlmMBar" style="background-color: {metal_storage_barcolor}; width: {metal_storage_bar}px;">
                            &nbsp;
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th>{Crystal}</th>
                <th>{crystal_storage}</th>
                <th width="250">
                    <div style="border: 1px solid rgb(153, 153, 255); width: 250px;">
                        <div id="AlmCBar" style="background-color: {crystal_storage_barcolor}; width: {crystal_storage_bar}px; opacity: 0.98;">
                            &nbsp;
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th>{Deuterium}</th>
                <th>{deuterium_storage}</th>
                <th width="250">
                    <div style="border: 1px solid rgb(153, 153, 255); width: 250px;">
                        <div id="AlmDBar" style="background-color: {deuterium_storage_barcolor}; width: {deuterium_storage_bar}px;">
                            &nbsp;
                        </div>
                    </div>
                </th>
            </tr>
            </tbody>
        </table>

        <br>
</div>

</form>

<script language="JavaScript" src="scripts/wz_tooltip.js"></script>

