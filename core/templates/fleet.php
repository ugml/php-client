<div class="row" id="page-content">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 content-header">
                {missions} ({max} 12)
            </div>
            <div class="col-md-12 content-body">
                <div class="row">
                    <div class="col-md-1 text-center">
                        <div>{num}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{missions}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{ships}</div>
                    </div>
                    <div class="col-md-1 text-center">
                        <div>{start}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{start_time}</div>
                    </div>
                    <div class="col-md-1 text-center">
                        <div>{destination_short}</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>{arrival_time}</div>
                    </div>
                    <div class="col-md-1 text-center">
                        <div>{actions}</div>
                    </div>
                </div>
                {fleet_current_missions}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 content-header">
                {new_mission}
            </div>
            <div class="col-md-12 content-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div>{ship_name}</div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div>{ships_available}</div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div>&nbsp;</div>
                    </div>
                </div>
                <form action="game.php?page=fleet" method="post">
                {fleet_available_list}
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div>
                                <input type="hidden" name="step" value="1" />
                                <input type="submit" value="{continue}" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>