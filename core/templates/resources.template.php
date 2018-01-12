
<!-- content -->
<div class="row" id="page-content">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 text-center">
                Produktionsfaktor: 1
            </div>
            <div class="col-md-12 content-header">
                {production_on_this_planet} "{planet_name}"
            </div>
            <div class="col-md-12 content-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div>&nbsp;</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div><b>{metal}</b></div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div><b>{crystal}</b></div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div><b>{deuterium}</b></div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div><b>{energy}</b></div>
                    </div>
                    <div class="col-md-1 text-center">
                        <div></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 content-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div><b>{basic_income}</b></div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{config_base_income_metal}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{config_base_income_crystal}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{config_base_income_deuterium}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{config_base_income_energy}</div>
                    </div>
                    <div class="col-md-1 text-center">
                        <div></div>
                    </div>
                </div>
                {resource_row}
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div><b>{stores_capacity}</b></div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{planet_storage_metal}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{planet_storage_crystal}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{planet_storage_deuterium}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>-</div>
                    </div>
                    <div class="col-md-1 text-center">
                        <div><button>{calcule}</button></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div><b>{daily}</b></div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{production_daily_metal}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{production_daily_crystal}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{production_daily_deuterium}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>-</div>
                    </div>
                    <div class="col-md-1 text-center">
                        <div></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div><b>{weekly}</b></div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{production_weekly_metal}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{production_weekly_crystal}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{production_weekly_deuterium}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>-</div>
                    </div>
                    <div class="col-md-1 text-center">
                        <div></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div><b>{monthly}</b></div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{production_monthly_metal}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{production_monthly_crystal}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{production_monthly_deuterium}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>-</div>
                    </div>
                    <div class="col-md-1 text-center">
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--



    <tr>
      <td></td>
      <td></font></td>
      <td></font></td>
      <td></font></td>
      <td></font></td>
      <td>
          {production_options}
      </td>
    </tr>
<div id="page">

    <div class="page_heading">
        {production_on_this_planet}
    </div>
    <div class="page_events">

    <h2>{production}</h2>



            {resource_row}

            <tr>
                <td>{stores_capacity}</td>
                <td>{planet_storage_metal}</td>
                <td>{planet_storage_crystal}</td>
                <td>{planet_storage_deuterium}</td>
                <td>&nbsp;</td>
                <td><button type="submit">{calcule}</button></td>
            </tr>
            <tr>
                <td>{sum}:</td>
                <td>{total_metal}</td>
                <td>{total_crystal}</td>
                <td>{total_deuterium}</td>
                <td>{total_energy}</td>
                <td>&nbsp;</td>
            </tr>
        </table>
    </form>

    <h2>{production_over_time}</h2>

    <table class="data">
        <tr>
            <th>&nbsp;</th>
            <th>{daily}</th>
            <th>{weekly}</th>
            <th>{monthly}</th>
        </tr>
        <tr>
            <td>{metal}</td>
            <td>{production_daily_metal}</td>
            <td>{production_weekly_metal}</td>
            <td>{production_monthly_metal}</td>
        </tr>
        <tr>
            <td>{crystal}</td>
            <td>{production_daily_crystal}</td>
            <td>{production_weekly_crystal}</td>
            <td>{production_monthly_crystal}</td>
        </tr>
        <tr>
            <td>{deuterium}</td>
            <td>{production_daily_deuterium}</td>
            <td>{production_weekly_deuterium}</td>
            <td>{production_monthly_deuterium}</td>
        </tr>
    </table>
    </div>
</div>
-->
