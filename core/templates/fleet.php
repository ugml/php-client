<div class="row" id="page-content">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 content-header">
                Missions (max. 12)
            </div>
            <div class="col-md-12 content-body">
                <div class="row">
                    <div class="col-md-1 text-center">
                        <div>Num.</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>Mission</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>Ships</div>
                    </div>
                    <div class="col-md-1 text-center">
                        <div>Start</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>Starttime</div>
                    </div>
                    <div class="col-md-1 text-center">
                        <div>Dest.</div>
                    </div>
                    <div class="col-md-2 text-center">
                        <div>Arrivaltime</div>
                    </div>
                    <div class="col-md-1 text-center">
                        <div>Actions</div>
                    </div>
                </div>
                {fleet_current_missions}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 content-header">
                New Mission
            </div>
            <div class="col-md-12 content-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div>Name</div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div>Available</div>
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
                                <input type="submit" value="Continue" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>