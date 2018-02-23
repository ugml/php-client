<div class="row">
    <div class="col-md-2 text-center vertical-center building-image">
        <div>
            <img src="{s_image}"/>
        </div>
    </div>
    <div class="col-md-8">
        <div>
            <a href="?page=techtree&bid={s_id}">{s_name}</a> ({s_level} {available})<br/>
            {s_description}<br/>
            {requirements}: {metal}: {s_metal} {crystal}: {s_crystal} {deuterium}: {s_deuterium}<br/>
            {construction_time}: {s_time}
        </div>
    </div>
    <div class="col-md-2 vertical-center">
        <div>
            <input name="{s_id}" type="number" name="build" value="0"/>
        </div>
    </div>
</div>
