<div class="b_building gridcontainer">
    <div class="row">
        <div class="col-12 b_building_title">
            <span>{b_name} (Level {b_level})</span>
        </div>
        <div class="col-2 b_building_image">
            <img src="{b_image}"/>
        </div>
        <div class="col-8">
            <p>{b_description}</p>
            <p>
                <span><img src="skins/Maya/images/metal.gif"/>{b_metal}</span>
                <span><img src="skins/Maya/images/crystal.gif"/>{b_crystal}</span>
                <span><img src="skins/Maya/images/deuterium.gif"/>{b_deuterium}</span>
                <span><img src="skins/Maya/images/energy.gif"/>{b_time}s</span>
            </p>
        </div>
        <div class="col-2 center" id="b_{b_id}">
            <button name="build" class="{b_build_class}" value="{b_id}" {b_disabled}>{b_build}</button>
        </div>
    </div>
</div>
